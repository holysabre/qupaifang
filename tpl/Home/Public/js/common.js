$(function(){

	//头像修改上传
	$('.update_img').each(function(){
		var _this = $(this);
		var _name = _this.data('id');
		var _url = _this.data('url');
		var _file = _this.data('file');
		var _session_id = _this.data('session');
		var _ajax =_this.data('ajax');
		var _img_class =_this.data('class');
		var img_src;

		$("#uploadBtn_"+_name).pluploadQueue({
			url: _url,
			multipart_params: { path:_file, size:2, ajax:1, sessiocat_id:1, PHPSESSID:_session_id },
			callSuccess: updateAfter,
			multi_selection: false
		});
		function updateAfter(result) {
			img_src = result.data.b;
			if (result.status == 0) {
				layer.msg(result.msg, {icon:5, time:2500});
				return false;
			}else{
	            //异步修改图片
	            $.post(_ajax,{head_pic:img_src},function(data){
	            	if(data.status == 1){
	            		layer.msg(data.msg,{icon:6,time:2000});
	            	}
	            },"json");
	            img_src = img_src.replace('./',root_path);
	            $('.'+_img_class).attr("src", img_src);
	        }
	    }
	})

	//图片上传
	$('.formUploadBtn').each(function(){
		var _this = $(this);
		var _name = _this.data('id');
		var _url = _this.data('url');
		var _file = _this.data('file');
		var _session_id = _this.data('session');
		var _isalbum = _this.data('isalbum');
		var _select = _this.data('select');
		var _image_class =_this.data('class');

		$("#uploadBtn_"+_name).pluploadQueue({
			url: _url,
			multipart_params: { path:_file, size:2, ajax:1, sessiocat_id:1, PHPSESSID:_session_id },
			callSuccess: uploadAfter,
			multi_selection: _isalbum
		});
		function uploadAfter(result) {
			if (result.status == 0) {
				layer.msg(result.message, {icon:5, time:2500});
				return false;
			}
			if(_isalbum == 0){
	        	// $("#"+_name+" .img_container").show();
	         //    $("#"+_name).find(".showimg").attr("src", result.data.b);
	         //    $("#"+_name).find(".hideimg").val(result.data.b);
	     }else{
	     	addImageAlbum(result.data.b, _name, _image_class, _select);
	     }
	 }
	})

	//删除多图
	$("body").delegate("a.delImg", "click", function() {
		$(this).parent().remove();
		return false;
	});

	


})


//图片上传成功后插入图片
function addImageAlbum(imgpath, _name, classname, _select) {
	var count = parseInt($('.'+classname).attr('data-count'));
	_imgpath = imgpath.replace('./',root_path);
	count = count ? count : 0;
	var html = '<div class="certificates">\
	<img src="'+_imgpath+'" alt="">\
	<a href="javascript:;" class="delImg">×</a>';
	if(_select != ''){
		var options = new Array();
		options = _select.split(",");
		html += '<select name="obligee['+_name+'][images]['+(parseInt(count)+1)+'][pos]">';
		for(var i = 0; i < options.length; i++){
			option = options[i];
			var op = new Array();
			op = option.split(":");
			html += '<option value="'+op[1]+'">'+op[1]+'</option>';
		}
		html += '</select>';
	}
	html += '<input type="hidden" name="obligee['+_name+'][images]'+'['+(parseInt(count)+1)+'][img]" value="'+imgpath+'"></div>';
	count++;
	$('.'+classname).append(html).attr('data-count', count);
	// layui.form('select').render();
}

//登出
function logout(url){
	$.post(url,function(result){
		console.log(result);
		if(result.status == 1){
			layer.msg(result.msg, {icon:6}, function(){ 
				location.href=result.url;
			});
		}
	},'json');
}

//人民币转大写
function convertCurrency(currencyDigits) {
// Constants:
var MAXIMUM_NUMBER = 99999999999.99;
// Predefine the radix characters and currency symbols for output:
var CN_ZERO = "零";
var CN_ONE = "壹";
var CN_TWO = "贰";
var CN_THREE = "叁";
var CN_FOUR = "肆";
var CN_FIVE = "伍";
var CN_SIX = "陆";
var CN_SEVEN = "柒";
var CN_EIGHT = "捌";
var CN_NINE = "玖";
var CN_TEN = "拾";
var CN_HUNDRED = "佰";
var CN_THOUSAND = "仟";
var CN_TEN_THOUSAND = "万";
var CN_HUNDRED_MILLION = "亿";
var CN_SYMBOL = "人民币";
var CN_DOLLAR = "元";
var CN_TEN_CENT = "角";
var CN_CENT = "分";
var CN_INTEGER = "整";

// Variables:
var integral; // Represent integral part of digit number.
var decimal; // Represent decimal part of digit number.
var outputCharacters; // The output result.
var parts;
var digits, radices, bigRadices, decimals;
var zeroCount;
var i, p, d;
var quotient, modulus;

// Validate input string:
currencyDigits = currencyDigits.toString();
// if (currencyDigits == "") {
// 	alert("Empty input!");
// 	return "";
// }
if (currencyDigits.match(/[^,.\d]/) != null) {
	alert("Invalid characters in the input string!");
	return "";
}
if (currencyDigits != '' && (currencyDigits).match(/^((\d{1,3}(,\d{3})*(.((\d{3},)*\d{1,3}))?)|(\d+(.\d+)?))$/) == null) {
	alert("Illegal format of digit number!");
	return "";
}

// Normalize the format of input digits:
currencyDigits = currencyDigits.replace(/,/g, ""); // Remove comma delimiters.
currencyDigits = currencyDigits.replace(/^0+/, ""); // Trim zeros at the beginning.
// Assert the number is not greater than the maximum number.
if (Number(currencyDigits) > MAXIMUM_NUMBER) {
	alert("Too large a number to convert!");
	return "";
}

// Process the coversion from currency digits to characters:
// Separate integral and decimal parts before processing coversion:
parts = currencyDigits.split(".");
if (parts.length > 1) {
	integral = parts[0];
	decimal = parts[1];
// Cut down redundant decimal digits that are after the second.
decimal = decimal.substr(0, 2);
}
else {
	integral = parts[0];
	decimal = "";
}
// Prepare the characters corresponding to the digits:
digits = new Array(CN_ZERO, CN_ONE, CN_TWO, CN_THREE, CN_FOUR, CN_FIVE, CN_SIX, CN_SEVEN, CN_EIGHT, CN_NINE);
radices = new Array("", CN_TEN, CN_HUNDRED, CN_THOUSAND);
bigRadices = new Array("", CN_TEN_THOUSAND, CN_HUNDRED_MILLION);
decimals = new Array(CN_TEN_CENT, CN_CENT);
// Start processing:
outputCharacters = "";
// Process integral part if it is larger than 0:
if (Number(integral) > 0) {
	zeroCount = 0;
	for (i = 0; i < integral.length; i++) {
		p = integral.length - i - 1;
		d = integral.substr(i, 1);
		quotient = p / 4;
		modulus = p % 4;
		if (d == "0") {
			zeroCount++;
		}
		else {
			if (zeroCount > 0)
			{
				outputCharacters += digits[0];
			}
			zeroCount = 0;
			outputCharacters += digits[Number(d)] + radices[modulus];
		}
		if (modulus == 0 && zeroCount < 4) {
			outputCharacters += bigRadices[quotient];
		}
	}
	outputCharacters += CN_DOLLAR;
}
// Process decimal part if there is:
if (decimal != "") {
	for (i = 0; i < decimal.length; i++) {
		d = decimal.substr(i, 1);
		if (d != "0") {
			outputCharacters += digits[Number(d)] + decimals[i];
		}
	}
}
// Confirm and return the final output string:
if (outputCharacters == "") {
	outputCharacters = CN_ZERO + CN_DOLLAR;
}
if (decimal == "") {
	outputCharacters += CN_INTEGER;
}
// outputCharacters = CN_SYMBOL + outputCharacters;
outputCharacters = outputCharacters;
return outputCharacters;
}


//下拉框、复选框、单选框选中
function form_selected(type,name,value){
	if(type == 'select'){
		$('select[name="'+name+'"] option').each(function(){
			var _value = $(this).val();
			// console.log(_value+value);
			var rule = /^\d+(\.\d+)?$/;
			if(rule.test(value)){
				value = parseInt(value);
			}
			if(value == _value){
				$(this).prop('selected',true);
			}
		})
	}else if(type == 'checkbox'){
		$('input:checkbox[name="'+name+'"]').each(function(){
			var _value = $(this).val();
			var _ul = $(this).data('ul');
			if(value.indexOf(_value)){
				$(this).prop('checked',true);
				$('.'+_ul).show();
			}
		})
	}else if(type == 'radio'){
		$('input:radio[name="'+name+'"]').each(function(){
			var _value = $(this).val();
			if(value == _value){
				$(this).prop('checked',true);
			}
		})
	}
	
}

//鼠标经过，显示tip信息 使用layer
function showTip(obj,msg){
	layer.tips(msg,$(obj),{
	  tips: [3, '#ff9341']
	});
}
