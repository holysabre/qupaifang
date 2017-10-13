<?php
namespace Admin\Controller;
use Think\Controller;
class WechatController extends BaseController {

	private $model = '';
    private $action = '';
    public function __construct() {
        parent::__construct();
        
        import('weixin', APP_PATH .'Common/Common', '.php');
        
        $this->model = D('Wechat');
        
        $type = array(
            'click'=>'点击推事件',
            'view'=>'跳转URL',
            'scancode_push'=>'扫码推事件',
            'scancode_waitmsg'=>'扫码带提示',
            'pic_sysphoto'=>'弹出系统拍照发图',
            'pic_photo_or_album'=>'弹出拍照或者相册发图',
            'pic_weixin'=>'弹出微信相册发图器',
            'location_select'=>'弹出地理位置选择器',
            'none'=>'无事件的一级菜单'
        );
        $this->assign('type', $type);
        
        $this->assign('keyword_type',   $keyword_type = array(
            1 => array('id'=>1,'name'=>'完全匹配'),
            2 => array('id'=>2,'name'=>'左边匹配'),
            3 => array('id'=>3,'name'=>'右边匹配'),
            4 => array('id'=>4,'name'=>'模糊匹配'),
            )
        );
        
        $this->assign('replytype',      $replytype = array('无','图文','文本'));

        $this->assign('action',         $action = I('get.action', 'reply'));
    }

    //公众号设置
    public function config(){
        if(IS_POST){
            $this->model->configEdit(10);
        }else{
            $info = $this->model->configInfo(10);
            $this->assign('info',$info);
            $this->display();
        }
    }

    //关注自动回复
    public function follow(){
        if(IS_POST){
            $this->model->follow();
        }else{
            $info = $this->model->configInfo(11);
            $this->assign('info',$info);
            $this->display();
        }
    }

    //自定义文本回复
    public function custom_text(){
        $data = $this->model->customList('text');
        $this->assign('data',$data);
        $this->display();
    }

    //自定义文本回复编辑
    public function custom_text_edit(){
        $id = I('request.id');
        if(IS_POST){
            $this->model->customEdit($id);
        }else{
            $info = $this->model->customInfo($id);
            $this->assign('info',$info);
            $this->display();
        }
    }

    //自定义图文回复
    public function custom_reply(){
        $data = $this->model->customList('reply');
        $this->assign('data',$data);
        $this->display();
    }

    //自定义图文回复编辑
    public function custom_reply_edit(){
        $id = I('request.id');
        if(IS_POST){
            $this->model->customEdit($id);
        }else{
            $info = $this->model->customInfo($id);
            $this->assign('info',$info);
            $this->display();
        }
    }

    //自定义回复删除
    public function delete_custom(){
        $this->model->deleteCustom();
    }

    //自定义多图文
    public function custom_mult(){
        $data = $this->model->customList('mult');
        $this->assign('data',$data);
        $this->display();
    }
    
    //自定义多图文编辑
    public function custom_mult_edit(){
        $id = I('request.id');
        if(IS_POST){
            $this->model->customEdit($id);
        }else{
            $list = $this->model->customList('reply');
            $this->assign('list',$list);
            $info = $this->model->customInfo($id);
            $this->assign('info',$info);
            $this->display();
        }
    }

    //自定义图文列表
    public function custom_reply_all(){
        $data = $this->model->customList('reply');
        $this->assign('data',$data);
        $this->display();
    }
    
    //日志
    public function log(){
        $data = $this->model->log();
        $this->assign('data',$data);
        $this->display();
    }

    //日志详情
    public function log_detail(){
        $id = I('request.id');
        $info = $this->model->logDetail($id);
        $this->assign('info',$info);
        $this->display();
        dumps($info);
    }
}