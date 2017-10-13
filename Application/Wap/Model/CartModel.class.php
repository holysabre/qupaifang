<?php
namespace Wap\Model;
use Think\Model;
class CartModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //列表
    public function getList(){
        $where = array();
        $member = $this->member;
        $where['member_id'] = $member['id'];
        $field = 'c.*,p.title,p.img,p.sn,p.price,p.market_price,p.stock';
        $array = M()->field($field)->table('p_cart as c')->join('inner join p_products as p on c.pro_id = p.id')->where($where)->order('c.time desc')->select();
        //echo $this->getLastSql();
        return $array;
    }

    //加入购物车
    public function addCart(){
        $pro_id = I('request.id');
        $number = I('request.number',1);
        $member = $this->member;
        $data = array();
        $data['member_id'] = $member['id'];
        $data['pro_id'] = $pro_id;
        $data['time'] = time();
        //判断购物车中改商品是否存在 存在则增加数量
        $cartInfo = $this->where("pro_id = $pro_id")->find();
        if($cartInfo){
            $data['number'] = $cartInfo['number'] + $number;
            $data['id'] = $cartInfo['id'];
            $res = $this->save($data);
        }else{
            $data['number'] = $number;
            $res = $this->add($data);
        }
        if($res){
            $this->ajax_check('加入购物车成功',1,$res.$this->_sql());
        }else{
            $this->ajax_check('加入购物车失败',0,$this->getDbError());
        }
    }

    //修改购物车字段
    public function editCart(){
        $id = I('request.id');
        $field = I('request.field');
        $value = I('request.value');
        $res = $this->where("id = $id")->setField(array($field=>$value));
        if($res){
            $this->ajax_check('修改成功',1);
        }else{
            $this->ajax_check('修改失败');
        }
    }

    //删除购物车
    public function deleteCart(){
        $id = I('request.id');
        if($id){
            $res = $this->delete($id);
            if($res){
                $this->ajax_check('删除成功',1);
            }else{
                $this->ajax_check('删除失败');
            }
        }
    }
}