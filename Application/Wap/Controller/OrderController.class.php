<?php
namespace Wap\Controller;
use Think\Controller;
class OrderController extends BaseController {

	private $model;
	public function __construct() {
        parent::__construct();
        $this->model = D('Order');
        //检测会员是否登录
       	$this->is_login();
    }

    //订单首页
    public function index(){
        $data = $this->model->getList();
        $this->assign('data',$data);
        $this->display();
    }

    //结算
    public function settle(){
        $data = $this->model->getSettle();
        $this->assign('data',$data);
        $this->display();
    }

    //立即购买
    public function buynow(){
        $data = $this->model->buyNow();
        $this->assign('data',$data);
        $this->display();
    }

    //提交立即购买
    public function submitBuyNow(){
        $this->model->submitBuyNow();
    }

    //提交订单
    public function submitOrder(){
        $this->model->addOrder();
    }

    //订单详情
    public function detail(){
        $data = $this->model->getDetail();
        $this->assign('data',$data);
        $this->display();
        //dumps($data);
    }

    //改变订单状态
    public function status(){
        $this->model->orderStatus();
    }
}