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
      <a href="<?php echo U('index');?>"><li>管理员列表</li></a>
      <a href="<?php echo U('edit');?>"><li>添加管理员</li></a>
      <a href="<?php echo U('role');?>"><li>角色列表</li></a>
      <a href="<?php echo U('role_edit');?>"><li class="layui-this">添加 / 编辑角色</li></a>
      <div class="main-tab-item">管理员管理</div>
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
                <?php echo Form::input('text','name',$info['name'],'名称','','','required');?>
                <?php echo Form::input('text','remark',$info['remark'],'说明','','','');?>
                <div class="layui-form-item">
                  <label class="layui-form-label">节点</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php if(is_array($nodes)): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="checkbox" name="nodes[<?php echo ($i); ?>]" value="<?php echo ($vo["id"]); ?>" data-pid="<?php echo ($vo["pid"]); ?>" lay-skin="primary" lay-filter="nodes_checkbox" <?php echo in_array($vo['id'],explode(',',$info['nodes']))?'checked':'';?>/>
                      <?php echo ($vo["title_show"]); echo ($vo["name"]); ?><br><?php endforeach; endif; else: echo "" ;endif; ?>
                  </div>
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
layui.use(['element', 'form'], function(){
  var element = layui.element()
  ,form = layui.form()
  ,jq = layui.jquery;

  form.on('checkbox(nodes_checkbox)', function(data){
    var self = data.elem,
        is_checked = data.elem.checked,
        value = data.value,
        pid = data.elem.dataset.pid;
    $('.layui-form-checkbox').each(function(){
      var input = $(this).prev('input');
      var _pid = input.data('pid');
      var _id = input.val();
      if(pid == 0){
        if(is_checked){
          if(value == _pid){
            input.attr('checked','true');
            $(this).addClass('layui-form-checked');
          }
        }else{
          if(value == _pid){
            input.removeAttr('checked');
            $(this).removeClass('layui-form-checked');
          }
        }
      }else{
        if(pid == _id){
          input.attr('checked','true');
          $(this).addClass('layui-form-checked');
        }
      }
    })
  });
  
  //监听提交
  form.on('submit(form_submit)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    var param = data.field;
    jq.post('<?php echo url("edit");?>',param,function(data){
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
  
})
</script>
</body>
</html>