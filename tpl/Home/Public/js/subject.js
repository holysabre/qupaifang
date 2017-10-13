var timeA;
const timeB = document.querySelector('#endtime');//定义结束时间计时器
$(function(){
	//标的详情页 登录
	$('.detail_login').click(function(){
		$('.subject_login').fadeIn();
	});
	$('.subject_login .close').click(function(){
		$('.subject_login').fadeOut();
	});
	$('.subject_login .detail_reg').click(function(){
		$('.subject_login').fadeOut();
		$('.sign_side3').fadeIn();
	});
	$('.payment .close').click(function(){
		$('.payment').fadeOut();
	})
	$('.post_bond').click(function(){
        is_self();
	})
	//计时器 获取当前价格 5秒请求一次
	getCurrentInfo();
    //当标的已经结束（状态为3）的时候 只请求一次数据
    if(subject_status != 3){
        var price_timer = setInterval(function(){
            getCurrentInfo();
        },5000);
    }
    //基本情况tab切换
    $('.price_side_info_tit a').click(function(){
        var index = $(this).index();
        $(this).addClass('price_tit_sub').siblings('a').removeClass('price_tit_sub');
        $('.price_side_info_list_div').eq(index).addClass('current').siblings().removeClass('current');
    })
    //登录表单提交
    $(".detail_login").Validform({
        tiptype:function(msg,o,cssctl){
            if (o.type == 3)
            layer.msg(msg, {icon:5});
        },
        ajaxPost:true,
        callback:function(result){
            //console.log(result);
            if(result.status == 1){
                layer.msg(result.msg, {icon:6}, function(){ 
                    location.reload();
                });
            } else {
                layer.msg(result.msg, {icon:5},function(){
                    reloadVerify('.verify_img');
                });
            }
        }
    });

    //交保证金
    $(".pay_form").Validform({
        tiptype:function(msg,o,cssctl){
            if (o.type == 3)
            layer.msg(msg, {icon:5});
        },
        ajaxPost:true,
        callback:function(result){
            console.log(result);
            if(result.status == 1){
                layer.msg(result.msg, {icon:6}, function(){ 
                    location.reload();
                });
            } else {
                layer.msg(result.msg, {icon:5},function(){
                    location.href = result.url;
                });
            }
        }
    });
})

//获取当前价格 实时获取
function getCurrentInfo(){
    $.get(subject_url,{
    	action:'getCurrentInfo',
    	s_id:s_id,
    },function(result){
    	console.log(result);
    	if(result.status == 1){
    		//当前价格
    		$('#current_price').text(result.data.current_price);
    		//出价人
            var current_person = result.data.current_person;
            current_person = current_person?current_person:'无';
    		$('.office_peo span').text(current_person);
    		//更新竞买记录
            if(result.data.list){
                update_bid_log(result.data.list);
            }
            //结束时间
            clearInterval(timeA);
            var nowTime = new Date();
            if(result.data.end_time - nowTime < 0 || result.data.status == 3){
                timeB.innerHTML = '已结束';
                return false;
            }
            timeA =  setInterval(() => { 
                let time = countDown(result.data.end_time);//只需要传入结束时间 
                timeB.innerHTML = "距离结束 <span><b>" + time.day + "</b> 天 <b>" + time.hour + "</b> 时 <b>" + time.minutes + '</b> 分 <b>' + time.seconds + '.' + time.mmsec + '</b> 秒</span>';  
            }, 107);
    	}
    },"json");
}

//倒计时
function countDown(endTime, nowTime = new Date()) {//为了满足一些特殊情况这里给一个开始时间的参数并附上默认值，一般情况只需要传入结束时间即可  
    let date = endTime - nowTime; //时间差
    let mmsec = date % 10 //所余毫秒数    
    let seconds = Math.floor(date / 1000 % 60); //所余秒数    
    let minutes = Math.floor(date / 1000 / 60 % 60); //所余分钟数    
    let hour = Math.floor(date / 1000 / 60 / 60 % 24); //所余时钟数    
    let day = Math.floor(date / 1000 / 60 / 60 / 24); //天数    
    return {  
        day: day  
        , hour: hour  
        , minutes: minutes  
        , seconds: seconds  
        , mmsec: mmsec  
    }  
}          

//增减出价
function addcutPrice(obj,increase_rate){
	var action = $(obj).val();
	var increase_price = parseInt($('#increase_price').val());
	if(action == '+'){
		//增加
		increase_price += increase_rate;
	}else if(action == '-'){
		//减少
		increase_price -= increase_rate;
		// console.log(parseInt(increase_price) < parseInt(current_price));
		// if(increase_price < current_price){
		// 	increase_price = current_price;
		// }
	}
	//console.log(increase_price);
	$('#increase_price').val(increase_price);
	
}

//判断是否已经登录
// function is_login(){
//     $.get(subject_url,{
//         action:'isLogin'
//     },function(result){
//         console.log(result);
//         if(result.status == 1){
//             is_self();
//             $('.payment').fadeIn();
//         }else{
//             layer.msg('请先登录',{icon:7},function(){
//                 $('.subject_login').fadeIn();
//             });
//         }
//     },'json');
// }

//判断是否标的为自己上架
function is_self(){
    $.get(subject_url,{
        action:'isSelf',
        s_id:s_id
    },function(result){
        console.log(result);
        if(result.status == 1){
            $('.payment').fadeIn();
        }else if(result.status == 2){
            layer.msg(result.msg,{icon:7});
        }else{
            layer.msg('请先登录',{icon:7},function(){
                $('.subject_login').fadeIn();
            });
        }
    },'json');
}

//竞拍
function auction(s_id){
    $.get(subject_url,{
        action:'auction',
        s_id:s_id,
        increase_price:$('#increase_price').val()
    },function(result){
        console.log(result);
        if(result.status == 1){
            layer.msg(result.msg,{icon:6},function(){
                //竞拍成功时，重新获取一次当前价
                getCurrentInfo();
            });
        }else{
            layer.msg(result.msg,{icon:5});
        }
    },'json');
}

//一口价
// function buyout(s_id){
//     $.get(subject_url,{
//         action:'buyout',
//         s_id:s_id
//     },function(result){
//         console.log(result);
//         if(result.status == 1){
//             layer.msg(result.msg,{icon:6},function(){
                
//             });
//         }else{
//             layer.msg(result.msg,{icon:5});
//         }
//     },'json');
// }

//更新竞拍记录
function update_bid_log(list){
    var string = '<tr>\
                    <td width="134"><div align="center"><strong>状态</strong></div></td>\
                    <td width="184"><div align="center"><strong>竞买号</strong></div></td>\
                    <td width="196"><div align="center"><strong>价格</strong></div></td>\
                    <td width="258"><div align="center"><strong>时间</strong></div></td>\
                </tr>';
    for (var i = list.length - 1; i >= 0; i--) {
        if(list[i].status == 1){
            string += '<tr class="child_info">\
                    <td><div align="center" class="child_info_sub"><span>领先</span></div></td>\
                    <td><div align="center">'+list[i].bid_no+'</div></td>\
                    <td><div align="center">'+list[i].price+'</div></td>\
                    <td><div align="center">'+list[i].time+'</div></td>\
                </tr>';
        }else{
            string += '<tr>\
                    <td><div align="center" class="child_info_sub2"><span>出局</span></div></td>\
                    <td><div align="center">'+list[i].bid_no+'</div></td>\
                    <td><div align="center">'+list[i].price+'</div></td>\
                    <td><div align="center">'+list[i].time+'</div></td>\
                </tr>';
        }
    }
    $('#bid_log table').text('').append(string);
    $('#bid_log_count').text('（'+list.length+'）');
}