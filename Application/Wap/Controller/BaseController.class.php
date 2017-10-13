<?php
namespace Wap\Controller;
use Common\Controller\CommonController;
class BaseController extends CommonController {

    public $member;
	public function __construct() {
        parent::__construct();
       	$this->navigation();
        $this->member = session('member');
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

    //检测会员是否登录
    public function is_login(){
        $member = $this->member;
        if(!$member){
            $this->redirect('Member/login');
        }
        return true;
    }

    //获取站点设置
    public function getSite(){
        $site = S('site');
        if(!$site){
            $where = array();
            $where['is_show'] = 1;
            $site = M('config')->where($where)->select();
            S('site',$site);
        }
        foreach ($site as $key => $value) {
            $_site[$value['name']] = $value['value'];
        }
        $this->assign('site',$_site);
    }

        
}