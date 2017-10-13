<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class LoginController extends CommonController {

    public function __construct() {
        parent::__construct();
    }

    //登录
    public function login(){
        if(IS_POST){
            D('admin')->login();
        }else{
            $this->display();
        }
    }

    //登出
    public function loginout(){
        session(ADMINPANGE,null);
        $this->success('Login/login');
    }

}