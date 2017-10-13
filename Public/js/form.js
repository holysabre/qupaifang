$(function(){

	var img100 = './Public/images/100x100.png';
    
	//图片上传
	$('.formUploadBtn').each(function(){
		var _this = $(this);
		var _name = _this.data('id');
		var _url = _this.data('url');
		var _file = _this.data('file');
		var _session_id = _this.data('session');
		var _isalbum = _this.data('isalbum');
        var _select = _this.data('select');

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
	        	$("#"+_name+" .img_container").show();
	            $("#"+_name).find(".showimg").attr("src", result.data.b);
	            $("#"+_name).find(".hideimg").val(result.data.b);
	        }else{
	        	addImageAlbum(result.data.b, _name, _select);
                if (parseInt($("#"+_name).attr('data-count')) == 1) {
                    //console.log(_name);
                    dragsort(_name);
                }
	        }
        }
        dragsort(_name);
	})

	//图片上传成功后插入图片
	function addImageAlbum(imgpath, idname, _select) {
        var count = parseInt($('#'+idname).attr('data-count'));
        count = count ? count : 0;
        var html = '<div class="img_container goods_drag" style="">\
           <img src="'+imgpath+'" class="img_src" style="height:100px" />\
           <a href="javascript:void(0);" class="delImg">删除</a>\
           <input type="text" name="'+idname+'['+(parseInt(count)+1)+'][intro]" class="layui-input" placeholder="说明" value="" />';
       if(_select != ''){
            var options = new Array();
            options = _select.split(",");
            html += '<select name="'+idname+'['+(parseInt(count)+1)+'][pos]">';
            for(var i = 0; i < options.length; i++){
                option = options[i];
                var op = new Array();
                op = option.split(":");
                html += '<option value="'+op[1]+'">'+op[1]+'</option>';
            }
            html += '</select>';
        }
        html += '<input type="hidden" name="'+idname+'['+(parseInt(count)+1)+'][image]" value="'+imgpath+'"></div>';
        count++;
        $('#'+idname).append(html).attr('data-count', count);
        layui.form('select').render();
    }

	function dragsort(idname) {
        //console.log(idname);
	    $("#"+idname).dragsort({ 
	        dragSelector:".goods_drag .img_src", 
	        dragBetween:true, 
	        placeHolderTemplate: "<div class=\"img_container goods_drag placeHolder\"><span class=\"img100\"></span></div>"
	    });
	}


	//删除单图
    $("a.delOneImg").click(function() {
        var self = $(this);
        self.siblings('img').attr('src', img100);
        self.siblings('.hideimg').val('');
        if (self.data('nopic') == 1) {
            self.parent().hide();
        }
        return false;
    });
    
    //删除多图
    $("body").delegate("a.delImg", "click", function() {
        $(this).parent().remove();
        return false;
    });
    
    //选择图库
    $(".selectImg").click(function() {
        var name    = $(this).parent().data("name"),
            dir     = $(this).parent().data("dir"),
            multi   = $(this).parent().data("multi"),
            name    = (name != undefined    ? "&name=" + name   : ''),
            dir     = (dir != undefined     ? "&dir=" + dir     : ''),
            multi   = (multi != undefined   ? "&multi=" + multi : ''),
            url     = "index.php?m=admin&c=upload&a=ImageManager" + name + dir + multi;
        layer_show('从服务器选择', url);
        return false;
    });


})