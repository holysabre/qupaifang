<?php
namespace Wap\Model;
use Think\Model;
class MemberModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //检查登录
    public function checkLogin(){
        $username = I('request.username');
        $password = I('request.password');
        $yzcode = I('request.yzcode');

        if (empty($username)) {
            $this->ajax_check('用户名不能为空!');
        }            
        if (empty($password)) {
            $this->ajax_check('密码不能为空!');
        }
        // if (empty($yzcode)) {
        //     $this->ajax_check('请输入验证码!');
        // }
        // $Verify = new \Think\Verify();
        // $code   = $Verify->check($yzcode,'v_1');
        // if($code !== true) {
        //     $this->ajax_check('验证码错误!');
        // }
        $where = array('username'=>$username, 'password'=>md5($password));
        $info  = $this->field(true)->where($where)->find();

        if($info){
            if ($info['is_enable'] == 0) {
                $this->ajax_check('账户已被冻结!');
            }
            $session = array();
            $session = $info;
            unset($session['password']);
            session('member', $session);
            $data = array();
            $data['login_times'] = $info['login_times']+1;
            $data['login_time']   = time();
            $data['login_ip']     = get_client_ip();
            $data['time']  = time();
            $result = $this->where( array('id'=>$info['id']) )->save($data);
            if($result) {
                $this->ajax_check('登录成功!', 1);
            }
        }
        $this->ajax_check('用户名或密码错误!');
    }

    //更新会员信息
    public function updateInfo(){
        $data = $this->create();
        if($data){
            $data['time'] = time();
            $res = $this->save($data);
            if($res){
                $member = $this->find($data['id']);
                session('member',$member);
                $this->ajax_check('修改信息成功',1);
            }else{
                $this->ajax_check('修改信息失败，请刷新后重试');
            }
        }
    }

}