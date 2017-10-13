<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends BaseController {

	private $model;
	public function __construct() {
        parent::__construct();
        $this->model = D('Cart');
        //检测会员是否登录
       	$this->is_login();
    }

    public function index(){
    	$action = I('request.action');
        $this->$action();
    }

    //购物车列表
    public function cartList(){
    	$data = $this->model->getList();
    	$this->assign('data',$data);
    	$this->display();
    }

    //加入购物车
    public function addCart(){
    	$this->model->addCart();
    }

    //修改购物车
    public function editCart(){
    	$this->model->editCart();
    }

    //删除购物车
    public function deleteCart(){
    	$this->model->deleteCart();
    }
}