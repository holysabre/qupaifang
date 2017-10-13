<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1" /><!--读取IE最新渲染-->
  <meta name="renderer" content="webkit|ie-comp|ie-stand"><!--360和QQ优先急速模式加载-->
  <title><?php echo ($site["web_title"]); ?></title>
  <meta name="keywords" content="<?php echo ($site["web_keywords"]); ?>" />
  <meta name="description" content="<?php echo ($site["web_description"]); ?>" />
  <link href="/qupaifang/Tpl/Home/Public/css/comcss.css" rel="stylesheet" type="text/css" />
  <link href="/qupaifang/Tpl/Home/Public/css/css.css" rel="stylesheet" type="text/css" />
  <script src="/qupaifang/Tpl/Home/Public/js/jquery-1.11.1.min.js"></script>
  <!--html 5标签兼容 begin-->
<!--[if lt IE 9]>
<script src="/qupaifang/Tpl/Home/Public/js/html5.js"></script>
<![endif]-->
<!--[if lte IE 8]>
<noscript>
     <style>.html5-wrappers{display:none!important;}</style>
     <div class="ie-noscript-warning">您的浏览器禁用了脚本，请<a href="">查看这里</a>来启用脚本!或者<a href="/?noscript=1">继续访问</a>.
     </div>
</noscript>
<![endif]-->
<!--ie6/7/8 禁用脚本的用户,引导用户进入带有noscript标识-->

<!--[if IE]>
<script>
document.createElement("header");
document.createElement("footer");
document.createElement("nav");
document.createElement("article");
document.createElement("section");
document.createElement("main");
document.createElement("figure");
document.createElement("aside");
document.createElement("figcaption");
</script>
<![endif]-->
<!--让IE(包括IE6)支持HTML5元素-->
<!--html 5标签兼容 end-->
<link href="/qupaifang/Tpl/Home/Public/css/flickerplate.css" rel="stylesheet">
<script src="/qupaifang/Tpl/Home/Public/js/modernizr-custom-v2.7.1.min.js"></script>
<script src="/qupaifang/Tpl/Home/Public/js/jquery-finger-v0.1.0.min.js"></script>
<script src="/qupaifang/Tpl/Home/Public/js/flickerplate.min.js"></script>
<script src="/qupaifang/Public/layer/layer.js"></script>
<script src="/qupaifang/Public/js/Validform_v5.3.2.js"></script>
</head>

<body>
  <div class="sign_side">
    <div class="sign_banner">
      <div class="flicker-example">
       <ul>
        <li data-background="/qupaifang/Tpl/Home/Public/images/sign_banner.png">
        </li>
        <li data-background="/qupaifang/Tpl/Home/Public/images/sign_banner2.png">
        </li>
      </ul>
    </div>
    <div class="sign_side_center">
      <div class="sign_side_center_move">
        <div class="sign_tit">
          <form action="<?php echo U('Member/login');?>" method="post" id="login_form">
            <div class="sign_tit_top">
              <span>会员登录</span>
              <p>|  Member login</p>
              <div class="clear"></div>
            </div>
            <ul>
              <li>
                <i class="iconfont">&#xe631;</i>
                <input name="username" type="text" value="请输入您的用户名" onfocus="if (value =='请输入您的用户名'){value =''}" onblur="if (value ==''){value='请输入您的用户名'}"/>
                <div class="clear"></div>
              </li>
              <li>
                <i class="iconfont">&#xe648;</i>
                <input name="password" type="text" value="请输入您的密码" onfocus="if (value =='请输入您的密码'){value ='';type = 'password'}" onblur="if (value ==''){value='请输入您的密码';type='text'}"/>
                <div class="clear"></div>
              </li>
              <!-- <li class="code">
                <i class="iconfont">&#xe624;</i>
                <input name="yzcode"type="text" value="请输入验证码" onfocus="if (value =='请输入验证码'){value =''}" onblur="if (value ==''){value='请输入验证码'}"/>
                <img src="<?php echo U('verify');?>" onclick="reloadImage(this)">
                <div class="clear"></div>
              </li> -->
            </ul>
            <a href="javascript:;" id="forget_pwd">忘记密码?</a>
            <div class="sign_button">
              <button type="submit" class="signed">我要登录</button>
              <button type="reset" class="cancel">取消登录</button>
              <div class="clear"></div>
            </div>
          </form>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>
<script>
  $(function(){
    $('#forget_pwd').click(function(){
      layer.msg('请联系网站管理员',{icon:7});
    })
    $("#login_form").Validform({
      tiptype:5,
      ajaxPost:true,
      callback:function(result){
        console.log(result);
        if(result.status == 1){
          layer.msg(result.msg, {icon:6}, function(){ 
            window.location.href="<?php echo U('Index/index');?>";
          });
        } else {
          layer.msg(result.msg, {icon:5});
        }
      }
    });
    $('.flicker-example').flicker({});
  });
  //刷新验证码
  function reloadImage(obj) {
    var src = "<?php echo U('verify');?>?temp=" + Math.floor(Math.random() * 100);
    $(obj).attr('src', src).fadeIn();
  }
</script>
</body>
</html>