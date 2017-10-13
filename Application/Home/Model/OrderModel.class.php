<?php
namespace Home\Model;
use Think\Model;
class OrderModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //获取结算商品详情
    public function getSettle(){
        $ids = I('request.ids');
        $ids = rtrim($ids,',');
        $ids = explode(',', $ids);
        $list = $this->getCartProInfo($ids);
        return $list;
    }

    //立即购买
    public function buyNow(){
        $id = I('request.id');
        $where['id'] = $id;
        $list = M('Products')->where($where)->select();
        foreach ($list as $key => $value) {
            $list[$key]['number'] = 1;
        }
        return $list;
    }

    //提交立即购买
    public function submitBuyNow(){
        $id = I('request.cart_id');
        $id = reset($id);
        $info = M('Products')->find($id);
        $_info = array(
            'pro_id' => $info['id'],
            'title' => $info['title'],
            'img' => $info['img'],
            'market_price' => $info['market_price'],
            'price' => $info['price'],
            'number' => 1,
            'total_price' => $info['price'],
            'time' => time()
        );
        $list[0] = $_info;
        //dumps($list);
        $this->addOrder($list);
    }

    //提交订单
    public function addOrder($list){
        $cart_id = I('request.cart_id');
        if(empty($list)){
            $list = $this->getCartProInfo($cart_id);
        }
        $member = $this->member;
        $data = array();
        $data['member_id'] = $member['id'];
        $data['order_sn'] = time() . rand(000001,999999);
        $data['name'] = $member['name'];
        $data['address'] = $member['province'] . $member['city'] . $member['district'] . $member['address'];
        $data['mobile'] = $member['mobile'];
        $data['zipcode'] = $member['zipcode'];
        $data['order_status'] = 1;//1未确认2已确认3待发货4已发货5已签收
        $data['add_time'] = time();
        $data['total_price'] = '';//总价
        $data['pay_price'] = '';//支付金额
        $data['time'] = time();
        $res = $this->add($data);
        if($res){
            //添加订单商品信息
            $total = $this->addOrderPro($res,$list);
            //修改价格
            $map['total_price'] = $map['pay_price'] = $total['total_price'];
            $map['total_number'] = $total['total_number'];
            $this->where("id = $res")->save($map);
            //清除购物车中的商品
            $this->clearCart($cart_id);
            //订单操作记录
            $_data['order_id'] = $res;
            $_data['order_status'] = 1;
            $_data['desc'] = '提交订单';
            $_data['operator'] = '会员:'.$member['nickname'];
            $_data['remark'] = '';
            write_order_log($_data);
            $this->ajax_check('已提交订单',1);
        }else{
            $this->ajax_check('订单提交失败，请稍后重试');
        }
    }

    //获取购物车与商品详情对应的信息
    public function getCartProInfo($ids,$field = ''){
        $field = $field== '' ? 'c.*,p.id as pro_id,p.title,p.img,p.sn,p.price,p.market_price,p.stock' : $field;
        $where = array();
        $where['c.id'] = array('in',$ids);
        $field = 'c.*,p.title,p.img,p.sn,p.price,p.market_price,p.stock';
        $list = M()->field($field)->table('p_cart as c')->join('inner join p_products as p on c.pro_id = p.id')->where($where)->order('c.time desc')->select();
        return $list;
    }
    
    //添加订单商品信息
    public function addOrderPro($order_id,$list){
        $total_price = $total_number = 0;
        foreach ($list as $key => $value) {
            $data = array();
            $data['order_id'] = $order_id;
            $data['pro_id'] = $value['pro_id'];
            $data['title'] = $value['title'];   
            $data['img'] = $value['img'];
            $data['price'] = $value['price'];
            $data['market_price'] = $value['market_price'];
            $data['number'] = $value['number'];
            $data['total_price'] = $value['price'] * $value['number'];
            $data['time'] = time();
            $total_price += $data['total_price'];
            $total_number += $value['number'];
            $res = M('order_info')->add($data);
            //减少库存 20170531修改 后台确认订单后 才会减少库存
            //M('products')->where(array('id'=>$value['pro_id']))->setDec('stock',$value['number']);
        }
        $data['total_price'] = $total_price;
        $data['total_number'] = $total_number;
        return $data;
    }

    //清除购物车中的商品
    public function clearCart($cart_id){
        $where = array();
        $where['id'] = array('in',$cart_id);
        $res = M('Cart')->where($where)->delete();
        return $res;

    }

    //获取订单列表
    public function getList(){
        $pagenum = 5;

        $where = array();
        $where['order_status'] = array('gt',-1);
        $member = $this->member;
        $where['member_id'] = $member['id'];

        $count = $this->where($where)->count();
        $Page  = new \Think\Page($count, $pagenum, I('request.'));
        $Page->setConfig('header', '<span class="info">共 %TOTAL_ROW% 条记录</span>');
        $array = $this->where($where)->order('time desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        //echo $this->getLastSql();
        $data = array();
        $data = I('request.');
        $data['list'] = $array;
        $data['page'] = $Page->show();
        $data['count'] = $count;
        return $data;
    }

    //获取订单详情
    public function getDetail(){
        $id = I('request.id');
        $info = $this->find($id);
        $where = array();
        $where['o.order_id'] = $id;
        $field = 'o.*,p.discount';
        $data_info = M()->field($field)->table('p_order_info as o')->join('inner join p_products as p on o.pro_id = p.id')->where($where)->select();

        $data['info'] = $info;
        $data['order_info'] = $data_info;
        return $data;
    }

    //删除订单
    public function deleteOrder(){
        $id = I('request.id');
        $status = I('request.status');
        $res = $this->where("id = $id")->setField('order_status',$status);
        if($res){
            $this->ajax_check('删除成功',1);
        }else{
            $this->ajax_check('删除失败');
        }
    }

}