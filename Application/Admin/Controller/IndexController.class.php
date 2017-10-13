<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {

    public function index(){
        $top_menu = D('Menu')->getTopMenu();
        $this->assign('top_menu',$top_menu);
        $this->display();
    }

    public function home(){
    	$this->display();
    }

    //显示图标
    public function icon(){
    	$this->display();
    }

    //根据id获取左侧菜单
    public function getLeftMenu(){
        $id = I('request.id');
        if($id){
            $menu = D('Menu')->getLeftMenu($id);
            $str = '<ul class="layui-nav layui-nav-tree left_menu_ul">';
            foreach ($menu as $k => $v) {
                $url = $v['url']==''?'javascript:;':$v['url'];
                $str .= '<li class="layui-nav-item">';
                $str .= '   <a href="'.U("$url").'" target="main">';
                $str .= '       <i class="fa '.$v['icon'].'"></i>';
                $str .= '       <cite>'.$v['name'].'</cite>';
                $str .= '   </a>';
                $str .= '</li>';
            }
            $str .= '</ul>';              
        }
        $this->ajax_check('success',1,$str);
    }

}