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
      <a href="<?php echo U('index');?>"><li>文章列表</li></a>
      <a href="<?php echo U('edit');?>"><li class="layui-this">添加 / 编辑文章</li></a>
      <a href="<?php echo U('category');?>"><li>文章分类列表</li></a>
      <a href="<?php echo U('category_edit');?>"><li>添加 / 编辑文章分类</li></a>
      <div class="main-tab-item">文章管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
        <form class="layui-form">
          <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
              <li class="layui-this">基本选项</li>
              <li>SEO选项</li>
              <li>其它选项</li>
            </ul>
            <div class="layui-tab-content">
              <div class="layui-tab-item layui-show">
                <?php echo Form::select('catid',$info['catid'],'上级分类','',$category,'title');?>
                <?php echo Form::input('text','title',$info['title'],'标题','（用于后台显示的配置标题）','请输入标题','required');?>
                <?php echo Form::upload('img', $info['img'], '图片', '列表缩略图','article');?>
                <?php echo Form::editor('content',$info['content'],'内容');?>
                <?php echo Form::textarea('introduction', $info['introduction'], '简介', '（设置简短内容，建议不要超过200个字符！）');?>
              </div>
              <div class="layui-tab-item">
                <?php echo Form::input('text','html',$info['html'],'伪静态名','（设置栏目在前台页面显示的静态文件名称，无需添加扩展名，常常以栏目名称拼音命名，留空则取栏目名称拼音首字母作为页面名称！如：gongsijianjie/gsjj）','请输入伪静态名','');?>
                <?php echo Form::input('text','seo_title',$info['seo_title'],'SEO标题','（页面SEO标题）','请输入标题');?>
                <?php echo Form::input('text','seo_keywords',$info['seo_keywords'],'SEO关键词','设置页面关键词，留空表示继承上级栏目设置！建议在多个关键词之间以英文逗号","分隔，并且最好不要超过100个字符！如：软件开发,网站建设','','');?>
                <?php echo Form::textarea('seo_description', $info['seo_description'], 'SEO描述', '（设置页面描述，留空表示继承上级栏目设置！建议不要超过200个字符！）');?>
              </div>
              <div class="layui-tab-item">
                <!-- <?php echo Form::input('text','link',$info['link'],'转向链接','（外链如: http://www.baidu.com,內链如: :zxly以":"开头.在"链接模块"下有效）','请输入链接地址','');?> -->
                <?php echo Form::date('addtime', $info['addtime'], '发布时间', '（默认为当前时间，例：'.date('Y-m-d H:i:s',time()).'）','YYYY-MM-DD hh:mm:ss');?>
                <?php echo Form::input('text','source',$info['source'],'来源','','','');?>
                <?php echo Form::input('text','author',$info['author'],'作者','','','');?>
                <?php echo Form::checkbox('status', $info['status'], '状态', '', $items = array('1'=>'推荐','2'=>'置顶'));?>
                <?php echo Form::radio('is_show',array($info['is_show'],1),'是否显示','',array(1=>'是',0=>'否'));?>
                <?php echo Form::input('text','clickcount',$info['clickcount'],'点击数','','','');?>
                <?php echo Form::input('text','sort',array($info['sort'],100),'排序','','数字越小越靠前','number');?>
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
layui.use(['element', 'form', 'layedit','laydate'], function(){
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