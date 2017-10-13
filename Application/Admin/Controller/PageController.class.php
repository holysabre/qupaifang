<?php
namespace Admin\Controller;
use Think\Controller;
class PageController extends BaseController {

	private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('Page');
    }

    public function index(){
    	$data = $this->model->index();
    	$data = tree_list($data);
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
    		$page_list = $this->model->findAll();
    		$page_list = list_to_tree($page_list);
    		$this->assign('page_list',$page_list);
    		$this->display();
    	}
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }
}