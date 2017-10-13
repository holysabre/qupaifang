$(function(){

	//修改
    $('span[data-tdtype="edit"]').on('click', function() {
        var s_val   = $(this).text(),
            s_url   = $("#listTable").attr("data-url"),
            s_name  = $(this).attr('data-field'),
            s_id    = $(this).attr('data-id'),
            s_preg  = $(this).attr('data-preg'),
            s_msg   = $(this).attr('data-msg'),
            width   = $(this).width()+50;
        $('<input type="text" class="lt_input_text" style="width:'+width+'px" value="'+s_val+'" />').focusout(function(){
            $(this).prev('span').show().text($(this).val());
            if($(this).val() != s_val) {
                // 开启正则模式
                var passed = false,
                    reg    = /\/.+\//g;
                if (s_preg) {
                    if (reg.test(s_preg)) {
                        var regstr  = s_preg.match(reg)[0].slice(1,-1);
                        var param   = s_preg.replace(reg,"");
                        var rexp    = RegExp(regstr,param);
                        passed      = rexp.test($(this).val());
                    }
                    if (passed == false) {
                        layer.msg(s_msg, {icon:5});
                        $(this).remove();
                        return false;
                    }
                }
                // 结束正则模式
                $.getJSON(s_url, {id:s_id, field:s_name, val:$(this).val()}, function(result){
                    //console.log(result);
                    if(result.status == 0) {
                        layer.msg(result.msg, {icon:5, time:2000});
                        $('span[data-field="'+s_name+'"][data-id="'+s_id+'"]').text(s_val);
                        return;
                    } else {
                        layer.msg(result.msg, {icon:6, time:1500});
                    }
                });
            }
            $(this).remove();
        }).insertAfter($(this)).focus().select();
        $(this).hide();
        return false;
    });	

    // 切换状态
    $(".tablelist").delegate(".layui-form-switch","click",function(){
        var self = $(this),
            _id  = self.prev('input').data("id"),
            _val = self.prev('input').data("val"),
            _field = self.prev('input').data("field"),
            _url = $("#listTable").data("url");
            _valnew = _val == 1 ? 0 : 1;
        $.get(_url, { field:_field, val:_valnew, id:_id }, function(data){
            //console.log(data)
            if(data.status == 1){
                _val = self.prev('input').data("val",_valnew);
                layer.msg("操作成功", {icon:6, time:1000});
            } else {
                layer.msg("操作失败", {icon:5, time:2000});
            }
        }, "json");
        return false;
    });

    // 切换状态
    $(".tablelist").delegate("#btn_choose","click",function(){
        var self = $(this),
            _id  = self.data("id"),
            _val = self.data("val"),
            _field = self.data("field"),
            _url = $("#listTable").data("url");
        $.get(_url, { field:_field, val:_val, id:_id }, function(data){
            console.log(data)
            if(data.status == 1){
                self.addClass('choose').siblings('span').removeClass('choose');
                layer.msg("操作成功", {icon:6, time:1000});
            } else {
                layer.msg("操作失败", {icon:5, time:2000});
            }
        }, "json");
        return false;
    });
    

})

//选择图标
function layer_show(_title,url){
  var show = layer.open({
    title: _title,
    type: 2, 
    area: ['80%', '80%'],
    content: url,
  });
}

//清除缓存
function clear_cache(_url,_table){
    $.get(_url, { table:_table }, function(data){
        console.log(data)
        if(data.status == 1){
            layer.msg("操作『"+data.msg+"』成功", {icon:6, time:1000},function(){
                location.reload();
            });
        } else {
            layer.msg("操作失败", {icon:5, time:2000});
        }
    }, "json");
}

//全选/反选
function checkall(obj){
    var is_check = $(obj).find('.layui-form-checkbox').hasClass('layui-form-checked');
    $('.checkbox').each(function(){
        if(is_check){
            $(this).attr('checked',true);
            $(this).next('.layui-form-checkbox').addClass('layui-form-checked');
        }else{
            $(this).attr('checked',false);
            $(this).next('.layui-form-checkbox').removeClass('layui-form-checked');
        }
    })
}

//更改事件状态的颜色
function change_color(class_name){
    var colors = {
        '0' : '#FF5722',
        '1' : '#009688',
        '2' : '#1E9FFF',
        '3' : '#393D49',
        '-1': '#FFB800',
    };
    $('.'+class_name).each(function(){
        var value = $(this).data('value');
        var c = colors[value];
        $(this).css('background',c);
    })

}