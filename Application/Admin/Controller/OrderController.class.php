<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends BaseController {

	private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('Order');
    }

    public function index(){
    	$data = $this->model->index();
    	$this->assign('data',$data);
        $this->display();
    }

    public function detail(){
        //基本信息
        $base_info = $this->model->baseInfo();
        $this->assign('base_info',$base_info);

        //商品信息
        $products_info = $this->model->productsInfo();
        $this->assign('products_info',$products_info);
        
        //操作记录
        $log_list = $this->model->orderLog();
        $this->assign('log_list',$log_list);
        $this->display();
    }

    public function edit(){
    	$id = I('id',0);
    	if(IS_POST){
    		$this->model->edit($id);
    	}else{
    		$info = $this->model->findOne($id);
    		$this->assign('info',$info);
    		$page_list = $this->model->findAll();
    		$page_list = list_to_tree($page_list);
    		$this->assign('page_list',$page_list);
    		$this->display();
    	}
    }

    // 删除
    public function deleteOne() {
        $this->model->deleteOne();
    }

    //订单状态
    public function status(){
        $this->model->orderStatus();
    }

    //修改订单商品价格
    public function editPrice(){
        $id = I('request.order_info_id');
        if(IS_POST){
            $this->model->editPrice($id);
        }else{
            $info = $this->model->getOrderInfo($id);
            $this->assign('info',$info);
            $this->display();
            //dumps($info);
        }
    }

    //发货
    public function express(){
        if(IS_POST){
            $this->model->express();
        }else{
            $info = $this->model->baseInfo();
            $this->assign('info',$info);
            $this->display();
        }
    }

    //获取未确认订单数量
    public function unconfirmed_order_number(){
        $where = array();
        $where['order_status'] = 1;
        $res = M('order')->where($where)->select();
        return count($res);
    }
}