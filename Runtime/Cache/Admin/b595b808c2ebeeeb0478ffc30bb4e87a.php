<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Pange_CMS-后台管理中心</title>
    <link href="/qupaifang/Public/fonts/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/qupaifang/Public/layui/css/layui.css">
    <link rel="stylesheet" href="/qupaifang/Public/css/global.css">
    <script type="text/javascript" src="/qupaifang/Public/js/jquery11.min.js"></script>
    <script type="text/javascript" src="/qupaifang/Public/layui/layui.js"></script>
    <script type="text/javascript" src="/qupaifang/Public/plupload/plupload.full.min.js"></script>
	<script type="text/javascript">
	var pathswf = '/qupaifang/Public/plupload/';
	</script>
	<script type="text/javascript" src="/qupaifang/Public/plupload/plupload.js"></script>
	<link href="/qupaifang/Public/plupload/plupload.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/qupaifang/Public/js/jquery.dragsort-0.5.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/qupaifang/Public/wangeditor/css/wangEditor.min.css">
    <script type="text/javascript" src="/qupaifang/Public/wangeditor/wangEditor.js"></script>
    <script src="/qupaifang/Public/js/Validform_v5.3.2.js"></script>
    <script type="text/javascript" src="/qupaifang/Public/js/common.js"></script>
    <script type="text/javascript" src="/qupaifang/Public/js/form.js"></script>
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header header">
      <div class="layui-main">
        <a class="logo" href="<?php echo U('Index/index');?>" target="_blank">
          <img src="/qupaifang/Public/images/logo-top.png" alt="PANGE_CMS">
        </a>
        <ul class="layui-nav top-nav-container">
          <?php if(is_array($top_menu)): $i = 0; $__LIST__ = $top_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="layui-nav-item <?php echo $vo['id']==1?'layui-this':'';?>">
              <a href="javascript:void(0)" data-id="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="top_admin_user">
          <a href="/qupaifang" target="_blank">网站首页</a> |<!-- <a class="update_cache" href="javascript:void(0)">更新缓存</a> | --> <a class="logout_btn" href="<?php echo U('Login/loginout');?>">退出</a>
        </div>
        <div class="top_admin_remind">
          <?php $count = A('Order')->unconfirmed_order_number(); ?>
          <a href="javascript:;">
            <i class="fa fa-bell"> </i><?php echo ($count); ?>
          </a>
        </div>
      </div>
    </div>
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- <ul class="layui-nav layui-nav-tree left_menu_ul">
              <li class="layui-nav-item layui-nav-title">
                <a>个人信息</a>
              </li>
              <li class="layui-nav-item first-item layui-this">
                <a href="<?php echo url('index/home') ?>" target="main">
                  <i class="layui-icon">&#xe638;</i>
                  <cite>首页面板</cite>
                </a>
              </li>
              <li class="layui-nav-item ">
                <a href="<?php echo url('admin/edit') ?>" target="main">
                  <i class="layui-icon">&#xe642;</i>
                  <cite>修改个人信息</cite>
                </a>
              </li>
              <li class="layui-nav-item layui-nav-title">
                <a>内容发布管理</a>
              </li>
              <li class="layui-nav-item first-item">
                <a href="<?php echo url('category/index') ?>" target="main">
                  <i class="layui-icon">&#xe609;</i>
                  <cite>栏目管理</cite>
                </a>
              </li>
              <li class="layui-nav-item content_manage">
                <a href="<?php echo url('category/content_manage_search') ?>" target="main">
                  <i class="layui-icon">&#xe60a;</i>
                  <cite>内容管理</cite>
                </a>
              </li>
              <li class="layui-nav-item">
                <a href="<?php echo url('feedback/index') ?>" target="main">
                  <i class="layui-icon">&#xe63a;</i>
                  <cite>留言管理</cite>
                </a>
              </li> 
            </ul> -->
            
    			<div class="content_manage_container left_menu_ul hide">
    				<div class="content_manage_title">内容管理</div>
        		<div id="content_manage_tree"></div>
        	</div>
        </div>
   
    </div>

    <div class="layui-body iframe-container">
        <div class="iframe-mask" id="iframe-mask"></div>
        <iframe class="admin-iframe" id="admin-iframe" name="main" src="<?php echo U('Index/home');?>"></iframe>
    </div>
    
    <div class="layui-footer footer">
      <div class="layui-main">
        <p>2016 © </p>
      </div>
    </div>
</div>


<script type="text/javascript">
layui.use(['layer', 'element','jquery','tree'], function(){
  var layer = layui.layer
  ,element = layui.element() //导航的hover效果、二级菜单等功能，需要依赖element模块
  ,jq = layui.jquery

  //头部菜单切换
  jq('.top-nav-container .layui-nav-item').click(function(){
    var menu_index = jq(this).index('.top-nav-container .layui-nav-item');
    jq('.top-nav-container .layui-nav-item').removeClass('layui-this');
    jq(this).addClass('layui-this');
    // jq('.left_menu_ul').addClass('hide');
    // jq('.left_menu_ul:eq('+menu_index+')').removeClass('hide');
    // jq('.left_menu_ul .layui-nav-item').removeClass('layui-this');
    // jq('.left_menu_ul:eq('+menu_index+')').find('.first-item').addClass('layui-this');
    var _id = jq(this).children('a').attr('data-id');
    $.ajax({
      url:"<?php echo U('Index/getLeftMenu');?>",
      data:{id:_id},
      dataType:"json",
      async: false,
      success:function(data){
        if(data.status == 1){
          $('.layui-side-scroll').text('').append(data.data);
        }
      }
    })
  });
  //左边菜单点击
  jq('.left_menu_ul .layui-nav-item').click(function(){
    jq('.left_menu_ul .layui-nav-item').removeClass('layui-this');
    jq(this).addClass('layui-this');
    //出现遮罩层
    jq("#iframe-mask").show();
    //遮罩层消失
    jq("#admin-iframe").load(function(){                                  
      jq("#iframe-mask").fadeOut(100);
    });
  });
  
  //点击回到内容页面
  jq('.content_manage_title').click(function(){
  	jq('.left_menu_ul .layui-nav-item').removeClass('layui-this');
  	jq(this).parent().addClass('hide');
  	jq('.content_put_manage').find('.first-item').addClass('layui-this');
  	var url = jq('.content_put_manage').find('.first-item a').attr('href');
    jq('.admin-iframe').attr('src',url);
  	jq('.content_put_manage').removeClass('hide');

  });
  //内容管理树
  jq('.content_manage').click(function(){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    jq.getJSON('<?php echo url("category/manage_tree");?>',function(data){
      jq('#content_manage_tree').empty();
      layui.tree({
        elem: '#content_manage_tree' //传入元素选择器
        ,skin: 'white'
        ,target: 'main'
        ,nodes: data
      });
      jq('.left_menu_ul').addClass('hide');
      jq('.content_manage_container').removeClass('hide');
      layer.close(loading);
    });
  });

  //更新缓存
  jq('.update_cache').click(function(){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    jq.getJSON('<?php echo url("cache/update");?>',function(data){
      if(data.code == 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
          location.reload();//do something
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
      }
    });
  });

  //退出登陆
  jq('.logout_btn').click(function(){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    jq.getJSON('<?php echo url("login/logout");?>',function(data){
      if(data.code == 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
          location.reload();//do something
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
      }
    });
  });

	
});


</script> 
</body>
</html>