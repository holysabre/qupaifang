<?php
namespace Home\Controller;
use Think\Controller;
class ArticleController extends BaseController {

    public $model;
	public function __construct() {
        parent::__construct();
        $this->model = D('Article');
        $category = D('Category')->getCategory('news');
        $this->assign('Category',$category);
    }

    public function index(){
        $recommend = $this->model->getListStatus('1',3);
        $this->assign('Recommend',$recommend);

        $list = $this->model->getList();
        $this->assign('List',$list['list']);
        $this->assign('Page',$list['page']);
        $this->assign('Count',$list['count']);

    	$this->display();
        //dumps($list);
    }
    
    public function detail(){
        $info = $this->model->getInfo();
        $this->assign('Info',$info);
    	$this->display();
    }

}