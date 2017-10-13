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
      <a href="<?php echo U('index');?>"><li class="layui-this">列表</li></a>
      <a href="<?php echo U('edit');?>"><li>添加 / 编辑</li></a>
      <div class="main-tab-item">产品管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
      <div class="fill_50">
        <a href="javascript:;" class="layui-btn layui-input-fl" onclick="clear_cache('<?php echo U('clear_cache');?>','category')">更新分类缓存</a>
      </div>
      <form class="layui-form">
        <table class="list-table tablelist" id="listTable" data-url="<?php echo U('ajax_edit?table=category');?>">
          <thead>
            <tr>
              <th width="50">ID</th>
              <th>标题</th>
              <th>排序</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo ($vo["id"]); ?></td>
              <td><?php echo ($vo["title_show"]); echo ($vo["name"]); ?></td>
              <td><?php echo (get_span($vo["sort"],$vo['id'],'sort')); ?></td>
              <td style="text-align: center;">
              <a href="<?php echo U('edit',array('id'=>$vo['id']));?>" class="layui-btn layui-btn-small" title="编辑"><i class="layui-icon"></i></a>
              <a class="layui-btn layui-btn-small layui-btn-danger del_btn" data-id="<?php echo ($vo["id"]); ?>" title="删除" data-name='<?php echo ($vo["title"]); ?>'><i class="layui-icon"></i></a>
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
    var name = jq(this).attr('data-name');
    var id = jq(this).attr('data-id');
    layer.confirm('确定删除【'+name+'】?', function(index){
      loading = layer.load(2, {
        shade: [0.2,'#000'] //0.2透明度的白色背景
      });
      jq.post('<?php echo U("categoryDelete");?>',{'id':id},function(data){
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
    });
    
  });
  
})
</script>
</body>
</html>