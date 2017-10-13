<?php
namespace Wap\Controller;
use Think\Controller;
class MemberController extends BaseController {

	private $model;
	public function __construct() {
        parent::__construct();
        $this->model = D('Member');
    }

    public function login(){
    	if(IS_POST){
    		$this->model->checkLogin();
    	}else{
    		$this->display();
    	}
    }

    //个人中心
    public function index(){
        $this->is_login();
    	if(IS_POST){
    		$this->model->updateInfo();
    	}else{
            $member = $this->member;
	    	$this->assign('member',$member);
	    	$this->display();
    	}
    }

    //修改会员头像
    public function updateHeadimg(){
    	$head_img = I('request.head_img');
    	$member = $this->member;
    	if($head_img){
    		$res = M('member')->where(array('id'=>$member['id']))->setField(array('head_img'=>$head_img));
    		if($res){
    			$member = M('member')->find($member['id']);
    			session('member',$member);
    			$this->ajax_check('修改成功',1);
    		}else{
    			$this->ajax_check('修改失败');
    		}
    	}
    }

    //修改资料
    public function info(){
        if(IS_POST){
            $this->model->updateInfo();
        }else{
            $member = $this->member;
            $this->assign('member',$member);
            $this->display();
        }
    }

    //登出
    public function logout(){
        session('member',null);
        $this->redirect('Member/login');
    }

}