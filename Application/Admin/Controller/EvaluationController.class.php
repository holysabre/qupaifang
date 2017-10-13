<?php
namespace Admin\Controller;
use Think\Controller;
class EvaluationController extends BaseController {

	private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('Evaluation');
    }

    public function index(){
    	$data = $this->model->index();
    	$this->assign('data',$data);
        $this->display();
    }

    public function edit(){
        $id = I('request.id');
    	$info = $this->model->findOne($id);
        $this->assign('info',$info);
        $this->display();
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }
}