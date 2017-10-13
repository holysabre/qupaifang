<?php
namespace Home\Controller;
use Think\Controller;
class MailController extends BaseController {

	public $model;
	public function __construct() {
        parent::__construct();
        $this->model = D('Mail');
    }

    public function send_mail(){
        if(IS_POST){
        	$this->model->sendMail();
        }else{
        	$this->display();
        }
    }

}