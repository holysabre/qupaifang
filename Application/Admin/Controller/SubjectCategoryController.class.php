<?php
namespace Admin\Controller;
use Think\Controller;
class SubjectCategoryController extends BaseController {

    private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('SubjectCategory');
    }

    public function index(){
        $list = $this->model->index();
        $list = tree_list($list);
        $this->assign('list',$list);
        $this->display();
    }

    public function edit(){
        $id = I('id',0);
        if(IS_POST){
            $this->model->edit($id);
        }else{
            $info = $this->model->findOne($id);
            $this->assign('info',$info);
            $category = $this->model->findAll();
            $category = tree_list($category);
            $this->assign('category',$category);
            $this->display();
        }
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }



}