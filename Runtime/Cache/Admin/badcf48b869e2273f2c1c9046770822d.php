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
      <a href="<?php echo U('index');?>"><li>订单列表</li></a>
      <a href="<?php echo U('edit');?>"><li class="layui-this">查看订单</li></a>
      <div class="main-tab-item">订单管理</div>
    </ul>
    <div class="layui-tab-item layui-show">
      <div class="fill_50">
        <a class="layui-btn layui-input-fr" href="">修改订单</a>
      </div>
    </div>
    <div class="layui-tab-content">
      <div class="layui-collapse">
        <div class="layui-colla-item">
          <h2 class="layui-colla-title">基本信息</h2>
          <div class="layui-colla-content layui-show">
            <table class="layui-table">
              <thead>
                <tr>
                  <th>订单 ID:</th>
                  <th>订单号:</th>
                  <th>应付:</th>
                  <th>订单 状态:</th>
                  <th>下单时间:</th>
                </tr> 
              </thead>
              <tbody>
                <tr>
                  <td><?php echo ($base_info["id"]); ?></td>
                  <td><?php echo ($base_info["order_sn"]); ?></td>
                  <td><?php echo ($base_info["pay_price"]); ?></td>
                  <td><?php echo (get_order_status($base_info["order_status"])); ?> / <?php echo (get_order_express_status($base_info["express_status"])); ?></td>
                  <td><?php echo (date("Y-m-d",$base_info["add_time"])); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="layui-colla-item">
          <h2 class="layui-colla-title">收货信息</h2>
          <div class="layui-colla-content layui-show">
            <table class="layui-table">
              <thead>
                <tr>
                  <th>收货人:</th>
                  <th>联系方式:</th>
                  <th>地址:</th>
                  <th>邮编:</th>
                </tr> 
              </thead>
              <tbody>
                <tr>
                  <td><?php echo ($base_info["name"]); ?></td>
                  <td><?php echo ($base_info["mobile"]); ?></td>
                  <td><?php echo ($base_info["address"]); ?></td>
                  <td><?php echo ($base_info["zipcode"]); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="layui-colla-item">
          <h2 class="layui-colla-title">商品信息</h2>
          <div class="layui-colla-content layui-show">
            <table class="layui-table">
              <thead>
                <tr>
                  <th>商品id:</th>
                  <th>商品名称:</th>
                  <th>货号:</th>
                  <th>图片:</th>
                  <th>数量:</th>
                  <th>市场价:</th>
                  <th>折扣:</th>
                  <th>当前价:</th>
                  <th>单品小计:</th>
                  <th>操作:</th>
                </tr>
              </thead>
              <tbody>
                <?php if(is_array($products_info)): $i = 0; $__LIST__ = $products_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["pro_id"]); ?></td>
                    <td><?php echo ($vo["title"]); ?></td>
                    <td><?php echo ($vo["sn"]); ?></td>
                    <td><img src="<?php echo ($vo["img"]); ?>" alt="" width="80" height="80"></td>
                    <td><?php echo ($vo["number"]); ?></td>
                    <td><?php echo ($vo["market_price"]); ?></td>
                    <td><?php echo $vo['discount']==''?$vo['before_discount']:'<strike>'.$vo['before_discount'].'</strike>';?> <?php echo ($vo["discount"]); ?> </td>
                    <td><?php echo ($vo["price"]); ?></td>
                    <td><?php echo ($vo["total_price"]); ?></td>
                    <td><i class="fa fa-edit" onclick="layer_show('价格调整','<?php echo U('Order/editPrice',array('order_info_id'=>$vo['id']));?>')"></i></td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                  <td colspan="8" style="text-align: right;">小计:</td>
                  <td colspan="2"><?php echo ($base_info["total_price"]); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="layui-colla-item">
          <h2 class="layui-colla-title">操作信息</h2>
          <div class="layui-colla-content layui-show">
            <table class="layui-table">
              <form class="layui-form">
              <tbody>
                <tr>
                  <td width="100">操作备注:</td>
                  <td>
                    <textarea name="remark" id="remark" class="layui-textarea"></textarea>
                  </td>
                </tr>
                <tr>
                  <td>可执行操作:</td>
                  <td>
                    <input type="hidden" id="order_id" name="order_id" value="<?php echo ($base_info["id"]); ?>"/>
                    <?php if($base_info["order_status"] == 1): ?><button class="layui-btn" data-status="3" data-desc="确认订单" lay-submit="" lay-filter="order_status_submit">确认订单</button><?php endif; ?>
                    <?php if($base_info["order_status"] == 3): ?><a href="javascript:;" class="layui-btn" onclick="layer_show('发货','<?php echo U('Order/express',array('id'=>$base_info['id']));?>')">去发货</a><?php endif; ?>
                    <?php if($base_info["order_status"] == 4): ?><button class="layui-btn" data-status="5" data-desc="确认收货" lay-submit="" lay-filter="order_status_submit">确认收货</button><?php endif; ?>
                    <?php if($base_info["order_status"] != 5): ?><button class="layui-btn" data-status="0" data-desc="无效" lay-submit="" lay-filter="order_status_submit">无效</button><?php endif; ?>
                  </td>
                </tr>
              </tbody>
              </form>
            </table>
          </div>
        </div>

        <div class="layui-colla-item">
          <h2 class="layui-colla-title">操作记录</h2>
          <div class="layui-colla-content layui-show">
            <table class="layui-table">
              <thead>
                <tr>
                  <th>操作者:</th>
                  <th>操作时间:</th>
                  <th>订单状态:</th>
                  <th>发货状态:</th>
                  <th>描述:</th>
                  <th>备注:</th>
                </tr> 
              </thead>
              <tbody>
                <?php if(is_array($log_list)): $i = 0; $__LIST__ = $log_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["operator"]); ?></td>
                    <td><?php echo (date("Y-m-d",$vo["time"])); ?></td>
                    <td><?php echo (get_order_status($vo["order_status"])); ?></td>
                    <td><?php echo (get_order_express_status($vo["express_status"])); ?></td>
                    <td><?php echo ($vo["desc"]); ?></td>
                    <td><?php echo ($vo["remark"]); ?></td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
</div>
<script type="text/javascript">
layui.use(['element', 'form', 'layedit'], function(){
  var element = layui.element()
  ,form = layui.form()
  ,jq = layui.jquery;

  //监听提交
  form.on('submit(order_status_submit)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000'] //0.2透明度的白色背景
    });
    var order_id = $('#order_id').val(),
        remark = $('#remark').val(),
        status = $(this).data('status'),
        desc = $(this).data('desc');
    jq.post('<?php echo U("status");?>',{order_id:order_id,remark:remark,status:status,desc:desc},function(data){
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