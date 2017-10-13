<?php
namespace Admin\Controller;
use Think\Controller;
class MemberController extends BaseController {

	private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('Member');
    }

    public function index(){
    	$data = $this->model->index();
    	$this->assign('data',$data);
        $this->display();
    }

    public function edit(){
    	$id = I('id',0);
    	if(IS_POST){
    		$this->model->edit($id);
    	}else{
            $group = D('member_group')->group();
            $group = tree_list($group);
            $this->assign('group',$group);
    		$info = $this->model->findOne($id);
    		$this->assign('info',$info);
    		$this->display();
    	}
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }

    //收货地址
    public function address(){
        $id = I('request.id');
        $data = D('Address')->getList($id);
        $this->assign('data',$data);
        $this->display();
    }

    //会员组
    public function group(){
        $data = $this->model->group();
        $this->assign('data',$data);
        $this->display();
    }

    //会员组编辑
    public function group_edit(){
        $id = I('id',0);
        if(IS_POST){
            
            $this->model->groupEdit($id);
        }else{
            $info = $this->model->findGroupOne($id);
            $this->assign('info',$info);
            $this->display();
        }
    }

    //会员个人账户
    public function wallet(){
        $id = I('request.id',0);
        $m_id = I('request.m_id');
        $this->assign('m_id',$m_id);
        if(IS_POST){
            $this->model->walletEdit($id);
        }else{
            $info = $this->model->wallet($id);
            $this->assign('info',$info);
            $this->display();
        }
    }

}