<?php
namespace Common\Controller;
use Think\Controller;

class CommonController extends Controller {
    
    public $config = '';
    /** 
     * 说明
     * @access         访问    
     * @param array    数组
     * @param string   字符串
     * @param integer  整数
     * @param mixed    混合     
     * @param boolean  布尔     
     * @param void     无效 
     */
    public function __construct() {
        parent::__construct();
        header('content-type:text/html;charset=utf8;');

        //获取配置
        $config = D('Admin/Config')->getConfig();
        $this->config = $config;
        C('admin_config',$config);
        //dumps(C('admin_config'));


        // 系统配置项
        // if (false === $config = F('cache_config_home')) {
        //     $config = D('Admin/Cache')->cache_config_home(false);
        // }
        
        // $site = array();
        // foreach ($config AS $key=>$val) {
        //     // 剔除配置
        //     if (in_array($key, array('CONFIG_TYPE_LIST','CONFIG_GROUP_LIST'))) { continue; }
        //     $value = isset($val[LANG_SET]) ? $val[LANG_SET] : '';
        //     if ($val['lang'] == 0) { 
        //         $value = reset($val);
        //     }
        //     //if ($val['lang'] == 1 && empty($val[LANG_SET])) { $value = ''; }
        //     // 经纬度
        //     if (in_array($key, array('WEB_MAP_LNG','WEB_MAP_LAT'))) {
        //         $value = $val['value'];
        //     }
        //     // 微信
        //     if (in_array($key, array('WEB_STAT','WEB_THIRD_ONLINE','WEB_GONGSHANG','WX_PUBLIC','WX_WELCOME','WX_MENU','GUESTBOOK'))) {
        //         $value = unserialize($val['value']);
        //     }
        //     $site[$key] = $value;
        // }
        // C($site);
        // $site['support'] = L('site_support').': <a href="http://www.eglobe.cn/" target="_blank">eglobe.cn</a>';
        
        // //dumps($site);
        // $this->assign('Site',       $site);
        // $this->assign('Config',     $this->config = $config);
        // $this->assign('Catid',      0);
        // $this->assign('Catptitle',  '');
        // $this->assign('Catpid',     0);
        
        // // 关闭网站
        // if (empty($site['WEB_SITE_CLOSE'])) {
        //     $this->_empty('close_1.html', L('site_close'));
        //     exit();
        // }
        
    }
    
    // 返回错误404页面
    public function _empty($method = '', $content = '') {
        header('HTTP/1.0 404 Not Found');
        $fileName = THEME_PATH . 'Category/404.html';
        if (!is_file($fileName)) {
            $fileName = './Public/tpl/' . $method;
            if (!is_file($fileName)) {
                $fileName = './Public/tpl/' . C('TMPL_404');
            } 
        }
        $this->assign('content',  $content);
        $this->display($fileName);
    }
    
    // 验证码
    public function verify() {
        ob_clean();
        $verifyid           = I('get.verifyid', 1);
        $verifysize         = I('get.verifysize', 16);
        $Verify             = new \Think\Verify();
        $Verify->length     = 4;
        $Verify->fontSize   = $verifysize;
        $Verify->codeSet    = '0123456789';
        $Verify->fontttf    = '4.ttf';
        $Verify->useNoise   = false;
        return $Verify->entry('v_'.$verifyid);  
    }
    
    // 上传文件成功数组返回
    public function uploadFile() {
        
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        } elseif (isset($_GET["PHPSESSID"])) {
            session_id($_GET["PHPSESSID"]);
        }
        
        $upload = new \Think\Upload();// 实例化上传类
        $upload->rootPath = './upload/'; // 设置附件上传根目录
        $upload->savePath = 'image/'; // 设置附件上传（子）目录
        $upload->maxSize  = 1145728*2 ;// 设置附件上传大小2M
        
        $info = $upload->upload();
        if (!$info) {
            $array = array('status'=>0, 'img'=>'', 'data'=>$upload->getError());
        } else {
            $array = array('status'=>1, 'img'=>$info['img']['url'], 'data'=>'');
        }
        exit(json_encode($array));
    }
    
    /**
    * <a href="{:go_lang('zh-cn', true)}">中文</a>
    * <a href="{:go_lang('en-us', true)}">English</a>
    **/
    public function go() {
        $lang = C('LANG_OPEN') == true ? I('request.l', LANG_SET) : '';
        //if (C('URL_ROUTER_ON')) {
        if (in_array(C('URL_MODEL'), array(1, 2))) {
            header('Location: ' . U($lang . '/index'));
        } else {
            header('Location: ' . U('index/index', array('l' => $lang)));
        }
        
    }
    
    // 提交留言信息
    public function guestbook() {
        $messagearr = L('messagearr');
        $guestbook  = $this->config['GUESTBOOK'];
        // 留言权限
        switch ($guestbook['ALLOW']) {
            case 0: // 禁止留言
                $this->ajax_check($messagearr['guestbook_forbidden']);
                break;
            case 1: // 允许匿名留言
                break;
        }
        
        // 启用验证码
//      if ($guestbook['VERIFYCODE'] == 1) { 
//          $verifycode = I('post.verifycode');
//          if (empty($verifycode)) {
//              $this->ajax_check($messagearr['verify_code_required']);
//          }
//          
//          $Verify = new \Think\Verify();
//          $code   = $Verify->check($verifycode, 'book');
//          if($code !== true) {
//              $this->ajax_check($messagearr['verify_code_error']);
//          }
//      }
        D('Admin/Guestbook')->postGuestBbook();
    }
    
    // 异步返回数据
    public function ajax_check($message = '', $status = 0, $data = array(), $jumpurl = '') {
        $ajax = array();
        $ajax['status'] = $status;
        $ajax['msg']= $message;
        $ajax['jumpurl']= $jumpurl;
        $ajax['data']   = $data;
        exit(json_encode($ajax));
    }
    
    // 模拟操作
    public function api_notice_increment($url, $data, $method = 'POST') {
        $ch = curl_init();
        $header = 'Accept-Charset: utf-8';
        curl_setopt($ch, CURLOPT_URL, $url); //这是你想用PHP取回的URL地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method)); //当进行HTTP请求时，传递一个字符被GET或HEAD使用
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // FALSE 禁止 cURL 验证对等证书（peer's certificate）
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 设置为 1 是检查服务器SSL证书中是否存在一个公用名(common name)
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1); // HTTPS
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); // 设置 HTTP 头字段的数组
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)'); // 在HTTP请求中包含一个"User-Agent: "头的字符串。
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // TRUE 时将会根据服务器返回 HTTP 头中的 "Location: " 重定向
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // TRUE 时将根据 Location: 重定向时，自动设置 header 中的Referer:信息。
    
        if (strtoupper($method) == 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // 全部数据使用HTTP协议中的 "POST" 操作来发送
        }
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。
        $tmpInfo = curl_exec($ch);
        $errorno = curl_errno($ch);
    
        if ($errorno) {
            return array('status' => 0, 'message' => $errorno);
        }
        else {
            return $tmpInfo;
        }
    }

    

    
}
