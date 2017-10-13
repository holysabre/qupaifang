<?php
namespace Admin\Controller;
use Think\Controller;
class MenuController extends BaseController {

	private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('Menu');
    }

    public function index(){
    	$data = $this->model->index();
    	$data = tree_list($data);
    	$this->assign('data',$data);
        $this->display();
        //dumps($data);
    }

    public function edit(){
    	$id = I('id',0);
    	if(IS_POST){
    		$this->model->edit($id);
    	}else{
    		$info = $this->model->findOne($id);
    		$this->assign('info',$info);
            //dumps($info);
    		$menu = $this->model->findAll();
    		$menu = tree_list($menu);
    		$this->assign('menu',$menu);
    		$this->display();
    	}
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }
}