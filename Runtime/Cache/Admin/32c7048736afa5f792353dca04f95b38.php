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
    <div class="main-tab-item">标的管理</div>
  </ul>
  <div class="layui-tab-content">
    <div class="layui-tab-item layui-show">
      <div class="fill_50">
        <form class="layui-form" action="" method="post">
          <div class="layui-input-fl layui-input-w100">
            <select name="is_show">
              <option value="">显隐</option>
              <option value="1">显示</option>
              <option value="0">隐藏</option>
            </select>
          </div>
          <label class="layui-form-label">标题：</label>
          <div class="layui-input-fl layui-input-w200">
            <input type="text" name="keywords" class="layui-input" />
          </div>
          <button class="layui-btn layui-input-fl" type="submit">搜索</button>
          <div class="layui-input-fl layui-input-w100">
            <select name="pagenum" id="lists_pagenum">
              <option value="">分页</option>
              <option value="1">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>
        </form>
        <div class="layui-input-fr layui-input-w100">
          <button class="layui-btn layui-btn-danger" type="button" onclick="delete_checked()">删除</button>
        </div>
      </div>
      <form class="layui-form">
        <table class="list-table tablelist" id="listTable" data-url="<?php echo U('ajax_edit?table=subject');?>">
          <thead>
            <tr>
              <th width="80" onclick="checkall(this)"><input type="checkbox" class="checkbox" lay-skin="primary" /></th>
              <th width="50">ID</th>
              <th>标题</th>
              <th>出售方式</th>
              <th>竞拍状态</th>
              <th>上架</th>
              <th>审核</th>
              <th>出售时间</th>
              <th>结束时间</th>
              <th width="200">操作</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" class="checkbox" lay-skin="primary"></td>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["title"]); ?></td>
                <td>
                  <span class="span_choose" data-value="<?php echo ($vo["sale_type"]); ?>">
                    <?php echo (get_config_name($vo["sale_type"],$config['stat_sale_type']['value'])); ?>
                  </span>
                </td>
                <td>
                  <span class="span_choose" data-value="<?php echo ($vo["status"]); ?>">
                    <?php echo (get_config_name($vo["status"],$config['stat_status']['value'])); ?>
                  </span>
                </td>
                <td>
                  <span class="span_choose" data-value="<?php echo ($vo["shelves"]); ?>"><?php echo (get_config_name($vo["shelves"],$config['stat_shelves']['value'])); ?></span>
                </td>
                <td>
                  <span class="span_choose" data-value="<?php echo ($vo["examine"]); ?>"><?php echo (get_config_name($vo["examine"],$config['stat_examine']['value'])); ?></span>
                </td>
                <td><?php echo (date("Y-m-d H:i:s",$vo["start_time"])); ?></td>
                <td><?php echo (date("Y-m-d H:i:s",$vo["end_time"])); ?></td>
                <td style="text-align: center;">
                  <a href="<?php echo U('edit',array('id'=>$vo['id']));?>" class="layui-btn layui-btn-small" title="编辑"><i class="layui-icon"></i></a>
                  <a class="layui-btn layui-btn-small layui-btn-danger del_btn" data-id="<?php echo ($vo["id"]); ?>" title="删除" data-name='<?php echo ($vo["title"]); ?>'><i class="layui-icon"></i></a>
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
      </form>
      <div class="pageNav"><?php echo ($data["page"]); ?></div>
    </div>
  </div>
</div>

<script type="text/javascript">
  layui.use(['element', 'layer', 'form'], function(){
    var element = layui.element()
    ,jq = layui.jquery
    ,form = layui.form();

  //ajax删除
  jq('.del_btn').click(function(){
    var name = jq(this).attr('data-name');
    var id = jq(this).attr('data-id');
    layer.confirm('确定删除【'+name+'】?', function(index){
      loading = layer.load(2, {
        shade: [0.2,'#000'] //0.2透明度的白色背景
      });
      jq.post('<?php echo U("delete");?>',{'id':id},function(data){
        if(data.status == 1){
          layer.close(loading);
          layer.msg(data.msg, {icon: 6, time: 1000}, function(){
            location.reload();//do something
          });
        }else{
          layer.close(loading);
          layer.msg(data.msg, {icon: 2, anim: 5, time: 1000});
        }
      });
    });
    
  });
  
})
  function delete_checked(obj){
    var id = '';
    layer.confirm('确定删除?', function(index){
      loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
      $('tbody .checkbox:checked').each(function(){
        id += $(this).val() + ',';
      });
      $.post('<?php echo U("delete");?>',{'id':id},function(data){
        if(data.status == 1){
          layer.close(loading);
          layer.msg(data.msg, {icon: 6, time: 1000}, function(){
          location.reload();//do something
        });
        }else{
          layer.close(loading);
          layer.msg(data.msg, {icon: 2, anim: 5, time: 1000});
        }
      });
    });
  }
  change_color('span_choose');
</script>
</body>
</html>