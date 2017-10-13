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
<div class="layui-tab-brief main-tab-container">
    <ul class="layui-tab-title main-tab-title">
      <a href="<?php echo U('index');?>"><li>估价列表</li></a>
      <a href="<?php echo U('edit');?>"><li class="layui-this">查看估价</li></a>
      <div class="main-tab-item">估价管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
        <form class="layui-form">
          <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
              <li class="layui-this">基本选项</li>
            </ul>
            <div class="layui-tab-content">
              <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                  <label class="layui-form-label">主题</label>
                  <div class="layui-input-inline input-custom-width input-custom-text">
                    <?php echo ($info["theme"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>

                <div class="layui-form-item">
                  <label class="layui-form-label">联系方式</label>
                  <div class="layui-input-inline input-custom-width input-custom-text">
                    <?php echo ($info["tel"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>

                <div class="layui-form-item">
                  <label class="layui-form-label">备注</label>
                  <div class="layui-input-inline input-custom-width input-custom-text">
                    <?php echo ($info["remark"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>

                <div class="layui-form-item">
                  <label class="layui-form-label">时间</label>
                  <div class="layui-input-inline input-custom-width input-custom-text">
                    <?php echo (date("Y-d-m H:i:s",$info["addtime"])); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>

              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
                  <button class="layui-btn" lay-submit="" lay-filter="form_submit">保存</button>
                </div>
              </div>
            </div>
          </div>
          
        </form>
      </div>
    </div>
</div>
<script type="text/javascript">
layui.use(['element', 'form', 'layedit'], function(){
  var element = layui.element()
  ,form = layui.form()
  ,jq = layui.jquery;
  
  //监听提交
  form.on('submit(form_submit)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    var param = data.field;
    jq.post('<?php echo url("edit");?>',param,function(data){
      if(data.status == 1){
        layer.close(loading);
        layer.msg(data.msg, {icon: 6, time: 1000}, function(){
          location.reload();//do something
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 5, anim: 6, time: 1000});
      }
    });
    return false;
  });
  
})

</script>
</body>
</html>