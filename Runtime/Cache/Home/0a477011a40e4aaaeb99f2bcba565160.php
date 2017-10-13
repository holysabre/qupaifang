<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><!--读取IE最新渲染-->
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
  <title>去拍房</title>
  <link href="/qupaifang/Tpl/Home/Public/css/comcss.css" rel="stylesheet" type="text/css" />
<link href="/qupaifang/Tpl/Home/Public/css/css.css" rel="stylesheet" type="text/css" />
<link href="/qupaifang/Tpl/Home/Public/css/font.css" rel="stylesheet" type="text/css" />
<!--add css-->
<script src="/qupaifang/Tpl/Home/Public/js/jquery-1.11.1.min.js"></script>
<!-- Modernizr JS -->
<script src="/qupaifang/Tpl/Home/Public/js/modernizr/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="/qupaifang/Tpl/Home/Public/js/modernizr/respond.min.js"></script>
<![endif]-->
<!--swiper js-->
<link href="/qupaifang/Tpl/Home/Public/css/swiper.min.css" rel="stylesheet" type="text/css" />
<script src="/qupaifang/Tpl/Home/Public/js/swiper.min.js"></script>
<script type="text/javascript" src="/qupaifang/Public/layer/layer.js"></script>
<!--add js-->
<!-- 字体 -->
<script type="text/javascript" src="/qupaifang/Public/plupload/plupload.full.min.js"></script>
<script type="text/javascript">
var pathswf = '/qupaifang/Public/plupload/';
var root_path = '/qupaifang/';
</script>
<script type="text/javascript" src="/qupaifang/Public/plupload/plupload.js"></script>
<link href="/qupaifang/Public/plupload/plupload.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/qupaifang/Public/js/jquery.dragsort-0.5.2.min.js"></script>
<script src="/qupaifang/Public/js/Validform_v5.3.2.js"></script>
<link rel="stylesheet" type="text/css" href="/qupaifang/Tpl/Home/Public/css/cssreset-min.css">
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/jquery.citys.js"></script>
<script src="/qupaifang/Public/js/template.js"></script>
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/common.js"></script>
  <link href="/qupaifang/Tpl/Home/Public/css/contract.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="/qupaifang/Public/layui/css/layui.css">
  <script type="text/javascript" src="/qupaifang/Public/layui/layui.js"></script>
  <script src="/qupaifang/Tpl/Home/Public/js/jquery.jqprint-0.3.js"></script>
</head>

<body class="public_color">

  <section class="contract_all">
   <div class="contract_center" id="contract_print">
    <p class="nom5">在同意本确认书之前，请您仔细阅读本确认书的全部内容（特别是以
     <strong class="ff4e4e">
      <u>粗体下划线</u>
    </strong>标注的内容）。如果您对本协议的条款有疑问的，请通过去拍房网客服渠道进行询问，去拍房网将向您解释条款内容。如果您不同意本确认书的任意内容，或者无法准确理解去拍房网对条款的解释，请不要进行后续操作。 </p>
    <p align="center" class="nom">房地产（不动产）<span class="ff4e4e"><?php echo $info['sale_type']==1?'一口价方式':'竞价方式';?></span>出售确认书 </p>
    <p class="nom2 nom5">房地产（不动产）购买人（即您，以下可称为购买人或本人）已详细阅读并同意遵守去拍房网络平台各项规则。</u></strong>出售人在诚实信用原则下，对所售房地产（不动产）的真实性、合法性负责，并对所售房地产（不动产）出售事宜进行设定并确认。 </p>
    <p class="nom3"><strong>第一条、出售人基本情况 </strong></p>
    <table width="1016" border="1">
      <tr>
        <td colspan="3"><p align="left"><?php echo ($info["owner_type"]); ?></p></td>
      </tr>
      <tr>
        <td colspan="3"><p align="left">姓名：<?php echo ($info["owner_name"]); ?></p></td>
      </tr>
      <tr>
        <td colspan="3"><p align="left">身份证：<?php echo ($info["ID_number"]); ?></p></td>
      </tr>
    </table>
    <p><strong><u>如标的物并非出售人一人所有，则出售人已合法取得所有其他共有权人的同意及授权，出售人承诺代表全体共有人对本房地产进行出售，否则出售人承担不能出售的法律责任。 </u></strong></p>
    <p class="nom3"><strong>第二条、标的物基情况 </strong></p>
    <table border="1" cellspacing="0" cellpadding="0" width="0">
      <tr>
        <td colspan="6" valign="top">
          <p>
            <?php $building_type = explode(',',$info['building_type']); ?>
            <?php if(is_array($building_type)): $i = 0; $__LIST__ = $building_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="homecol"><img src="/qupaifang/Tpl/Home/Public/images/gou.jpg" alt=""><?php echo ($vo); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
          </p>
        </td>
      </tr>
      <?php if(is_array($info["building"])): $i = 0; $__LIST__ = $info["building"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td width="155" valign="top"><p class="tdund"><?php echo ($vo["title"]); ?>地址： </p></td>
          <td colspan="5" valign="top"><p><?php echo ($vo["province"]); ?> <?php echo ($vo["city"]); ?> <?php echo ($vo["area"]); ?> <?php echo ($vo["address"]); ?></p></td>
        </tr>
        <tr>
          <td width="155" valign="top"><p class="tdund"><?php echo ($vo["certificates_type"]); ?>：</p></td>
          <td colspan="5" valign="top"><p><?php echo ($vo["certificates_number"]); ?></p></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

      <tr>
        <td width="155" valign="top"><p align="center">房地产状况：</p></td>
        <td colspan="5" valign="top"><p align="center">&nbsp;</p></td>
      </tr>
      <tr>
        <td width="169" valign="top"><p align="center">总层 </p></td>
        <td width="169" valign="top"><p align="center">所在层 </p></td>
        <td width="169" valign="top"><p align="center">建筑面积 </p></td>
        <td width="169" valign="top"><p align="center">不动产性质 </p></td>
        <td width="169" valign="top"><p align="center">房屋性质 </p></td>
        <td width="169" valign="top"><p align="center">土地性质 </p></td>
      </tr>
      <tr>
        <td width="169" valign="top"><p align="center" class="tdund"><?php echo ($info["total_floor"]); ?> </p></td>
        <td width="169" valign="top"><p align="center" class="tdund"><?php echo ($info["seat_floor"]); ?> </p></td>
        <td width="169" valign="top"><p align="center" class="tdund"><?php echo ($info["building_area"]); ?> </p></td>
        <td width="169" valign="top"><p align="center" class="tdund"><?php echo ($info["property_nature"]); ?> </p></td>
        <td width="169" valign="top"><p align="center" class="tdund"><?php echo ($info["building_nature"]); ?> </p></td>
        <td width="169" valign="top"><p align="center" class="tdund"><?php echo ($info["land_nature"]); ?> </p></td>
      </tr>
    </table>
    <p class="nom3"><strong>第三条、出售人设置的出售方式、出售价格、收款方式、出售期限 </strong></p>
    <ol>
      <li>
        (1)标的物编号为：<u class="tdund"><?php echo sprintf('%09s', $info['id']);?></u></li>
        <li>(2)出售人以： <u class="tdund"><?php echo $info['sale_type']==1?'一口价方式拍售':'竞价方式出售';?> </u>。 </li>
        <li>(3)出售人设定竞价方式出售的<strong><u class="tdund">起拍价</u></strong>为人民币（大写）<u class="tdund"><?php echo ($info["start_price_capital"]); ?> </u> 在出售限定期限内，至少一个竞买人报名（报名并缴纳保证金），且出价不低于起拍价的，房地产买卖方可成交。 </li>
        <li>(4)出售人设定本次交易<u>保证金</u>为人民币<u class="tdund"><?php echo ($info["bond"]); ?></u>元整。（由系统进行约束条件1%-5%之间） </li>
        <?php if($info["sale_type"] == 1): ?><li>(5)房地产买卖成交后收款方式：<?php echo $info['payment_method']==1?'<img src="/qupaifang/Tpl/Home/Public/images/gou.jpg" alt="">':'口';?>   1、购买人以全额方式向出卖人支付购房款；  <?php echo $info['payment_method']==2?'<img src="/qupaifang/Tpl/Home/Public/images/gou.jpg" alt="">':'口';?>  2、购买人以首付20%-60%，其余银行贷款的方式向出卖人支付全部购房款。 </li>
          <li>
            (6)出售人设定出售期限自<u class="tdund"> <?php echo (date("Y",$info["start_time"])); ?> </u>年<u class="tdund"> <?php echo (date("m",$info["start_time"])); ?> </u>月<u class="tdund"> <?php echo (date("d",$info["start_time"])); ?> </u>日起至<u class="tdund"> <?php echo (date("Y",$info["end_time"])); ?> </u>年<u class="tdund"> <?php echo (date("m",$info["end_time"])); ?> </u>月<u class="tdund"> <?php echo (date("d",$info["end_time"])); ?> </u>日止。 </li>
            <li>(7)<strong><u>设定出售期限届满届满，该房地产<span class="tdund">标的</span>买卖成交的（出售人确认，将注意查看房地产销售信息，同时同意去拍房网可通过短信或电话等方式另行提醒出售人），出售人同意于5</u></strong><strong><u>个工作日内到去拍房网指定地点与房地产购买人签订《房地产（不动产）买卖合同》。 </u></strong></li>
        <?php else: ?>
              <li>(5)出售人设定竞价加价幅度为：<u class="tdund"><?php echo ($info["increase_rate"]); ?></u>（100万的房产，加价幅度为100-10000之间） </li>
              <li>(6)房地产买卖成交后收款方式：<?php echo $info['payment_method']==1?'<img src="/qupaifang/Tpl/Home/Public/images/gou.jpg" alt="">':'口';?>   1、购买人以全额方式向出卖人支付购房款；  <?php echo $info['payment_method']==2?'<img src="/qupaifang/Tpl/Home/Public/images/gou.jpg" alt="">':'口';?>  2、购买人以首付20%-60%，其余银行贷款的方式向出卖人支付全部购房款。 </li>
              <li>
                (7)出售人设定出售期限自<u class="tdund"> <?php echo (date("Y",$info["start_time"])); ?> </u>年<u class="tdund"> <?php echo (date("m",$info["start_time"])); ?> </u>月<u class="tdund"> <?php echo (date("d",$info["start_time"])); ?> </u>日起至<u class="tdund"> <?php echo (date("Y",$info["end_time"])); ?> </u>年<u class="tdund"> <?php echo (date("m",$info["end_time"])); ?> </u>月<u class="tdund"> <?php echo (date("d",$info["end_time"])); ?> </u>日止。 </li>
            <li>(8)<strong><u>设定出售期限届满届满，该房地产<span class="tdund">标的</span>买卖成交的（出售人确认，将注意查看房地产销售信息，同时同意去拍房网可通过短信或电话等方式另行提醒出售人），出售人同意于5</u></strong><strong><u>个工作日内到去拍房网指定地点与房地产购买人签订《房地产（不动产）买卖合同》。 </u></strong></li><?php endif; ?>
        </ol>
        <p class="nom3"><strong>第四条、交易费用、服务费 </strong></p>
        <ol>
          <li>(1)房地产买卖成交后交易/交割费用（不动产交易税、不动产转户费等）由:（默认出售方与购买方按法律和法规规定各自承担、出售方承担、购买方承担）。（这里是做一个选择，根据卖方设定的来，一般为默认） </li>
          <li>(2)本次房地产交易由本网站全程服务，服务收费祥见 <span class="tdund">(去拍房网服务收费标准)。</span>（收费标准做一个链接） </li>
        </ol>
        <p class="nom3"><strong>第五条、违约责任 </strong></p>
        <ol>
          <li><strong><u>(1)在出售期限内，如有竞买者报名缴纳保证金，则出售人承诺不会撤回已上架的标的物，也不会通过其他途径进行买卖，如有上述任一行为，出售人将向竞买成交的购买者支付相当于保证金数额的违约金。</u></strong>（产品上做一个判断，如在有竞买人报名且缴纳该标的保证金或定金的情况下，网站功能上做死，不能申请撤回。） </li>
          <li><strong><u>(2)购买人竞买成功的，则履约保证金自动转为定金，定金适用《中华人民共和国合同法》定金罚则，即如购买人拒绝在竞买成功后5</u></strong><strong><u>个工作日到去拍房网指定地点与房地产出售人签订《房地产（不动产）买卖合同》的，定金归出售人享有，购买人无权要求返还定金，去拍房网将把购买人缴存或冻结的定金支付给出售人；出售人拒绝在购买人竞买成功后5</u></strong><strong><u>个工作日到去拍房网指定地点与购买人签订《房地产（不动产）买卖合同》的，房地产出售人除应将定金退回给竞买人外（如定金缴存或冻结在去拍房网的，由去拍房网代为退回购买人），还应向购买人支付相当于定金一倍的违约金。定金在购买人与出售人订立《房地产（不动产）买卖合同》后转为房地产成交总价款的一部分。 </u></strong></li>
          <li><strong><u>(3)出售人确认，竞买成功时，出售人与购买人之间的定金合同即成立并生效。如因本确认书、定金合同与去拍房网、出售人之间发生任何纠纷的，先友好协商，协商不成的，同意由浙江省三门县人民法院进行管辖。 </u></strong></li>
          <li><strong><u>(4)本确认书经出售人（即本人）在去拍房网点击&ldquo;确认&rdquo;或以任何其他形式标明确认即生效。 </u></strong></li>
        </ol>

      </div>
      <div class="determine">
        <?php if($action != 'read'): ?><form action="<?php echo U('Contract/bid_contract');?>" method="post" id="bid_contract_form">
            <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
            <button type="submit">
              核对完成 确认出售
            </button>
          </form><?php endif; ?>
        <a href="javascript:;" onclick="printHTML('#contract_print')">
          打印房地产（不动产）竞价方式出售确认书
        </a>
      </div>
    </section>
    
    <script src="/qupaifang/Tpl/Home/Public/js/member.js"></script>
    <script>
      //调用打印机
      function printHTML(page){
        PageSetup_Default();
        $(page).jqprint({
           debug: false, //如果是true则可以显示iframe查看效果（iframe默认高和宽都很小，可以再源码中调大），默认是false
           importCSS: true, //true表示引进原来的页面的css，默认是true。（如果是true，先会找$("link[media=print]")，若没有会去找$("link")中的css文件）
           printContainer: true, //表示如果原来选择的对象必须被纳入打印（注意：设置为false可能会打破你的CSS规则）。
           operaSupport: false//表示如果插件也必须支持歌opera浏览器，在这种情况下，它提供了建立一个临时的打印选项卡。默认是true
         });
      }
    </script>

  </body>
  </html>