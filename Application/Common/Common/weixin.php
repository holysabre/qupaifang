<?php 
// 微信 --------------------------------------------------------------------------

// json中文
function json_encode_cn($data) {
    $data = json_encode($data);
    return preg_replace("/\\\u([0-9a-f]{4})/ie", "iconv('UCS-2BE', 'UTF-8', pack('H*', '$1'));", $data);
}

// get访问
function curl_get($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

// post访问
function curl_post($url, $header, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0(compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

// 判断是否是在微信浏览器里
function isWeixinBrowser() {
    $agent = $_SERVER['HTTP_USER_AGENT'];
    if (!strpos($agent, "icroMessenger")) {
        return false;
    }
    return true;
}

// php获取当前访问的完整url地址
function GetCurUrl() {
    $url = 'http://';
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
        $url = 'https://';
    }
    if($_SERVER['SERVER_PORT'] != '80') {
        $url .= $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
    } else {
        $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    // 兼容后面的参数组装
    if(stripos($url, '?') === false) {
        $url .= '?t=' . time();
    }
    return $url;
}

// 获取当前用户的OpenId
function get_openid($openid = NULL) {
    $token = get_token();
    if($openid !== NULL) {
        session('openid_' . $token, $openid);
    } elseif(! empty($_REQUEST['openid'])) {
        session('openid_' . $token, $_REQUEST['openid']);
    }
    $openid = session('openid_' . $token);
    
    $isWeixinBrowser = isWeixinBrowser();
    if(empty($openid) && $isWeixinBrowser) {
        $callback = GetCurUrl();
        OAuthWeixin($callback);
    }
    
    if(empty($openid)) {
        return - 1;
    }
    
    return $openid;
}

// 获取当前用户的Token
function get_token($token = NULL) {
    if($token !== NULL) {
        session('token', $token);
    } elseif(! empty($_REQUEST['token'])) {
        session('token', $_REQUEST['token']);
    }
    $token = session('token');
    
    if(empty($token)) {
        return - 1;
    }
    
    return $token;
}

function OAuthWeixin($callback) {
    $isWeixinBrowser = isWeixinBrowser();
    $info = get_token_appinfo();
    if(! $isWeixinBrowser || $info['type'] != 2 || empty($info['appid'])) {
        redirect($callback . '&openid=-1');
    }
    $param['appid'] = $info['appid'];
    
    if(! isset($_GET['getOpenId'])) {
        $param['redirect_uri'] = $callback . '&getOpenId=1';
        $param['response_type'] = 'code';
        $param['scope'] = 'snsapi_base';
        $param['state'] = 123;
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?' . http_build_query($param) . '#wechat_redirect';
        redirect($url);
    } elseif($_GET['state']) {
        $param['secret'] = $info['secret'];
        $param['code'] = I('code');
        $param['grant_type'] = 'authorization_code';
        
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?' . http_build_query($param);
        $content = file_get_contents($url);
        $content = json_decode($content, true);
        redirect($callback . '&openid=' . $content['openid']);
    }
}

// 获取公众号的信息
function get_token_appinfo($token = '') {
    empty($token) && $token = get_token();
    $info = C('WX_PUBLIC');
    return $info;
}

// 获取token并缓存到文件
function get_access_token($token = '') {
    $key    = 'Wx_access_token';
    $res    = S($key);
    if($res !== false)
        return $res;
    
    $info = C('WX_PUBLIC');
    if(empty($info['appid']) || empty($info['secret'])) {
        S($key, 0, 7200);
        return 0;
    }
    
    // 获取微信access token
    $url    = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $info['appid'] . '&secret=' . $info['secret'];
    $txt    = curl_get($url);
    $access = json_decode($txt, true);
    if( @array_key_exists('access_token', $access) ) {
        S($key, $access['access_token'], 7200);
        return $access['access_token'];
    }
    
    return 0;
}

// 通过openid获取微信用户基本信息,此功能只有认证的服务号才能用
function getWeixinUserInfo($openid, $token = '') {
    $access_token = get_access_token($token);
    if(empty($access_token)) {
        return false;
    }
    
    $param2['access_token'] = $access_token;
    $param2['openid'] = $openid;
    $param2['lang'] = 'zh_CN';
    
    $url = 'https://api.weixin.qq.com/cgi-bin/user/info?' . http_build_query($param2);
    $content = curl_get($url);
    $content = json_decode($content, true);
    return $content;
}

// 区开性别
function get_sex($sex) {
    switch($sex) {
        case 1: return '男'; break;
        case 2: return '女'; break;
        default: return '未知';
    }
}

// 获取图片真实路径
function get_img_url($url) {
    $url = get_img($url);
    $url = str_replace('./', '/', $url);
    return 'http://' . SITE_DOMAIN . $url;
}

// 获取url真实路径
function get_wx_url($url, $param) {
    return 'http://' . SITE_DOMAIN . U($url, $param);
}

// 替换url字符串
function replace_url($content, $param = '') {
    if($param == '') {
        $param['token']     = get_token();
        $param['openid']    = get_openid();
    }
    
    $sreach = array(
        '[follow]',
        '[website]',
        '[token]',
        '[openid]' 
    );
    $replace = array(
        get_wx_url('WxUserCenter/edit', $param), 
        get_wx_url('WxWeiSite/index', $param),
        $param['token'],
        $param['openid'] 
    );
    $content = str_replace($sreach, $replace, $content);
    
    return $content;
}

// 获取多图文字段并列表图文标题
function get_custom_mult($mult_ids, $option = true) {
    if(empty($mult_ids)) return '';
    $model = M('wx_custom');
    $map = array();
    $map['id'] = array('IN', $mult_ids);
    if($option == true) {
        $list = $model->where($map)->getField('title', true);
        return implode('<br/>', $list);
    } else {
        $map['type'] = 'reply';
        $list = $model->where($map)->select();
        return $list;
    }
}

// 添加日志
function addWeixinLog($data, $data_post = '') {
    $log = array();
    $log['cTime']           = time();
    $log['cTime_format']    = date('Y-m-d H:i:s', $log['cTime']);
    $log['data']            = is_array($data) ? serialize($data) : $data;
    $log['data_post']       = is_array($data_post) ? serialize($data_post) : $data_post;
    M('wechat_log')->add($log);
}

function logger($log_content) {
    $max_size       = 2000000;
    $log_filename   = date('Y-m-d') . 'log.xml';
    if (file_exists($log_filename) and(abs(filesize($log_filename)) > $max_size)) { 
        unlink($log_filename);
    }
    file_put_contents($log_filename, date('Y-m-d H:i:s')." ".$log_content."\r\n", FILE_APPEND);
}

// 防超时的file_get_contents改造函数
function wp_file_get_contents($url) {
    $context = stream_context_create(array(
        'http' => array(
            'timeout' => 30 
        ) 
    ));// 超时时间，单位为秒
    
    return file_get_contents($url, 0, $context);
}
