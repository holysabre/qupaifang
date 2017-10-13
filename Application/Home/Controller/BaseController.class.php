<?php
namespace Home\Controller;
use Common\Controller\CommonController;
class BaseController extends CommonController {

    public $member;
	public function __construct() {
        parent::__construct();
       	$this->navigation();
        $this->member = session('member');
        $this->assign('member',$this->member);
        //获取站点设置
        $this->getSite();
    }

    //获取分类
    protected function navigation(){
    	$category = D('Category')->procategory('products');
    	//产品分类
        $products_category = list_to_tree($category);
        $this->assign('products_category',$products_category);
        //产品分类 树
        $products_category_tree = tree_list($category);
        $this->assign('products_category_tree',$products_category_tree);
    }

    //获取站点设置
    public function getSite(){
        //配置
        $config = C('admin_config');
        $this->assign('Config',$config);
    }

    //检测会员个人资料是否完整
    public function complete_info(){
        $member = $this->member;
        if($member['name'] == '' || $member['mobile'] == '' || $member['address'] == ''){
            return false;
        }else{
            return true;
        }
    }

        
}