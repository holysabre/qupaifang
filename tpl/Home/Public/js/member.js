$(function(){
	//房屋类型显隐
	$('.obligee_type input').click(function(){
		var ul_class = $(this).data('ul');
		var is_check = $(this).is(':checked');
		//console.log(ul_class);
		if(is_check){
			$('.'+ul_class).show();
		}else{
			$('.'+ul_class).hide();
		}
	});

	//出售价人民币转大写
	$('input[name="start_price"]').focusout(function(){
		var price = $(this).val();
		// price = parseInt(price);
		//console.log(price);
		capital_price = convertCurrency(price);
		$('input[name="start_price_capital"]').val(capital_price);
	});

	//交易收款方式
	$('input[name="payment_method"]').click(function(){
		if($(this).is(':checked') == 1){
			var value = $(this).val();
			if(value == 1){
				$('.installment_payment').hide();
			}else{
				$('.installment_payment').show();
			}
		}
	});

	//出售方式
	$('input[name="sale_type"]').click(function(){
		if($(this).is(':checked') == 1){
			var value = $(this).val();
			if(value == 1){
				$('.increase_rate').hide();
			}else{
				$('.increase_rate').show();
			}
		}
	});

	//按百分比计算首付金额
	$('#downpayment_select').change(function(){
		var start_price = parseFloat($('input[name="start_price"]').val());
		var downpayment_percentage = parseInt($(this).val());
		var downpayment_price = downpayment_percentage / 100 * start_price;
		$('.downpayment_price').text(downpayment_price);
		$('input[name="downpayment"]').val(downpayment_price);
	});

	//保证金
	$('select[name="bond_rate"]').change(function(){
		var rate = $(this).val();
		var price = $('input[name="start_price"]').val();
		var bond = rate / 100 * price;
		$('#bond').text('').text('价格为人民币：'+bond);
		$('input[name="bond"]').val(bond);
	})

	//提交标的物信息
	$(".sell2_form").Validform({
	    tiptype:function(msg,o,cssctl){
	        if (o.type == 3)
	        layer.msg(msg, {icon:7});
	    },
	    ajaxPost:true,
	    callback:function(result){
	    	console.log(result);
	        if(result.status == 1){
	            layer.msg(result.msg, {icon:6}, function(){ 
	                //location.href=result.url;
	                var confirm_layer = layer.open({
	                	title:[result.data.title,'18px'],
	                	type:2,
	                	content:[result.url,'no'],
	                	area:['80%','100%']
	                });
	            });
	        } else {
	            layer.msg(result.msg, {icon:5});
	        }
	    }
	});

	//确认出售合同
	$("#bid_contract_form").Validform({
	    tiptype:function(msg,o,cssctl){
	        if (o.type == 3)
	        layer.msg(msg, {icon:7});
	    },
	    ajaxPost:true,
	    callback:function(result){
	    	console.log(result);
	        if(result.status == 1){
                parent.location.href=result.url;
	        } else {
	            layer.msg(result.msg, {icon:5});
	        }
	    }
	});
})


//删除标的 （更改状态）
function delete_subject(obj,url){
	layer.confirm('确认删除？',function(){
	  $.get(url,function(result){
	  	if(result.status == 1){
	  		layer.msg(result.msg,function(){
	  			$(obj).closest('li').remove();
	  		})
	  	}
	  },"json");
	});
}

//判断是否允许修改
function if_edit(obj,shelves,status){
	console.log(shelves);
	if(shelves == 1){
		layer.tips('该标的不允许修改，请先下架!',$(obj),{
		  tips: [3, '#ff9341']
		});
	}else if(status == 2){
		layer.tips('该标的已经开始，不允许修改!',$(obj),{
		  tips: [3, '#ff9341']
		});
	}else if(status == 3){
		layer.tips('该标的已经结束，不允许修改!',$(obj),{
		  tips: [3, '#ff9341']
		});
	}else{
		location.href = $(obj).data('url');
	}
}

//上下架标的
function shelves(obj,url,id,key,value){
	var tip_msg = value==1?'确认上架':'确认下架';
	var result_msg = value==1?'上架成功':'下架成功';
	layer.confirm(tip_msg,function(){
	  $.get(url,{
	  	id:id,
	  	key:key,
	  	value:value
	  },function(result){
	  	console.log(result);
	  	if(result.status == 1){
	  		layer.msg(result_msg,{icon:6},function(){
	  			location.reload();
	  		})
	  	}else{
	  		layer.msg(result.msg,{icon:5});
	  	}
	  },"json");
	});
}

//查看合同
function read_contract(url){
	layer.open({
    	title:['出售确认书','18px'],
    	type:2,
    	content:[url,'no'],
    	area:['80%','100%']
    });
}