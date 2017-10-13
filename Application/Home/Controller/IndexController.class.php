<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {

	public function __construct() {
        parent::__construct();
    }

    public function index(){
        //sendSms();
        //get_email(array(),'111','222');
    	$this->display();
    }
    
    public function detail(){
    	$data = D('Products')->getInfo();
    	$this->assign('data',$data);
        $this->assign('hidden',1);
    	$this->display();
    }


}