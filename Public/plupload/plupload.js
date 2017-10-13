/**
 * <div id="container_filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
 * <div id="container">
 *     <input type="button" id="pickfiles" class="btn btn-info" value="上传图片">  
 * </div>
 */
;(function($){
    var uploaders = {};
    $.fn.pluploadQueue = function(settings) {
        var uploader, target, id;
        
        target = $(this);
        id = target.attr('id');
        
        settings = $.extend({
            runtimes: 'html5,flash,html4',
            browse_button: id,
            //container: id + '_browse'
            filters: {
                max_file_size: '2mb', //2000kb
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png"}
                ]
            },
            //multi_selection: true, //true按ctrl多文件上传, false单文件上传
            flash_swf_url: pathswf + 'Moxie.swf',
            silverlight_xap_url: pathswf + 'Moxie.xap',
            file_data_name: 'img'
        }, settings);
        
        uploaders[id] = uploader = new plupload.Uploader(settings);
        
        // ID
        function gId(id) {
            return document.getElementById(id);
        }
        
        // 销毁
        function destroy() {
            delete uploaders[id];
            uploader.destroy();
            uploader = target = null;
        }
        
        // 当Plupload初始化完成后触发
        uploader.bind('Init', function(up, file) {
            gId(id).title = 'Using runtime: ' + file.runtime;
        });
        
        // 当Init事件发生后触发
        uploader.bind('PostInit', function(up) {
            gId(id + '-filelist').innerHTML = '';
        });
        
        // 当上传队列中某一个文件开始上传后触发
        uploader.bind('UploadFile', function(up, file) {
            if (settings.callUploadFile) {
                settings.callUploadFile(up.settings.multipart_params);
            }
        });
        
        // 当上传队列的状态发生改变时触发
        uploader.bind('StateChanged', function(up) {
            if (settings.callChanged) {
                settings.callChanged(up, settings);
            }
        });
        
        // 当文件添加到上传队列后触发
        uploader.bind('FilesAdded', function(up, file) {
            if (settings.callAdded) {
                settings.callAdded(up, file, uploader);
            } else { uploader.start(); }
        });
        
        // 当文件从上传队列移除后触发
        uploader.bind('FilesRemoved', function(up, file) {
            if (settings.callRemoved) {
                settings.callRemoved(up, file);
            }
        });
        
        // 会在文件上传过程中不断触发，可以用此事件来显示上传进度
        uploader.bind('UploadProgress', function(up, file) {
            if (settings.callProgress) {
                settings.callProgress(up, file);
            }
        });
        
        // 当队列中的某一个文件上传完成后触发
        uploader.bind('FileUploaded', function(up, file, info) {
            var data = eval('('+ info.response +')');
            if (settings.callSuccess) {
                settings.callSuccess(data);
            } 
        });
        
        // 当上传队列中所有文件都上传完成后触发
        uploader.bind('UploadComplete', function(up, file) {
            up.files = {};
            file = {};
        });
        
        // 当发生错误时触发
        uploader.bind('Error', function(up, err) {
            var file = err.file, message;

            if (file) {
            	message = err.message;

            	if (err.details) {
            		message += " (" + err.details + ")";
            	}

            	if (err.code == plupload.FILE_SIZE_ERROR) {
            		alert("文件太大: " + file.name);
            	}

            	if (err.code == plupload.FILE_EXTENSION_ERROR) {
            		alert("无效的文件扩展名: " + file.name);
            	}
            	
            	//file.hint = message;
                alert(message);
            }

            if (err.code === plupload.INIT_ERROR) {
            	setTimeout(function() { destroy(); }, 1);
            }
        });
        
        uploader.init();
        
        return this;
    };
})(jQuery);

function addImage(small, big, id, idname, name, w, h) {
    var img = $(id),
        src = img.attr("src"),
        count = parseInt(idname.attr('data-count'));
    if(src == pathswf + "default.png") {
        return false;
    } else {
        var html = '<div class="goods_img goods_drag"><span class="img_container"><img class="img_src" \
         src="'+small+'" />\
        <a href="javascript:void(0);" class="delImg">删除</a>\
        <input type="hidden" name="'+name+'" value="'+big+'" /></span></div>';
        idname.append(html).attr('data-count', parseInt(count)+1);
        img.attr({"src": pathswf + "default.png"}).css({"width":(w?w:100), "height":(h?h:100)});
    }
}
