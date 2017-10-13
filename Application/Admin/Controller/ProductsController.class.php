<?php
namespace Admin\Controller;
use Think\Controller;
class ProductsController extends BaseController {

    private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('Products');
    }

    public function index(){
        $data = $this->model->index();
        $category = D('Category')->index('products');
        $category = lists_key($category);
        $this->assign('data',$data);
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
            $category = D('Category')->findAll('products');
            $category = tree_list($category);
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
        $data = D('Category')->index('products');
        $data = tree_list($data);
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
            $category = D('Category')->findAll('products');
            $category = tree_list($category);
            $this->assign('category',$category);
            $this->assign('default_tpl','products');
            $this->assign('default_type','products');
            $this->display();
        }
    }

    //分类删除
    public function categoryDelete(){
        D('Category')->deleteOne();
    }
}