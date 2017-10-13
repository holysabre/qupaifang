<?php
namespace Wap\Model;
use Think\Model;
class BaseModel extends Model {

    public $member;
	public function __construct() {
        parent::__construct();
        $this->member = session('member');
    }

    // 异步返回数据
    public function ajax_check($message = '', $status = 0, $data = '', $jumpUrl = '') {
        header('Content-Type:application/json; charset=utf-8');
        $_data = array();
        $_data['msg']= $message;
        $_data['status'] = $status;
        $_data['url']    = $jumpUrl;
        $_data['data']   = $data;
        exit(json_encode($_data));
    }
}