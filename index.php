<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',     true);

// 定义应用目录
define('APP_PATH',      './Application/');

// 系统运行时目录
define('RUNTIME_PATH',   './Runtime/');

define('ADMINPANGE',   'Pange'); // 后台session变量名

 // 验证是否手机登陆访问
function is_mobile() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $is_mobile = false;
    if (strpos($user_agent, 'Mobile') !== false) {
        $is_mobile = true;
    }
    return $is_mobile;
}

// 绑定访问模块
if (is_mobile()) {
    $bind = 'Wap';
}
else {
    $bind = (isset($_GET['m'])) ? ucfirst($_GET['m']) : 'Home';
} 
//$bind = (isset($_GET['m'])) ? ucfirst($_GET['m']) : 'Home';
define('BIND_MODULE',   $bind);

define('THINK_LANG',    'mrpange'); // 多语言cookies,防止在测试网站中因为多个站点而被混乱

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单