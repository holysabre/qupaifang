<?php
namespace Admin\Model;
use Think\Model;
class OrderModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $order_status= I('request.order_status');
        $express_status= I('request.express_status');
    	$pagenum = I('request.pagenum', 10);
        $name= I('request.name');

        $where = array();

        if ($name != '') $where['name'] = array('like', "%{$name}%");
        if ($order_status != '') $where['order_status'] = $order_status;
        if ($express_status != '') $where['express_status'] = $express_status;

        $count = $this->where($where)->count();
        $Page  = new \Think\Page($count, $pagenum, I('request.'));
        $Page->setConfig('header', '<span class="info">共 %TOTAL_ROW% 条记录 每 %LISTROWS% 条/页</span>');
        $array = $this->where($where)->order('time desc,add_time desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        //echo $this->getLastSql();
        $data = array();
        $data = I('request.');
        $data['list'] = $array;
        $data['page'] = $Page->show();
        $data['count'] = $count;
        return $data;
    }

    public function edit($id){
    	if(IS_POST){
    		$data = $this->create();
    		if($data){
    			$data['time'] = time();
                // 伪静态名
                if ($data['html'] == '') {
                    $data['html'] = yd_pinyin($data['title']);
                } else {
                    !empty($data['html']) && $data['html'] = str_lower($data['html']);
                }
                // 内容转译
                if($data['content'] != ''){
                    $data['content'] = serialize($data['content']);
                }
    			if($id == 0){
    				$add = $this->add($data);
	    			if($add){
	    				$this->admin_log_add('', '添加单页成功,ID:'.$add.', 标题:'.$data['name'], 2);
	    				$this->ajax_check('添加单页成功!', 1);
	    			}else{
	    				$this->ajax_check('添加单页失败!');
	    			}
    			}else{
    				if($this->save($data)){
    					$this->admin_log_add('', '更新单页成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新单页成功!', 1);
    				}else{
    					$this->ajax_check('更新单页失败!');
    				}
    			}
    		}else{
    			$this->ajax_check($this->getDbError());
    		}
    	}
    }

    public function findOne($id){
    	if($id){
    		$info = $this->find($id);
    		return $info;
    	}
    }

    public function findAll(){
    	$where = array();
    	$info = $this->field('id,title,pid')->where($where)->order('sort asc')->select();
    	return $info;

    }

    // 删除
    public function deleteOne() {
        $ids    = trim(I('request.id'), ',');
        
        if ($ids == '') {
            $this->ajax_check('请选择要操作的数据!');
        }
        $map = array('id' => array('IN', $ids) );
        if (false !== $this->where($map)->delete()) {
            $this->admin_log_add('', '删除成功,ID:'.$ids, 2);
            $this->ajax_check('删除成功!', 1);
        } else {
            $this->ajax_check('删除失败!');
        }
        
    }

    //基本信息
    public function baseInfo(){
        $id = I('request.id');
        $info = $this->find($id);
        return $info;
    }

    //产品信息
    public function productsInfo(){
        $id = I('request.id');
        $where = array();
        $where['o.order_id'] = $id;
        $field = 'o.*,p.sn,p.discount as before_discount';
        $list = M()->field($field)->table('p_order_info as o')->join('inner join p_products as p on o.pro_id = p.id')->where($where)->select();
        return $list;
    }

    //订单日志
    public function orderLog(){
        $id = I('request.id');
        $where = array();
        $where['order_id'] = $id;
        $list = M('order_log')->where($where)->order('time desc')->select();
        return $list;
    }

    //订单状态
    public function orderStatus(){
        $order_id = I('request.order_id');
        $remark = I('request.remark');
        $status = I('request.status');
        $desc = I('request.desc');
        if($status == 3){
            //减少库存
            $this->decStock($order_id);
        }
        $res = $this->where("id = $order_id")->setField('order_status',$status);
        if($res){
            //订单日志
            $data = array();
            $data['order_id'] = $order_id;
            $data['order_status'] = $status;
            $data['desc'] = $desc;
            $data['operator'] = '管理员';
            $data['remark'] = $remark;
            write_order_log($data);
            $this->ajax_check($desc.'成功',1);
        }else{
            $this->ajax_check($desc,'失败');
        }
    }

    //获取单条订单信息
    public function getOrderInfo($id){
        $where['o.id'] = $id;
        $field = 'o.*,p.discount as before_discount';
        $info = M()->field($field)->table('p_order_info as o')->join('inner join p_products as p on o.pro_id = p.id')->where($where)->find();
        return $info;
    }

    //修改商品价格
    public function editPrice($id){
        $data = M('order_info')->create();
        dumps($data);
        $res = M('order_info')->save($data);
        if($res){
            $this->ajax_check('修改成功',1);
        }else{
            $this->ajax_check('修改失败');
        }
    }

    //增加物流信息
    public function express($id){
        $data = $this->create();
        $data['order_status'] = 4;
        $data['express_status'] = 1;
        $data['express_time'] = time();
        $res = $this->save($data);
        if($res){
            //订单日志
            $_data['order_id'] = $data['id'];
            $_data['order_status'] = 4;
            $_data['express_status'] = 1;
            $_data['desc'] = '发货';
            $_data['operator'] = '管理员';
            $_data['remark'] = $data['express_remark'];
            write_order_log($_data);
            $this->ajax_check('发货成功',1);
        }else{
            $this->ajax_check('发货失败');
        }
    }

    //减少库存
    public function decStock($order_id){
        $order_list = M('order_info')->where(array('order_id'=>$order_id))->select();
        foreach ($order_list as $key => $value) {
            $pro_info = M('products')->find($value['pro_id']);
            if($value['number'] > $pro_info['stock']){
                $this->ajax_check('库存不足');
            }else{
                //库存充足 减少库存
                M('products')->where(array('id'=>$value['pro_id']))->setDec('stock',$value['number']);
            }
        }
    }
}