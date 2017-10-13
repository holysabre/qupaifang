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
<form class="layui-form">
<div class="layui-tab layui-tab-brief main-tab-container" lay-filter="main-tab">
    <ul class="layui-tab-title main-tab-title">
      <?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $vo = explode(':',$vo) ?>
        <li <?php echo ($i==1?'class="layui-this"':''); ?> data-key="<?php echo ($i); ?>"><?php echo ($vo["1"]); ?>设置</li><?php endforeach; endif; else: echo "" ;endif; ?>
      <div class="main-tab-item">相关设置</div>
    </ul>    
    <div class="layui-tab-content <?php echo ($i==1?'class="layui-show"':''); ?>">
      <?php if(is_array($setting)): $k = 0; $__LIST__ = $setting;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($k % 2 );++$k;?><div class="layui-tab-item <?php echo ($k==1?'layui-show':''); ?>" data-key="<?php echo ($k); ?>">
          <?php if(is_array($s)): $i = 0; $__LIST__ = $s;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["type"] == 1): echo Form::input('text',$vo['name'],$vo['value'],$vo['title'],$vo['remark'],'','');?>
            <?php elseif($vo["type"] == 2): ?>
              <?php echo Form::textarea($vo['name'],$vo['value'],$vo['title'],$vo['remark'],'','');?>
            <?php elseif($vo["type"] == 3): ?>
              <?php echo Form::radio_setting($vo['name'],$vo['value'],$vo['title'],$vo['remark'],$vo['extra']);?>
            <?php elseif($vo["type"] == 4): ?>
              <?php echo Form::upload($vo['name'],$vo['value'],$vo['title'],$vo['remark'],'config'); endif; endforeach; endif; else: echo "" ;endif; ?>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn" lay-submit="" lay-filter="site_base">立即提交</button>
        </div>
      </div>
    </div>
</div>
</form>
<script>
layui.use(['form', 'element'], function(){
  var element = layui.element() //Tab的切换功能，切换事件监听等，需要依赖element模块
  ,form = layui.form()
  ,jq = layui.jquery;
  //监听提交
  form.on('submit(site_base)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    var param = data.field;
    jq.post('<?php echo url("config/setting");?>',param,function(data){
      if(data.status == 1){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
          location.reload();//do something
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
      }
    });
    return false;
  });
  
  //选项卡切换监听，改变iframe外层导航选项
  element.on('tab(main-tab)', function(data){
  	//console.log(data.index); //得到当前Tab的所在下标
  	var index = 1 + data.index;
  	jq('.setting_ul .layui-nav-item', window.parent.document).removeClass('layui-this');
  	jq('.setting_ul .layui-nav-item:eq('+index+')', window.parent.document).addClass('layui-this');
  });

});
</script>
</body>
</html>