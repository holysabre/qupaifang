<?php
namespace Home\Model;
use Think\Model;
class MemberModel extends BaseModel {

    public $m_id;
    public function __construct() {
        parent::__construct();
        $member = $this->member;
        $this->m_id = $member?$member['id']:0;
    }

    //检查登录
    public function login(){
        $username = I('request.username');
        $password = I('request.password');
        $verifycode = I('request.verifycode');
        
        if (empty($username)) {
            $this->ajax_check('用户名不能为空!');
        }
        if (empty($password)) {
            $this->ajax_check('密码不能为空!');
        }

        //验证码
        if(!$verifycode){
            $this->ajax_check('请输入验证码');
        }else{
            $Verify = new \Think\Verify();
            $code   = $Verify->check($verifycode, 'v_login');
            if($code !== true) {
                $this->ajax_check('验证码错误');
            }
        }

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
                $this->ajax_check('登录成功!', 1,'',U('Member/index'));
            }
        }
        $this->ajax_check('用户名或密码错误!');
    }

    //登录 短信验证码
    public function loginSms(){
        $code = I('request.code');
        $mobile = I('request.mobile');
        $session_smscode = session('sms_code');
        //检测短信验证码
        if($session_smscode['time'] > time() +300){
            //超过时间 5分钟
            $this->ajax_check('验证码已超时');
        }
        if($session_smscode['code'] != $code){
            $this->ajax_check('验证码错误');
        }
        //检测手机号码是否已经注册
        if(!$this->checkIssetMobile($mobile)){
            //直接注册为会员，并登录
            $this->reg_member($mobile);
        }else{
            $where['username'] = $mobile;
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
                    $this->ajax_check('登录成功!', 1,'',U('Index/index'));
                }
            }
            $this->ajax_check('用户名或密码错误!');
        }
    }

    //注册
    public function reg(){
        $mobile = I('request.mobile');
        $code = I('request.code');
        $session_smscode = session('sms_code');
        //检测短信验证码
        if($session_smscode['time'] > time() +300){
            //超过时间 5分钟
            $this->ajax_check('验证码已超时');
        }
        if($session_smscode['code'] != $code){
            $this->ajax_check('验证码错误');
        }
        //检测是否已经注册
        $result = $this->checkIssetMobile($mobile);
        if($result){
            $this->ajax_check('此手机号码已经注册，请直接登录');
        }
        $this->reg_member($mobile);
    }

    //注册为会员 公用
    //并登录写入session
    public function reg_member($mobile){
        $data = array();
        $data['username'] = $mobile;
        $data['mobile'] = $mobile;
        $data['login_times'] = 1;
        $data['add_time'] = 1;
        $data['login_time']   = time();
        $data['login_ip']     = get_client_ip();
        $data['time'] = time();
        if($add = $this->add($data)){
            $member = $this->find($add);
            session('member',$member);
            $this->ajax_check('注册成功',1,'',U('Index/index'));
        }else{
            $this->ajax_check('注册失败');
        }
    }    

    //更新会员信息
    public function updateInfo(){
        $member = $this->member;
        $repassword = I('request.repassword');
        $re_pay_password = I('request.re_pay_password');

        $data = $this->create();

        $headpic = I('request.head_pic');
        if($headpic){
            $data['head_img'] = $headpic;
        }

        if($data['password'] != ''){
            if($data['password'] != '' && $repassword != ''){
                if($data['password'] != $repassword){
                    $this->ajax_check('两次密码必须一致');
                }else{
                    $data['password'] = md5($data['password']);
                }
            }else{
                $this->ajax_check('请输入密码');
            } 
        }else{
            unset($data['password']);
        }

        //验证支付密码
        if($data['pay_password'] != ''){
            if($data['pay_password'] != '' && $re_pay_password != ''){
                if($data['pay_password'] != $re_pay_password){
                    $this->ajax_check('两次密码必须一致');
                }else{
                    if($data['password'] == md5($data['pay_password'])){
                        $this->ajax_check('支付密码不能和密码相同');
                    }
                    $data['pay_password'] = md5($data['pay_password']);
                }
            }else{
                $this->ajax_check('请输入支付密码');
            } 
        }else{
            unset($data['pay_password']);
        }

        if(isset($data['name']) && !$data['name']){
            $this->ajax_check('请输入姓名');
        }
        if(isset($name['address']) && !$name['address'] && $name['address'] != '详细地址'){
            $this->ajax_check('请输入详细地址');
        }
        if(isset($name['certificates_number']) && !$name['certificates_number'] && $name['certificates_number'] != '证件号'){
            $this->ajax_check('请输入证件号码');
        }

        $data['time'] = time();
        $where = array();
        $where['id'] = $this->m_id;
        $result = $this->where($where)->save($data);
        if($result){
            $this->completeInfo($this->m_id);
            $this->updateMemberSession();//更新session
            $this->ajax_check('修改成功',1,'',U('Member/base_info'));
        }else{
            $this->ajax_check('修改失败，请刷新后再次尝试');
        }

    }

    //获取会员信息
    public function getInfo($id){
        $id = $id ? $id : $this->m_id;
        $info = $this->find($id);
        return $info;
    }

    //检查手机号码是否已经存在
    public function checkIssetMobile($mobile){
        $where = array();
        $where['username'] = $mobile;
        $result = $this->where($where)->find();
        return $result;
    }

    //检测信息是否完整
    public function completeInfo($id){
        $id = !$id ? $this->m_id : $id;
        $info = $this->find($id);
        if($info['is_complete'] == 1){
            return true;
        }else{
            if($info['name'] == '' || $info['address'] == '' || $info['certificates_number'] == '' || $info['password'] == ''  || $info['pay_password'] == ''){
                return false;
            }else{
                $bid_no = $this->createBidNo($info['name']);
                $result = $this->where('id='.$id)->setField(array('is_complete'=>1,'bid_no'=>$bid_no));
            }
        }
    }

    //更新会员session
    public function updateMemberSession($id){
        $id = !$id ? $this->m_id : $id;
        $info = $this->find($id);
        session('member',$info);
    }

    //修改密码
    public function updatePassword(){
        $sms_code = I('request.sms_code');
        $password = I('request.password');
        $repassword = I('request.repassword');

        if(!$password || !$repassword){
            $this->ajax_check('密码不能为空');
        }

        if($password != $repassword){
            $this->ajax_check('两次密码不相同，请检查后重新提交');
        }

        if(!$sms_code){
            $this->ajax_check('请输入短信验证码');
        }

        //验证短信验证码
        $_smscode = session('sms_code');
        if($_smscode['time'] + 300 < time()){
            $this->ajax_check('验证码已过时，请重新获取');
        }else{
            if($_smscode['code'] != $sms_code){
                $this->ajax_check('短信验证码错误');
            }
        }

        $member = $this->member;
        $where['id'] = $member['id'];
        $data['password'] = md5($password);
        $data['time'] = time();
        $result = $this->where($where)->save($data);
        //echo $this->_sql();
        if($result){
            $this->ajax_check('修改成功',1);
        }else{
            $this->ajax_check('修改失败，请稍后重试');
        }
        
    }

    //修改支付密码
    public function updatePayPassword(){
        $sms_code = I('request.sms_code');
        $pay_password = I('request.pay_password');
        $re_pay_password = I('request.re_pay_password');

        if(!$pay_password || !$re_pay_password){
            $this->ajax_check('密码不能为空');
        }

        if($pay_password != $re_pay_password){
            $this->ajax_check('两次密码不相同，请检查后重新提交');
        }

        if(!$sms_code){
            $this->ajax_check('请输入短信验证码');
        }

        //验证短信验证码
        $_smscode = session('sms_code');
        if($_smscode['time'] + 300 < time()){
            $this->ajax_check('验证码已过时，请重新获取');
        }else{
            if($_smscode['code'] != $sms_code){
                $this->ajax_check('短信验证码错误');
            }
        }

        $member = $this->member;
        $where['id'] = $member['id'];
        $data['pay_password'] = md5($pay_password);
        $data['time'] = time();
        $result = $this->where($where)->save($data);
        //echo $this->_sql();
        if($result){
            $this->ajax_check('修改成功',1);
        }else{
            $this->ajax_check('修改失败，请稍后重试');
        }
        
    }

    //生成竞拍号   实名认证通过后生成
    public function createBidNo($name){
        $bid_no = strtoupper(substr(yd_pinyin($name),0,1)).rand(10000,99999);
        $where['bid_no'] = $bid_no;
        $result = $this->where($where)->find();
        if($result){
            $this->createBidNo($name);
        }else{
            return $bid_no;
        }
    }

    //获取账户信息
    public function getAccount(){
        $member = $this->member;
        $m_id = $member['id'];
        $type = I('request.type');
        $where['m_id'] = $m_id;
        $info = M('member_account')->where($where)->find();

        $log_list = $this->getAccountLog($info['id'],$type);
        $info['log_list'] = $log_list;

        return $info;
    }

    //获取账户交易记录
    public function getAccountLog($id,$type){
        $where['account_id'] = $id;
        if($type){
            $where['type'] = $type;
        }
        $list = M('member_account_log')->where($where)->select();
        return $list;
    }

}