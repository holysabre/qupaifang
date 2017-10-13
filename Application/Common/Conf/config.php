<?php
return array(
	//'配置项'=>'配置值'
	'LOAD_EXT_CONFIG'       => 'db',
    'LOAD_EXT_FILE'         => 'common,Form,tags',
    'TMPL_404'              => '404_1.html',
    // 'SESSION_OPTIONS'         =>  array(
    //     'name'                =>  'BJYSESSION',                    //设置session名
    //     'expire'              =>  19600,                      //SESSION保存时间
    //     'use_trans_sid'       =>  1,                               //跨页传递
    //     'use_only_cookies'    =>  0,                               //是否只开启基于cookies的session的会话方式
    // ),
    'URL_ROUTER_ON'         => true,//开启路由
	'URL_ROUTE_RULES'       => array(

		// 管理后台登录
        'admin' => __ROOT__ . '/index.php?m=admin&c=index&a=index',

        // Home分组路由规则
	),
    'AUTOLOAD_NAMESPACE' => array(
        'Alidayu' => './Application/Common/ORG/Alidayu',
    ), 
);

/*
[abc]       a或b或c	            . 任意单个字符	            a? 零个或一个a
[^abc]      任意不是abc的字符	\s 空格	                    a* 零个或多个a
[a-z]       a-z的任意字符	    \S 非空格	                a+ 一个或多个a
[a-zA-Z]    a-z或A-Z	        \d 任意数字	                a{n} 正好出现n次a
^           一行开头	        \D 任意非数字	            a{n,} 至少出现n次a
$           一行末尾	        \w 任意字母数字或下划线	    a{n,m} 出现n-m次a
(...)       括号用于分组	    \W 任意非字母数字或下划线	a*? 零个或多个a(非贪婪)
(a|b)       a或b	            \b 单词边界	                (a)...\1 引用分组
(?=a)       前面有a	
(?!a)       前面没有a	        \B 非单词边界
*/