<?php
namespace Wap\Controller;
use Think\Controller;
class IndexController extends BaseController {

    public $catid;
	public function __construct() {
        parent::__construct();
        $this->catid   = I('request.catid');
        $this->assign('catid',$this->catid);
    }

    public function index(){
        //检测会员是否登陆
        $this->is_login();
    	$data = D('Products')->getIndex();
        $order = I('request.order') == 'desc'?'asc':'desc';
        $this->assign('order',$order);
    	$this->assign('data',$data);
    	$this->display();
    	//dumps($data);
    }
    
    public function detail(){
    	$data = D('Products')->getInfo();
    	$this->assign('data',$data);
        $this->assign('hidden',1);
    	$this->display();
    }

}