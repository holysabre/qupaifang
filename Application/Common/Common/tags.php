<?php
/**
* HTML编码转换
*
* @param string    $content    内容
* @return string
*/
function get_htmlcode($content = '') {
    if (empty($content)) return '';
    $content = htmlspecialchars_decode($content);
    $content = str_replace(array('src="./upload/','src="upload/'), 'src="' . __ROOT__ . '/upload/', $content);
    $content = str_replace(array('href="./upload/','href="upload/'), 'href="' . __ROOT__ . '/upload/', $content);
    $content = str_replace('src="Public/js/kindeditor', 'src="' . __ROOT__ . '/Public/js/kindeditor', $content);
    $content = str_replace('url(../images', 'url(' . __ROOT__ . '/Tpl/Home/Public/images', $content);
    return $content;
}

//订单状态
function get_order_status($id){
	//1未确认2已确认3待发货4已发货5已签收 0失效 -1已删除
	$data = array(
		1 => '未确认',
		3 => '待发货',
		4 => '已发货',
		5 => '已完成',
		0 => '失效',
		-1 => '已删除',
	);
	return $data[$id];
}

//发货状态
function get_order_express_status($id){
	$data = array(
		0 => '未发货',
		1 => '已发货',
	);
	return $data[$id];
}

/**
 * 写入订单日志
 * @param $order_id 订单id
 * @param $operator 操作员
 * @param $order_status 订单状态
 * @param $express_status 发货状态
 * @param $desc 描述
 * @param $remark 备注
 */
function write_order_log($data){
	$data['time'] = time();
	$res = M('order_log')->add($data);
	return $res;
}

/**
 * 个人账户操作日志
 */
function account_log($data = array()){
	$result = M('member_account_log')->add($data);
	return $result;
}

/**
 * 标的操作日志
 */
function subject_log($data = array()){
	$data['time'] = time();
	$result = M('subject_log')->add($data);
	return $result;
}

/**
 * 生成二维码
 */
function create_qrcode($text){
	import('Common.ORG.phpqrcode');
	$path = './upload/qrcode/';
	if (!file_exists($path)) {
	    mkdir($path);
	}
	$Level = 'Q';
	$Size  = 5;
	$Margin= 2;

	//$text = '';
	//$text = 'http://'.$_SERVER['HTTP_HOST'].'/mobile.php/Public/descThread1/id/1122';
	if (isset($_REQUEST['data']) && !empty($_REQUEST['data'])) {
	    $text .= $_REQUEST['data'];
	}

	if (trim($text) == '') {
	    die('data cannot be empty!');
	}

	$fileName = $path . time() . rand(1000,9999) . '.png';
	//QRcode::png($text, $fileName, $Level, $Size, $Margin, true);//直接展示
	QRcode::png($text, $fileName, $Level, $Size, $Margin);
	return $fileName;
}

/**
 * 获取配置
 */
function get_config_name($id,$items){
	$arr = array();
	$items = is_array($items)?$items:explode(',', $items);
	foreach ($items as $key => $value) {
		$item = explode(':', $value);
		$arr[$item[0]] = $item[1];
	}
	return $arr[$id];
}

//时间戳转星期几
function getTimeWeek($time, $i = 0) {
  $weekarray = array("一", "二", "三", "四", "五", "六", "日");
  $oneD = 24 * 60 * 60;
  return "星期" . $weekarray[date("w", $time + $oneD * $i)];
}

//获取单页列表
function getPageList($data = array()){
	$list = D('Home/Page')->getNavigation($data);
	return $list;
}

//获取新闻

//获取标的

//获取筛选类型
function getScreen($items){
	$str = '<span data-value="0" class="on">不限</span>';
	$items = explode(',', $items);
	foreach($items as $key=>$val){
		$val = explode(':', $val);
		$str .= '<span data-value="'.$val[0].'">'.$val[1].'</span>';
	}
	return $str;
}

//检测是否已经登录
function isLogin(){
	$member = session('member');
	if($member){
		return true;
	}
	else{
		return false;
	}
}

//货币计算 以万为单位
function money_to_wan($money){
	if($money >= 10000){
     return sprintf("%.2f", $money/10000);
    }else{
     return $money;
    }
}
