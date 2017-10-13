<?php
namespace Home\Model;
use Think\Model;
class MailModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //站内信
    public function sendMail(){
        $data = $this->create();
        if($data){
	        $data['time'] = time();
	        $res = $this->add($data);
	        if($res){
	        	$this->ajax_check('成功',1);
	        }else{
	        	$this->ajax_check('失败');
	        }
    	}
    }

}