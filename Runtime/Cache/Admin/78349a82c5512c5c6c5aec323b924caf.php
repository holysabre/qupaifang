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
      <a href="<?php echo U('index');?>"><li>备份</li></a>
      <a href="<?php echo U('restore');?>"><li>恢复</li></a>
      <a href="<?php echo U('sqlPost');?>"><li class="layui-this">执行语句</li></a>
      <div class="main-tab-item">数据库管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
        <!-- <form class="layui-form">
          <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
              <li class="layui-this">基本选项</li>
            </ul>
            <div class="layui-tab-content">
              <div class="layui-tab-item layui-show">
                <?php echo Form::textarea('sql', '', 'SQL语句', '（执行SQL将直接操作数据库，请谨慎使用！）');?>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
                  <button class="layui-btn" type="submit">执行</button>
                </div>
              </div>
            </div>
          </div>
          
        </form> -->
        <div style="margin-top:15px;overflow-x:auto;">
          <?php if($type == 0): ?><!-- 出错提示 -->
          <span style="color: rgb(255, 0, 0);"><strong>出错提示:</strong></span><br />
          <?php echo ($error); endif; ?>
          <?php if($type == 1): ?><!-- 执行成功 -->
          <center><h3>执行成功</h3></center><?php endif; ?>
          <?php if($type == 2): ?><!-- 有返回值 -->
          <?php echo ($result); endif; ?>
      </div>
      </div>
    </div>
</div>
<script type="text/javascript">
layui.use(['element', 'form', 'layedit'], function(){
  var element = layui.element()
  ,form = layui.form()
  ,jq = layui.jquery;
  
})

</script>
</body>
</html>