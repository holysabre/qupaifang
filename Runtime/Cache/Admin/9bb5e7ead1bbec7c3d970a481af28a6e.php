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
      <a href="<?php echo U('index');?>"><li class="layui-this">配置列表</li></a>
      <a href="<?php echo U('edit');?>"><li>添加配置</li></a>
      <a href="javascript:;" onclick="clear_cache('<?php echo U('clear_cache');?>','config')"><li>清除配置缓存</li></a>
      <div class="main-tab-item">配置管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
      <form class="layui-form">
        <table class="list-table tablelist" id="listTable" data-url="<?php echo U('ajax_edit?table=menu');?>">
          <thead>
            <tr>
              <th width="80" onclick="checkall(this)"><input type="checkbox" class="checkbox" lay-skin="primary" /></th>
              <th>ID</th>
              <th>名称</th>
              <th>标题</th>
              <th width="60">显示</th>
              <th>分组</th>
              <th>类型</th>
              <th>排序</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              <td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" class="checkbox" lay-skin="primary"></td>
              <td><?php echo ($vo["id"]); ?></td>
              <td><?php echo (get_span($vo["name"],$vo['id'],'name')); ?></td>
              <td><?php echo (get_span($vo["title"],$vo['id'],'url')); ?></td>
              <td><?php echo (get_toggle($vo["is_show"],$vo['id'],'is_show')); ?></td>
              <td><?php echo (get_config_name($vo["group"],$group)); ?></td>
              <td><?php echo (get_config_name($vo["type"],$type)); ?></td>
              <td><?php echo (get_span($vo["sort"],$vo['id'],'sort')); ?></td>
              <td style="text-align: center;">
              <a href="<?php echo U('edit',array('id'=>$vo['id']));?>" class="layui-btn layui-btn-small" title="编辑"><i class="layui-icon"></i></a>
              <a class="layui-btn layui-btn-small layui-btn-danger del_btn" category-id="<?php echo ($vo["id"]); ?>" title="删除" category-name='<?php echo ($vo["name"]); ?>'><i class="layui-icon"></i></a>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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

  //图片预览
  jq('.list-table td .thumb').hover(function(){
    jq(this).append('<img class="thumb-show" src="'+jq(this).attr('thumb')+'" >');
  },function(){
    jq(this).find('img').remove();
  });
  //链接预览
  jq('.list-table td .link').hover(function(){
    var link = jq(this).attr('href');
    layer.tips( link, this, {
    tips: [2, '#009688'],
    time: false
  });
  },function(){
    layer.closeAll('tips');
  });

  //ajax删除
  jq('.del_btn').click(function(){
    var name = jq(this).attr('category-name');
    var id = jq(this).attr('category-id');
    layer.confirm('确定删除【'+name+'】?', function(index){
      loading = layer.load(2, {
        shade: [0.2,'#000'] //0.2透明度的白色背景
      });
      jq.post('<?php echo url("category/del");?>',{'id':id},function(data){
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
    });
    
  });
  
})
</script>
</body>
</html>