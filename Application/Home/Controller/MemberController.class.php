<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends BaseController {

	private $model;
	public function __construct() {
        parent::__construct();
        $this->model = D('Member');
        //检测会员是否登录
        $this->is_login();
    }

    //登录
    public function login(){
    	if(IS_POST){
    		$this->model->login();
    	}
    }

    //短信登录
    public function login_sms(){
        if(IS_POST){
            $this->model->loginSms();
        }
    }

    //个人中心
    public function index(){
        $this->redirect('Member/base_info');
    }

    //基本信息
    public function base_info(){
        if(IS_POST){
            $this->model->updateInfo();
        }else{
            $member = $this->member;
            $info = $this->model->getInfo();
            //dumps($info);
            $this->assign('info',$info);
            $this->display();
        }
    }

    //修改密码
    public function password(){
        if(IS_POST){
            $this->model->updatePassword();
        }else{
            $this->display();
        }
    }

    //修改支付密码
    public function pay_password(){
        if(IS_POST){
            $this->model->updatePayPassword();
        }else{
            $this->display();
        }
    }

    //修改会员头像
    public function update_head_img(){
    	$this->model->updateInfo();
    }

    //登出
    public function logout(){
        session('member',null);
        // $this->ajax_check('登出成功',1,U('Index/index'));
        $this->redirect('Index/index');
    }

    //注册
    public function reg(){
        $res = $this->model->reg();
        if($res){
            $this->ajax_check('注册成功',1,'',U('Member/index'));
        }else{
            $this->ajax_check('注册失败',0);
        }
    }

    //我的账户信息
    public function account(){
        $info = $this->model->getAccount();
        $this->assign('info',$info);
        $this->display();
    }

    //我要充值
    public function recharge(){
        $info = $this->model->getAccount();
        $this->assign('info',$info);
        $this->display();
    }

    //我要提现
    public function withdrawals(){
        $info = $this->model->getAccount();
        $this->assign('info',$info);
        $this->display();
    }

    //保证金
    public function bond(){
        $this->display();
    }

    //我的收藏
    public function collection(){
        $data = D('Subject')->getListsByTerm('collection');
        $this->assign('data',$data);
        $this->assign('current','collection');
        $this->assign('crumbs','<a href="'.U('Member/collection').'">拍购</a><i class="iconfont">&#xe60d;</i> 我的收藏');
        $this->display('Member/lists');
        //dumps($data);
    }

    //拍购报名标的
    public function buy_lists(){
        $data = D('Subject')->getListsByTerm('Bond');
        $this->assign('data',$data);
        $this->assign('crumbs','<a href="'.U('Member/buy_lists').'">拍购</a><i class="iconfont">&#xe60d;</i> 报名标的');
        $this->display('Member/lists');
        //dumps($data);
    }

    //拍购成交标的
    public function buy_deal(){
        $data = D('Subject')->getDeal('buy');
        $this->assign('data',$data);
        $this->assign('crumbs','<a href="'.U('Member/buy_deal').'">拍购</a><i class="iconfont">&#xe60d;</i> 成交标的');
        $this->display('Member/lists');
    }

    //上架标的
    public function shelves(){
        $where['m_id'] = $this->m_id;
        $list = D('Subject')->getList();
        $this->assign('List',$list['list']);
        $this->assign('Page',$list['page']);
        $this->assign('Count',$list['count']);
        $this->display();
    }

    //拍售成交标的
    public function sell_deal(){
        $data = D('Subject')->getDeal('sell');
        $this->assign('data',$data);
        $this->assign('crumbs','<a href="'.U('Member/sell_deal').'">拍购</a><i class="iconfont">&#xe60d;</i> 成交标的');
        $this->display('Member/lists');
    }

    //展示标的详情
    public function show_sell(){
        $info = D('Subject')->getInfo();
        $this->assign('Info',$info);
        $this->display();
        dumps($info);
    }

    //出售 第一步
    public function sell(){
        if(IS_POST){
            $result = D('Subject')->agree();
        }else{
            $this->display();
        }
    }

    //填写房屋基本信息 第二步
    public function sell2(){
        $action = I('request.action');
        $this->assign('action',$aciton);
        if(IS_POST){
            $result = D('Subject')->houseInfo();
        }else{
            $info = D('Subject')->getInfo();
            $this->assign('Info',$info);
            $this->display();
            //dumps($info);
        }
    }

    //等待审核
    public function sell4(){
        $this->display();
    }


    //检测会员是否登录
    public function is_login(){
        $action = array('login','login_sms','ajax_sendsms','reg');

        $member = $this->member;
        if(!$member){
            if(in_array(ACTION_NAME,$action)){
                return true;
            }else{
                $this->error('请先登录',U('Index/index'));
            }
        }else{
            $result = $this->model->completeInfo($member['id']);
            if(!$result && ACTION_NAME != 'base_info'){
                $this->redirect('Member/base_info');
            }
        }
    }

    //发送短信验证码 ajax
    public function ajax_sendsms(){
        $mobile = I('request.mobile');
        //生成验证码
        $code = rand ( 1000, 9999 );
        $sms_code = array(
            'code' => $code,
            'time' => time()
        );
        //写入session
        session('sms_code',$sms_code);
        //发送短信
        import('Common/ORG/Sms');
        $sms = new \Sms();
        //测试模式
        $status = $sms->send_verify($mobile, $code);
            
        if ($status) {
            $this->ajax_check('短息发送成功',1);
        }else{
            $this->ajax_check('短信发送失败',0,$sms->error);
        }
    }

    //上下架标的
    public function change_shelves(){
        $result = D('Subject')->changeSubject();
    }

    //删除标的
    public function delete_subject(){
        $result = D('Subject')->delete();
    }

}