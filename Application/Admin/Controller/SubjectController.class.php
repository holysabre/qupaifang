<?php
namespace Admin\Controller;
use Think\Controller;
class SubjectController extends BaseController {

    private $model = '';
    public function __construct() {
        parent::__construct();
        $this->model = D('Subject');
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
            //房屋类型
            $building_type = D('SubjectCategory')->getListByPid(2);
            $this->assign('building_type',$building_type);
            $config = $this->config;
            //标的物类型
            $s_cate = D('SubjectCategory')->findAll();
            $this->assign('subject_category',$s_cate);
            //标的物城市
            $s_city = D('SubjectCity')->findAll();
            $this->assign('subject_city',$s_city);
            //竞拍状态
            $this->assign('stat_status',$config['stat_status']['value']);
            //上架
            $this->assign('stat_shelves',$config['stat_shelves']['value']);
            //审核
            $this->assign('stat_examine',$config['stat_examine']['value']);

            $info = $this->model->findOne($id);
            $this->assign('info',$info);
            $this->display();
            dumps($config);
        }
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }

    
}   