<?php
namespace Admin\Controller;
use Think\Controller;
class LinkController extends BaseController {

	private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('Link');
    }

    public function index(){
    	$data = $this->model->index();
        $this->assign('data',$data);
        $category = D('Category')->findAll('link');
        $category = lists_key($category);
        $this->assign('category',$category);
        $this->display();
    }

    public function edit(){
    	$id = I('id',0);
    	if(IS_POST){
    		$this->model->edit($id);
    	}else{
    		$info = $this->model->findOne($id);
    		$this->assign('info',$info);
            $category = D('Category')->findAll('link');
            $this->assign('category',$category);
    		$this->display();
    	}
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }

    //分类列表
    public function category(){
        $data = D('Category')->index('link');
        $this->assign('data',$data);
        $this->display();
    }

    //分类新增/修改
    public function category_edit(){
        $id = I('id',0);
        if(IS_POST){
            D('Category')->edit($id);
        }else{
            $info = D('Category')->findOne($id);
            $this->assign('info',$info);
            $category = D('Category')->findAll('link');
            $category = tree_list($category);
            $this->assign('category',$category);
            $this->assign('default_tpl','link');
            $this->assign('default_type','link');
            $this->display();
        }
    }

    //分类删除
    public function categoryDelete(){
        D('Category')->deleteOne();
    }
}