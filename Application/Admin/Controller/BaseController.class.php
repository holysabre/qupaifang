<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
class BaseController extends CommonController {

    public $_name   = null;
    public $admin;
    public function __construct() {
        parent::__construct();

        //管理员信息
        $this->admin = $admin = session(ADMINPANGE);
        $this->assign('admin',$admin);

        // 控制器名称
        $this->_name = substr(get_class($this), 17, -10);

        // 动作名
        $mName = strtolower(ACTION_NAME);

        // 判断是否登陆
        $NoCheckAction = array('login', 'verify', 'loginout');
        if (!$this->isLogin() && !in_array($mName, $NoCheckAction)) {
            redirect(U('login/login'));exit;
        }

        //配置
        $config = C('admin_config');
        $this->assign('config',$config);

        // 检测管理权限
        if ($this->checkPurview() === false) {
            redirect(U('index/home'));
        }
    }

    //异步修改字段值
    public function ajax_edit(){
        $table = I('request.table');
        $id = I('request.id');
        $field = I('request.field');
        $val = I('request.val');
        if($table){
            $res = M($table)->where("id=$id")->setField($field,$val);
            if($res){
                $this->ajax_check('修改成功',1);
            }else{
                $this->ajax_check('修改失败',0,M()->_sql());
            }
        }
    }

    //清除缓存
    public function clear_cache($table = ''){
        if(empty($table)){
            $table = I('request.table');
        }
        if($table){
            $res = D('Cache')->cache($table);
            $this->ajax_check('更新缓存',1);
        }
    }

    // 判断是否登陆
    public function isLogin() {
        return $this->admin['adminid'];
    }

    // 检测管理权限
    public function checkPurview() {
        if ($this->admin['adminroleid'] == 1) {
            return true;
        }
        
        // 控制器名
        $cName = strtolower(CONTROLLER_NAME);
        $CheckController = 'index,article,page,product,upload';
        if (in_array($cName, explode(',', $CheckController))) {
            return true;
        }
        
        // 方法名
        $aName = strtolower(ACTION_NAME);
        $CheckAction = 'link';
        if (in_array($aName, explode(',', $CheckAction))) {
            return true;
        }
        
        $menuid = I('request.menuid');
        $list = D('AdminRole')->nodes($this->admin['adminroleid']);
        
        if (!is_numeric($menuid)) {
            return true;
        }
        
        $list = explode(",", $list);
        if ( in_array($menuid, $list) ){
            return true;
        }
        return false;
    }
    

}