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
<div class="layui-tab layui-tab-brief main-tab-container">
    <ul class="layui-tab-title main-tab-title">
      <a href="<?php echo U('index');?>"><li class="layui-this">备份</li></a>
      <a href="<?php echo U('restore');?>"><li>恢复</li></a>
      <a href="<?php echo U('sqlPost');?>"><li>执行语句</li></a>
      <div class="main-tab-item">数据库管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
      <form class="layui-form">
        <table class="list-table tablelist" id="listTable" data-url="<?php echo U('ajax_edit?table=Database');?>">
          <thead>
            <tr>
              <th width="80"><input type="checkbox" lay-filter="checkbox" lay-skin="primary" /></th>
              <th>数据表名</th>
              <th>引擎</th>
              <th>编码</th>
              <th>数据长度</th>
              <th>表名注释</th>
              <th>记录书</th>
              <th>空闲数据</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              <td><input type="checkbox" name="tables[<?php echo ($i); ?>]" value="<?php echo ($vo["Name"]); ?>" lay-skin="primary"></td>
              <td><?php echo ($vo["Name"]); ?></td>
              <td><?php echo ($vo["Engine"]); ?></td>
              <td><?php echo ($vo["Collation"]); ?></td>
              <td><?php echo (byte_format($vo["Data_length"])); ?></td>
              <td><?php echo ($vo["Comment"]); ?></td>
              <td><?php echo ($vo["Rows"]); ?></td>
              <td><?php echo ($vo["Data_free"]); ?></td>
              <td style="text-align: center;">
              <a href="#" class="layui-btn layui-btn-small" onClick="LoadUrl('optimize|<?php echo ($vo["Name"]); ?>',1);">优化</a>
              <a href="#" class="layui-btn layui-btn-small" onClick="LoadUrl('repair|<?php echo ($vo["Name"]); ?>',1);">修复</a>
              <a href="#" class="layui-btn layui-btn-small" onClick="LoadUrl('viewinfo|<?php echo ($vo["Name"]); ?>',2);">结构</a>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          <tr>
            <td colspan="9">
              <button class="layui-btn layui-btn-normal" lay-submit="" lay-filter="form_submit">备份</button>
            </td>
          </tr>
          </tbody>
        </table>
      </form>
      </div>
    </div>
</div>

<script type="text/javascript">
layui.use(['element', 'layer', 'form'], function(){
  var element = layui.element()
  ,jq = layui.jquery
  ,form = layui.form()
  ,laypage = layui.laypage;

  //监听提交
  form.on('submit(form_submit)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    var param = data.field;
    jq.post('<?php echo U("export");?>',param,function(data){
      console.log(data);
      if(data.status == 1){
        layer.close(loading);
        layer.msg(data.msg, {icon: 6, time: 1000}, function(){
          location.reload();//do something
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 5});
      }
    },"json");
    return false;
  });

  form.on('checkbox(checkbox)', function(data){
    if(data.elem.checked){
      $('input[type="checkbox"]').attr('checked','true').next('.layui-form-checkbox').addClass('layui-form-checked');
    }else{
      $('input[type="checkbox"]').removeAttr('checked','true').next('.layui-form-checkbox').removeClass('layui-form-checked');
    }
  });

  
})
function LoadUrl(surl, snum){
  $.get("<?php echo U('index_step');?>", {'value':surl,'step':2}, function(result) {
      if (snum == 1) {
          layer.alert(result.msg, function(index){
              layer.close(index);
          }); 
      } else if (snum == 2) {
          layer.open({
              type: 1,
              title: "数据表结构",
              skin: 'layui-layer-rim',
              area: ['700px', '450px'],
              content: "<div style='padding:15px'>"+result.msg+"</div>"
          });
      }
  },'json');
}
</script>
</body>
</html>