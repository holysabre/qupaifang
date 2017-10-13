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
      <a href="<?php echo U('index');?>"><li>备份</li></a>
      <a href="<?php echo U('restore');?>"><li class="layui-this">恢复</li></a>
      <a href="<?php echo U('sqlPost');?>"><li>执行语句</li></a>
      <div class="main-tab-item">数据库管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
      <form class="layui-form">
        <table class="list-table tablelist" id="listTable" data-url="<?php echo U('ajax_edit?table=member');?>">
          <thead>
            <tr>
              <th width="80"><input type="checkbox" lay-filter="checkbox" lay-skin="primary" /></th>
              <th>SQL文件名</th>
              <th>备份时间</th>
              <th>文件大小</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              <td><input type="checkbox" name="tables[<?php echo ($i); ?>]" value="<?php echo ($vo["Name"]); ?>" lay-skin="primary"></td>
              <td><?php echo ($vo["name"]); ?></td>
              <td><?php echo (date('Y-m-d H:i:s',$vo["time"])); ?></td>
              <td><?php echo ($vo["size"]); ?></td>
              <td style="text-align: center;">
                <a href="#" class="layui-btn layui-btn-small restore" sqlPre="<?php echo ($vo["pre"]); ?>">导入</a>
                <a href="#" class="layui-btn layui-btn-small layui-btn-danger">删除</a>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          <tr>
            <td colspan="3"></td>
            <td>共计：<?php echo ($total); ?></td>
            <td></td>
          </tr>
          </tbody>
        </table>
      </form>
      <button type="button" class="layui-btn layui-btn-danger delSqlFiles">删除</button>
      </div>
    </div>
</div>

<script type="text/javascript">
layui.use(['element', 'layer', 'form'], function(){
  var element = layui.element()
  ,jq = layui.jquery
  ,form = layui.form()
  ,laypage = layui.laypage;

  //全选
  form.on('checkbox(checkbox)', function(data){
    if(data.elem.checked){
      $('input[type="checkbox"]').attr('checked','true').next('.layui-form-checkbox').addClass('layui-form-checked');
    }else{
      $('input[type="checkbox"]').removeAttr('checked','true').next('.layui-form-checkbox').removeClass('layui-form-checked');
    }
  });

  //提交数据恢复操作
    $(".restore").click(function(){
        if($(this).attr("disabled")){
            layer.msg('已提交，系统在处理中...', {icon:5, time:2500});
            return false;
        }
        var sqlPre = $(this).attr("sqlPre");
        $(".restore[sqlPre='"+sqlPre+"']").attr("disabled", true).html("导入中...");
        $.post("<?php echo U('restore');?>", {'file':sqlPre}, function(data){
            //console.log(data);
            if(data.status==1){
                layer.msg(data.message, {icon:6, time:1000}, function(){ 
                    window.location.reload();
                });
            }else{
                layer.msg(data.message, {icon:5, time:2500});
            }
        },'json');
        alert("系统处理中，如果导入文件较大可能需要较长时间，请稍候....");
        return false;
    });
    //删除备份文件
    $(".delSqlFiles").click(function(){
        if($(this).attr("disabled")){
            layer.msg('已提交，系统在处理中...', {icon:5, time:2500});
            return false;
        }
        if($("tbody input[type='checkbox']:checked").size()==0){
            layer.msg('请先选择你要删除的数据库表吧', {icon:5, time:2500});
            return false;
        }
        $(".btn").attr("disabled",true);
        $(this).html("提交处理中...");
        
        var ids = '';
        $("tbody input[type='checkbox']:checked").each(function(){
            ids += $(this).val() + ',';
        });
        ids = ids.substr(0, (ids.length - 1));
        $.post("<?php echo U('delete');?>", {'sqlFiles':ids}, function(data){
            if ( data.status == 1) {
                layer.msg(data.message, {icon:6, time:1000}, function(){ 
                    window.location.reload();
                });
            } else {
                layer.msg(data.message, {icon:5, time:2500});
            }
            
        },'json');
        return false;
    });
})
</script>
</body>
</html>