<?php
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends BaseController {

	private $model = '';
    private $type = array();
    private $group = array();
    public function __construct() {
        parent::__construct();
        $this->model = D('Config');
        $config = C('admin_config');
        $this->type = explode(',', $config['system_type']['value']);
        $this->group = explode(',', $config['system_group']['value']);
        $this->assign('type',$this->type);
        $this->assign('group',$this->group);
    }

    public function index(){
    	$data = $this->model->index();
    	$this->assign('data',$data);
        $this->display();
        //dumps($data);
    }

    public function edit(){
    	$id = I('id',0);
    	if(IS_POST){
    		$this->model->edit($id);
    	}else{
            if($id){
                $info = $this->model->findOne($id);
            }else{
                $info['type'] = 1;
                $info['group'] = 2;
            }
    		$this->assign('info',$info);
            //dumps($info);
    		$this->display();
    	}
    }

    public function setting(){
        if(IS_POST){
            $this->model->updateSetting();
        }
        $setting = $this->model->getSetting();
        $this->assign('setting',$setting);
        $this->display();
    }

    // 删除
    public function delete() {
        $this->model->deleteOne();
    }
}