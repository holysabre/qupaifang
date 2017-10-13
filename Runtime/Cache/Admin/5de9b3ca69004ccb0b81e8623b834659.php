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
<script src="/qupaifang/Public/js/citys.js" type="text/javascript"></script>
<div class="layui-tab-brief main-tab-container">
    <ul class="layui-tab-title main-tab-title">
      <a href="<?php echo U('index');?>"><li>列表</li></a>
      <a href="<?php echo U('edit');?>"><li class="layui-this">添加 / 编辑</li></a>
      <div class="main-tab-item">标的管理</div>
    </ul>
    <div class="layui-tab-content">
      <div class="layui-tab-item layui-show">
        <form class="layui-form">
          <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
              <li class="layui-this">基本设置</li>
              <li>图册设置</li>
              <li>权利人基本情况</li>
              <li>房屋基本情况</li>
              <li>房地产状况</li>
              <li>出售设置</li>
              <li>地理位置</li>
            </ul>
            <div class="layui-tab-content">
              <div class="layui-tab-item layui-show">
                <?php echo Form::select('c_id',$info['c_id'],'标的物类型','',$subject_category);?>
                <?php echo Form::select('city_id',$info['city_id'],'标的物城市','',$subject_city);?>
                <?php echo Form::input('text','title',$info['title'],'标题','','','require');?>
                <?php echo Form::editor('notice',$info['notice'],'竞买公告');?>
                <?php echo Form::editor('introduction',$info['introduction'],'标的物介绍');?>
                <?php echo Form::editor('content',$info['content'],'标的展示');?>
                <?php echo Form::input('text','seo_title',$info['seo_title'],'SEO标题','','','require');?>
                <?php echo Form::textarea('seo_keywords', $info['seo_keywords'], 'SEO关键词', '（设置页面关键词，留空表示继承上级栏目设置！建议在多个关键词之间以英文逗号","分隔，并且最好不要超过100个字符！如：软件开发,网站建设）');?>
                <?php echo Form::textarea('seo_description', $info['seo_description'], 'SEO描述', '（设置页面描述，建议不要超过200个字符！）');?>
              </div>
              <div class="layui-tab-item">
                <div class="layui-form-item">
                  <label class="layui-form-label">主图：</label>
                  <div class="layui-input-inline input-custom-images">
                    <img src="<?php echo ($info["image"]); ?>" alt="">
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">展示图：</label>
                  <div class="layui-input-inline input-custom-images">
                    <?php $album = unserialize($info['album']); ?>
                    <?php if(is_array($album)): $i = 0; $__LIST__ = $album;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><img src="<?php echo ($img["img"]); ?>" alt="">
                      <p><?php echo ($img["pos"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="clear"></div>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <?php echo Form::textarea('video', $info['video'], '视频', '（视频地址链接）');?>
                <div class="layui-form-item">
                  <label class="layui-form-label">二维码</label>
                  <div class="layui-input-inline input-custom-width input-custom-text">
                    <div class="layui-input-inline">
                      <img src="<?php echo ((isset($info["qrcode"]) && ($info["qrcode"] !== ""))?($info["qrcode"]):'/qupaifang/Public/images/100x100.png'); ?>" alt="">
                    </div>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
              </div>
              <div class="layui-tab-item">
                <div class="layui-form-item">
                  <label class="layui-form-label">权利人类型：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["owner_type"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">权利人：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["owner_name"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">身份证号：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["ID_number"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
              </div>
              <div class="layui-tab-item">
                
                <?php if(is_array($info["building"])): $i = 0; $__LIST__ = $info["building"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="layui-form-item">
                    <label class="layui-form-label">房屋类型：</label>
                    <div class="layui-input-inline input-custom-width">
                      <?php echo ($vo["title"]); ?>
                    </div>
                    <div class="layui-form-mid layui-word-aux"></div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">房屋坐落：</label>
                    <div class="layui-input-inline input-custom-width">
                      <?php echo ($vo["province"]); ?> <?php echo ($vo["city"]); ?> <?php echo ($vo["area"]); ?> <?php echo ($vo["address"]); ?>
                    </div>
                    <div class="layui-form-mid layui-word-aux"></div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">权利证书类型：</label>
                    <div class="layui-input-inline input-custom-width">
                      <?php echo ($vo["certificates_type"]); ?>
                    </div>
                    <div class="layui-form-mid layui-word-aux"></div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">权利证书号：</label>
                    <div class="layui-input-inline input-custom-width">
                      <?php echo ($vo["certificates_number"]); ?>
                    </div>
                    <div class="layui-form-mid layui-word-aux"></div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">展示图：</label>
                    <div class="layui-input-inline input-custom-images">
                      <?php $images = unserialize($vo['certificates_image']); ?>
                      <?php if(is_array($images)): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><img src="<?php echo ($img["img"]); ?>" alt=""><?php endforeach; endif; else: echo "" ;endif; ?>
                      <div class="clear"></div>
                    </div>
                    <div class="layui-form-mid layui-word-aux"></div>
                  </div>
                  <div class="layui-form-line"></div><?php endforeach; endif; else: echo "" ;endif; ?>
              </div>
              <div class="layui-tab-item">
                <div class="layui-form-item">
                  <label class="layui-form-label">总层：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["total_floor"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">所在层：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["seat_floor"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">建筑面积：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["building_area"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">不动产性质：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["property_nature"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">房屋性质：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["building_nature"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">土地性质：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["land_nature"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
              </div>
              <div class="layui-tab-item">
                <?php echo Form::radio('status',$info['status'],'竞拍状态','',$stat_status);?>
                <?php echo Form::radio('shelves',$info['shelves'],'是否上架','',$stat_shelves);?>
                <?php echo Form::radio('examine',$info['examine'],'审核','',$stat_examine);?>
                <div class="layui-form-item">
                  <label class="layui-form-label">出售方式：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php if($info["sale_type"] == 1): ?>一口价方式出售
                    <?php elseif($info["sale_type"] == 2): ?>
                      竞价方式出售<?php endif; ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">起售价：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["start_price"]); ?>元 <?php echo ($info["start_price_capital"]); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">保证金：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["bond"]); ?>元   <?php echo ($info["bond_rate"]); ?>%
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">加价幅度：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["increase_rate"]); ?>元
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <?php echo Form::input('text','evaluate_price',$info['evaluate_price'],'评估价');?>
                <?php echo Form::input('text','delay_period',$info['delay_period'],'延迟周期','(分钟)');?>
                <?php echo Form::input('text','rate',$info['rate'],'综合评级','(最多5)');?>
                <div class="layui-form-item">
                  <label class="layui-form-label">交易成功收款方式：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php if($info["sale_type"] == 1): ?>购买人以全额方式支付购房款
                    <?php elseif($info["sale_type"] == 2): ?>
                      购买方以分期方式支付购房款（首付20%-60%，尾款由银行贷款支付）<?php endif; ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">首付金额：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo ($info["downpayment"]); ?>元   <?php echo ($info["downpayment_percentage"]); ?>%
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">起始时间：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo (date("Y-m-d H:i:s",$info["start_time"])); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">结束时间：</label>
                  <div class="layui-input-inline input-custom-width">
                    <?php echo (date("Y-m-d H:i:s",$info["end_time"])); ?>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
              </div>
              <div class="layui-tab-item">
              <!-- 地理位置 -->
                <div class="layui-form-item">
                  <label class="layui-form-label">搜索：</label>
                  <div class="layui-input-inline input-custom-width">
                    <input type="text" class="layui-input layui-input-fl layui-input-w200" name="" value="" id="txtSearch" />
                    <button type="button" class="layui-btn layui-input-fl" id="mapSearch">搜索</button>
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">经纬度：</label>
                  <div class="layui-input-inline input-custom-width input-custom-width-w800">
                    <div class="layui-input-fl layui-input-w100">经度LAT：</div>
                    <input type="text" class="layui-input layui-input-fl layui-input-w200" name="longitude" value="<?php echo ($info["longitude"]); ?>" id="txtX">
                    <div class="layui-input-fl layui-input-w100">纬度LNG：</div>
                    <input type="text" class="layui-input layui-input-fl layui-input-w200" name="latitude" value="<?php echo ($info["latitude"]); ?>" id="txtY">
                  </div>
                  <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">标题：</label>
                  <div class="layui-input-inline input-custom-width">
                    <input type="text" class="layui-input" name="position_title" value="<?php echo ($info["position_title"]); ?>">
                  </div>
                </div>
                <div class="layui-form-item">
                  <div id="map" style="width:100%;height:500px;border:1px solid #eeeeee"></div>
                </div>
                <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=5dacabfc3bd5924cdb6373195dcf68a0&plugin=AMap.Autocomplete,AMap.PlaceSearch"></script>
                <script type="text/javascript">
                var t, point = new AMap.LngLat(<?php echo ((isset($info['longitude']) && ($info['longitude'] !== ""))?($info['longitude']):116.397428); ?>, <?php echo ((isset($info['latitude']) && ($info['latitude'] !== ""))?($info['latitude']):39.90923); ?>),
                // 加载地图
                map = new AMap.Map("map", {
                    center: point,
                    resizeEnable: true,
                    level: 13,
                });
                /* , "AMap.CitySearch", "AMap.Geocoder" */
                map.plugin(["AMap.ToolBar", "AMap.OverView", "AMap.PlaceSearch"], function() { 
                    map.addControl(new AMap.ToolBar);
                    map.addControl(new AMap.OverView);
                    t = new AMap.PlaceSearch;
                });
                AMap.event.addListener(map, "mousemove", function(e){
                    $("#divCoordinate").html(e.lnglat.toString()).css({top:(e.pixel.y + 45) + "px",left:(e.pixel.x + 6) +"px"});
                });
                // 覆盖物
                var markers = [];
                marker = new AMap.Marker({
                    map: map,
                    offset: new AMap.Pixel(-9,-31),
                    position: point,
                    draggable: true
                });
                // 添加覆盖物文字
                marker.setLabel({
                    offset: new AMap.Pixel(25, 0),
                    content: "请您移动此标记，选择您的坐标！"
                });
                // 插入地图覆盖物
                markers.push(marker);
                // 监听覆盖物拖到事件
                AMap.event.addListener(marker, "dragend", dragend);
                function dragend(e) {
                    $("#txtX").val(e.lnglat.lng);
                    $("#txtY").val(e.lnglat.lat);
                }
                // 搜索后的结果
                var I = function(a) {
                    if (a.poiList && a.poiList.pois && a.poiList.pois.length) {
                        var b = a.poiList.pois[0];
                        map.setZoomAndCenter(13, b.location), 
                        marker.setTitle([b.name, b.address].join(b.name && b.address ? "\n" : "")), 
                        marker.setPosition(b.location), 
                        marker.setMap(map), 
                        array = b.location.toString().split(',');
                        $("#txtX").val(array[0]);
                        $("#txtY").val(array[1]);
                    } else {
                        alert("没有搜索到结果")
                    }
                }
                
                var K = function() {
                    var txt = $("#txtSearch").val();
                    if (txt == '') {
                        alert('请输入搜索内容');
                        return false;
                    }
                    t.search(txt);
                    AMap.event.addListener(t, "complete", I);
                    AMap.event.addListener(t, "error", I);
                }
                
                // $("#txtSearch").on("keyup", function(a) {
                //     console.log(a)
                //     if (13 == a.keyCode) {
                //         K();
                //         return false;
                //     }
                // })
                
                // 自定义搜索地图
                $("#mapSearch").on("click", function() {
                    K();
                })
                
                </script>
              <!-- 地理位置 -->
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
layui.use(['element', 'form', 'layedit', 'laydate'], function(){
  var element = layui.element()
  ,form = layui.form()
  ,jq = layui.jquery
  
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
          location.href=data.url;
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 5, anim: 6, time: 1000});
      }
    },"json");
    return false;
  });
  pca.init('select[name=province]', 'select[name=city]', 'select[name=area]',"<?php echo ($info["province"]); ?>","<?php echo ($info["city"]); ?>","<?php echo ($info["area"]); ?>");
})
</script>

</body>
</html>