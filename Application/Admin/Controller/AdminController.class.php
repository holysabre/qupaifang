<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends BaseController {

	private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('Admin');
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
    		$info = $this->model->findOne($id);
    		$this->assign('info',$info);
            $role = D('AdminRole')->findAll();
            $this->assign('role',$role);
    		$this->display();
    	}
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }

    //角色
    public function role(){
        $data = D('AdminRole')->index();
        $this->assign('data',$data);
        $this->display();
    }

    //角色编辑
    public function role_edit(){
        $id = I('request.id',0);
        if(IS_POST){
            D('AdminRole')->edit($id);
        }else{
            $info = D('AdminRole')->findOne($id);
            $this->assign('info',$info);
            $nodes = D('AdminRole')->getNodes();
            $this->assign('nodes',$nodes);
            $this->display();
        }
    }

    //删除角色
    public function deleteRole(){
        return D('AdminRole')->deleteOne();
    }

}