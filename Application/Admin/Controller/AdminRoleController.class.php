<?php
namespace Admin\Controller;
use Think\Controller;
class AdminRoleController extends BaseController {

	private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('AdminRole');
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
    		$this->display();
    	}
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }

    //角色
    public function role(){
        $this->display();
    }

}