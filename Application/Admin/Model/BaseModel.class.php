<?php
namespace Admin\Model;
use Think\Model;
class BaseModel extends Model {

    public $admin;
    public function __construct(){
        parent::__construct();
        $this->admin = session(ADMINPANGE);
    }

	// 管理员日志-添加日志
    public function admin_log_add($user_name, $action, $type = 1) {
        $log = array();
        $log['type']        = $type;
        $log['create_time'] = time();
        $log['user_name']   = empty($user_name) ? $this->admin['adminname'] : $user_name;
        $log['action']      = $action;
        $log['ip']          = get_client_ip();
        M('log')->add($log);
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