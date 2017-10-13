<?php
namespace Home\Controller;
use Think\Controller;
class EvaluationController extends BaseController {

    public $model;
	public function __construct() {
        parent::__construct();
        $this->model = D('Evaluation');
    }

    public function index(){
        if(IS_POST){
            $this->model->message();
        }else{
            $this->display();
        }
    }
}
