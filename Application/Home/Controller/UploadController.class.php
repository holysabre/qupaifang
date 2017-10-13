<?php
namespace Home\Controller;
use Think\Controller;
class UploadController extends BaseController {

	public function __construct() {
        parent::__construct();
    }

	// 上传文件成功数组返回
    public function uploadFile() {
        $path   = I('request.path');
        $ext    = I('request.ext');
        $size   = I('request.size', 2);
        
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        } elseif (isset($_GET["PHPSESSID"])) {
            session_id($_GET["PHPSESSID"]);
        }
        
        $upload = new \Think\Upload();// 实例化上传类
        $upload->rootPath = './upload/'; // 设置附件上传根目录
        $upload->savePath = $path ? $path.'/' : ''; // 设置附件上传（子）目录
        $upload->maxSize  = 1145728*$size ;// 设置附件上传大小2M
        $upload->exts     = $ext ? explode(',', $ext) : array('jpg', 'gif', 'png', 'jpeg', 'zip', 'rar', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'mp4');// 设置附件上传类型
        $info = $upload->upload();
        if(!$info) {
            return array('data'=>$upload->getError(), 'status'=>0);
        } 
        else {
            $url = $info['img']['url'];
            //水印开启，添加水印
            $config = C($config);
            if($config['ADMIN_WATER'] == 1 && $path == 'info'){
                $image = new \Think\Image(); 
                $image->open($url)->text($config['ADMIN_WATER_TEXT'],'./Public/fonts/wryh.ttf',$config['ADMIN_WATER_SIZE'],$config['ADMIN_WATER_COLOR'],$config['ADMIN_WATER_POS'])->save($url); 
            }
            $info['s']  = $url . '_s.jpg';
            $info['m']  = $url . '_m.jpg';
            $info['b']  = $url;
            return array('data'=>$info, 'status'=>1);
        }
    }



    // 上传图片并缩略图
    public function uploadThumb() {
        $thumbs = I('request.thumbs');
        $thumbm = I('request.thumbm');
        
        $info   = $this->uploadFile();
        $data   = $info['data'];
        if ($info['status'] == 1) {
            $image = new \Think\Image(); 
            if ($thumbs) {
                list($width, $height, $type) = explode('|', $thumbs);
                $image->open($data['b'])->thumb($width, $height, $type)->save($data['s']);
            }
            
            if ($thumbm) {
                list($width, $height, $type) = explode('|', $thumbm);
                $image->open($data['b'])->thumb($width, $height, $type)->save($data['m']);
            }
            
            $this->ajax_check('上传成功!', 1, $data);
        } 
        $this->ajax_check('上传失败', 0, $data);
    }
    
    // 上传文件成功异步返回
    public function upload() {
        $info   = $this->uploadFile();
        $data   = $info['data'];
        if ($info['status'] == 1) {
            $this->ajax_check('上传成功!', 1, $data);
        } 
        $this->ajax_check('上传失败', 0, $data);
    }

    // 编辑器上传文件成功异步返回
    public function editorUpload() {
        $info   = $this->uploadFile();
        $data   = $info['data'];
        if ($info['status'] == 1) {
            //当前台调用时 需要返回绝对路径
            $img_url = get_img($data['imgFile']['url']);
        	echo json_encode(array('message'=>'上传成功','status'=>1,'data'=>$img_url));exit;
        }
    }

    
    // 输出upload文件夹下的文件
    public function ImageManager() {
        $name   = I("get.name");
        $this->assign("Imagename", $name);
       
        $dir    = I("get.dir");
        $this->assign("dir", $dir);
        
        $multi  = I("get.multi", 'one');
        $this->assign("multi", $multi);
        
        $this->assign("ulink", 'Upload/ImageManager?name='.$name.'&dir='.$dir.'&multi='.$multi);
        
        $data   = $this->ImageManagerDirs($dir);
        $this->assign('data', $data);
        $this->display('Public:imagemanager');
        exit;
    }
    
    private function ImageManagerDirs($dir) {
        $php_path   = explode('App', dirname(__FILE__));
        $php_url    = explode('App', dirname($_SERVER['PHP_SELF']));;
        $ext_arr    = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
        
        $_path      = ($dir ? $dir.'/' : '');
        $root_path  = $php_path[0] . 'upload/' . $_path;
        $root_url   = './upload/'. $_path;
        if (!file_exists($root_url)) {
            $root_path = $php_path[0] . 'upload/';
            $root_url  = './upload/';
        }
        
        $path       = I('request.path');
        //根据path参数，设置各路径和URL
        if (empty($path)) {
            $current_path       = realpath($root_path) . '/';
            $current_url        = $root_url;
            $current_dir_path   = '';
            $moveup_dir_path    = '';
        } 
        else {
            $current_path       = realpath($root_path) . '/' . $path;
            $current_url        = $root_url . $path;
            $current_dir_path   = $path;
            $moveup_dir_path    = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }
        
        $result = array();
        
        //不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            $result['msg']       = '访问是不允许的';
            $result['file_list'] = array();
            return $result;
        }
        
        //最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            $result['msg']       = '参数无效';
            $result['file_list'] = array();
            return $result;
        }
        
        //目录不存在或不是目录
        if (!file_exists($current_path) || !is_dir($current_path)) {
            $result['msg']       = '目录不存在或不是目录';
            $result['file_list'] = array();
            return $result;
        }
        
        //遍历目录取得文件信息
        $file_list = array();
        if ($handle = opendir($current_path)) {
            $i = 0;
            while (false !== ($filename = readdir($handle))) {
                //if ($filename{0} == '.') continue;
                if ($filename{0} == '.' || strpos($filename,'_s.jpg') !== false || strpos($filename,'_m.jpg') !== false ) continue;
                $file = $current_path . $filename;
                if (is_dir($file)) {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0; //文件大小
                    $file_list[$i]['is_photo'] = false; //是否图片
                    $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                    $file_list[$i]['filejson'] = ''; 
                } else {
                    $file_list[$i]['is_dir'] = false;
                    $file_list[$i]['has_file'] = false;
                    $file_list[$i]['filesize'] = filesize($file);
                    $file_list[$i]['dir_path'] = '';
                    $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                    $file_list[$i]['filetype'] = $file_ext;
                    $s = $current_url.(strpos($filename, '_s.jpg') ? $filename : $filename.'_s.jpg');
                    $file_list[$i]['filejson'] = '"status":1,"message":"上传成功","ext":"'.$file_ext.'","data":{"s":"'.$s.'","m":"","b":"'.($current_url.$filename).'"}';
                    //{"status":0,"data":{"s":1,"m":1,"b":1}}﻿
                }
                //$file_list[$i]['file']     = $current_dir_path.'/'.$filename; //文件名，包含扩展名
                $file_list[$i]['filename']   = iconv('gbk', 'utf-8', $filename); //文件名，包含扩展名
                $file_list[$i]['createtime'] = date('Y-m-d H:i:s', filectime($file)); //文件最后修改时间
                $file_list[$i]['edittime']   = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                $i++;
            }
            closedir($handle);
        }
        
        //相对于根目录的上一级目录
        $result['moveup_dir_path']  = $moveup_dir_path;
        //相对于根目录的当前目录
        $result['current_dir_path'] = $current_dir_path;
        //当前目录的URL
        $result['current_url']  = $current_url;
        //文件数
        $result['total_count']  = count($file_list);
        //文件列表数组
        $result['file_list']    = $file_list;
        $result['msg']          = '';
        //dump($result);
        return $result;
    }

}