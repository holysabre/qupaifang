<?php
namespace Home\Controller;
use Think\Controller;
class PageController extends BaseController {

    public $model;
	public function __construct() {
        parent::__construct();
        $this->model = D('Page');
    }

    public function index(){
        $help_nav = $this->model->getNavigation(array('pid'=>1));
        $this->assign('help_nav',$help_nav);
        //dumps($help_nav);

        $info = $this->model->getInfo();
        $this->assign('Info',$info);
        $this->display();
    }
}
