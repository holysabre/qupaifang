<?php

class Form {
	/**
     * 单行文本
     * @param string $name   表单名称
     * @param string $value  默认值
     * @param array $label   参数
     * @param array $description   表单提示
     * @param array $verify   验证方式
     * @return string
     */
    static public function input($type = 'text',$name, $value=array(), $label, $description='',$placeholder='',$verify='',$is_readonly = false) {
        if(is_array($value)){
            $value = empty($value[0])?$value[1]:$value[0];
        }else{
            $value = $value;
        }
  		$string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label>';
        $string .= '<div class="layui-input-inline input-custom-width"><input type="'.$type.'" name="'.$name.'" value="'.$value.'" lay-verify="'.$verify.'" autocomplete="off" placeholder="'.$placeholder.'" '.($is_readonly ? 'readonly' : '').' class="layui-input"></div>';
        if($description) {
            $string .= '<div class="layui-form-mid layui-word-aux">'.$description.'</div>';
        }
        $string .= '</div>';
        return $string;
    }

    /**
     * 多行文本
     * @param string $name   表单名称
     * @param string $value  默认值
     * @param array $label   参数
     * @param array $description   表单提示
     * @param array $verify   验证方式
     * @return string
     */
    static public function textarea($name, $value, $label, $description='',$placeholder='',$verify='') {
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label>';
        $string .= '<div class="layui-input-inline input-custom-width"><textarea name="'.$name.'" lay-verify="'.$verify.'" autocomplete="off" placeholder="'.$placeholder.'" class="layui-textarea">'.$value.'</textarea></div>';
        if($description) {
            $string .= '<div class="layui-form-mid layui-word-aux">'.$description.'</div>';
        }
        $string .= '</div>';
        return $string;
    }

    /**
     * layui编辑器
     * @param string $name   表单名称
     * @param string $value  默认值
     * @param array $label   参数
     * @param array $description   表单提示
     * @param array $verify   验证方式
     * @return string
     */
    static public function layedit($name, $value, $label, $description='',$placeholder='',$verify='', $id = 'layedit') {
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label>';
        $string .= '<div class="layui-input-block"><textarea name="'.$name.'" lay-verify="'.$verify.'" autocomplete="off" placeholder="'.$placeholder.'" class="layui-textarea layui-hide" id="'.$id.'">'.$value.'</textarea></div>';
        if($description) {
            $string .= '<div class="layui-form-mid layui-word-aux">'.$description.'</div>';
        }
        $string .= '</div>';
        return $string;
    }

    /**
     * 开启/关闭
     * @param string $name  表单名称
     * @param string $value 默认值
     * @param array $description   表单提示
     * @return string
     */
    static public function enabled($name, $value = 'on', $label, $description='') {
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-inline input-custom-width">';
        $checked = ($value == 'on') ? ' checked' : '';
        $string .= '<input type="checkbox"  name="'.$name.'" '.$checked.' lay-skin="switch" title="开关">';
        $string .='</div><div class="layui-form-mid layui-word-aux">'.$description.'</div></div>';
        return $string;
    }

    /**
     * 单选框
     * @param string $name  表单名称
     * @param string $value 默认值
     * @param array $items 选项列表
     * @return mixed
     */
    static public function radio($name, $value, $label, $description='', $items = '') {
        if(empty($items)) return false;
        $value = is_array($value) ? $value[1] : $value;
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-inline input-custom-width">';
        $items = is_array($items) ? $items : explode(',', $items);
        foreach( $items as $key => $item ) {
            if(is_array($items) && strstr($items,':')){
                $checked = ($value == $key) ? ' checked' : '';
                $string .= '<input type="radio" name="'.$name.'" value="'.$key.'" title="'.$item.'" '.$checked.'>';
            }else{
                $item = explode(':', $item);
                $checked = ($value == $item[0]) ? ' checked' : '';
                $string .= '<input type="radio" data-value="'.$value.'" name="'.$name.'" value="'.$item[0].'" title="'.$item[1].'" '.$checked.'>';
            }
        }
        $string .= '</div><div class="layui-form-mid layui-word-aux">'.$description.'</div></div>';
        return $string;
    }

    /**
     * 站点配置单选框
     * @param string $name  表单名称
     * @param string $value 默认值
     * @param array $items 选项列表
     * @return mixed
     */
    static public function radio_setting($name, $value, $label, $description='', $items = '') {
        if(empty($items)) return false;
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-inline input-custom-width">';
        $items = explode(',', $items);
        foreach( $items as $key => $item ) {
            $item = explode(':', $item);
            $checked = ($value == $item[0]) ? ' checked' : '';
            $string .= '<input type="radio" name="'.$name.'" value="'.$item[0].'" title="'.$item[1].'" '.$checked.'>';
        }
        $string .= '</div><div class="layui-form-mid layui-word-aux">'.$description.'</div></div>';
        return $string;
    }

    /**
     * 多选框
     * @param string $name  表单名称
     * @param string $value 默认值 以(,)隔开的字符串
     * @param array $items 选项列表
     * @return mixed
     */
    static public function checkbox($name, $value, $label, $description='', $items = array()) {
        if(!is_array($items) || empty($items)) return false;
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-inline input-custom-width">';
        $value = explode(',', $value);
        foreach( $items as $key => $item ) {
            $checked = (in_array($key, $value)) ? ' checked' : '';
            $string .= '<input type="checkbox" name="'.$name.'['.$key.']" value="'.$key.'" title="'.$item.'" '.$checked.'>';
        }
        $string .= '</div><div class="layui-form-mid layui-word-aux">'.$description.'</div></div>';
        return $string;
    }

    /**
     * 下拉框
     * @param string $name  表单名称
     * @param string $value 默认值
     * @param array $options 选项列表
     * @return string
     */
    // static public function select($name, $value, $label, $description='', $options = array(), $verify='' ) {
    //     if(!is_array($options) || empty($options)) return false;
    //     $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-inline input-custom-width"><select name="'.$name.'" lay-verify="'.$verify.'">';
    //     $string .= '<option value="" >请选择</option>';
    //     foreach( $options as $key => $option ) {
    //         $selected = ($value == $key) ? true : false;
    //         $string .= '<option value="'.$key.'" '.($selected ? ' selected="" ' : '').' >'.$option.'</option>';
    //     }
    //     $string .= '</select></div><div class="layui-form-mid layui-word-aux">'.$description.'</div></div>';
    //     return $string;
    // }
    
    static public function select($name, $value, $label, $description='', $options = array(), $keys='name' ,$default='' ) {
        // if(!is_array($options) || empty($options)) return false;
        $default = empty($default)?'顶级栏目':$default;
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-inline input-custom-width"><select name="'.$name.'">';
        $string .= '<option value="0" >'.$default.'</option>';
        foreach( $options as $key => $option ) {
            $selected = ($value == $option['id']) ? true : false;
            $string .= '<option value="'.$option['id'].'" '.($selected ? ' selected="" ' : '').' >'.$option['title_show'].$option[$keys].'</option>';
        }
        $string .= '</select></div><div class="layui-form-mid layui-word-aux">'.$description.'</div></div>';
        return $string;
    }


    static public function select2($name, $value, $label, $description='', $options = array() ,$default='' ) {
        // if(!is_array($options) || empty($options)) return false;
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-inline input-custom-width"><select name="'.$name.'">';
        $string .= '<option value="0" >顶级栏目</option>';
        foreach( $options as $key => $option ) {
            $option = explode(':', $option);
            $selected = ($value == $option[0]) ? true : false;
            $string .= '<option value="'.$option[0].'" '.($selected ? ' selected="" ' : '').' >'.$option['title_show'].$option[1].'</option>';
        }
        $string .= '</select></div><div class="layui-form-mid layui-word-aux">'.$description.'</div></div>';
        // dumps($value);
        return $string;
    }

    /**
     * 无option下拉框
     * @param string $name  表单名称
     * @param string $value 默认值
     * @param array $options 选项列表
     * @return string
     */
    static public function select_no_option($name, $value, $label, $description='', $options = '<option value="" >请选择</option>', $verify='' ) {
        if(!is_array($options) || empty($options)) return false;
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-inline input-custom-width"><select name="'.$name.'" lay-verify="'.$verify.'">';
        $string .= $options;
        $string .= '</select></div><div class="layui-form-mid layui-word-aux">'.$description.'</div></div>';
        return $string;
    }

    /**
     * 文件上传
     * @param string $name  表单名称
     * @param string $value 默认值
     * @param array $file_type 文件类型
     * @param array $file_ext 文件后缀
     * @param array $title 显示文字
     * @param array $id input的id
     * @return string
     */
    static public function file($name, $value, $label, $description='', $file_type='images', $file_ext='', $title='',$id='image' ) {
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-inline input-custom-width">';
        $string .= '<input type="text" name="'.$name.'" value="'.$value.'" lay-verify="" autocomplete="off" class="layui-input"><input type="file" name="file" lay-method="post" lay-type="'.$file_type.'" lay-ext="'.$file_ext.'" lay-title="'.$title.'" class="layui-upload-file" id="'.$id.'">';
        $string .= '</div><div class="layui-form-mid layui-word-aux">'.$description.'</div></div>';
        return $string;
    }

    /**
     * 图片上传
     */
    // <script type="text/javascript">
    //   $("#uploadBtn_'.$name.'").pluploadQueue({
    //     url: "'.U('Upload/upload').'",
    //     multipart_params: { path:"setting", size:2, ajax:1, sessiocat_id:1, PHPSESSID:"'.session_id().'" },
    //     callSuccess: uploadBtn_'.$name.',
    //     multi_selection: false
    //   });
    //   function uploadBtn_'.$name.'(result) {
    //     if (result.status == 0) {
    //         layer.msg(result.message, {icon:5, time:2500});
    //         return false;
    //     }
    //         $("#'.$name.' .img_container").show();
    //         $("#'.$name.'").find(".showimg").attr("src", result.data.b);
    //         $("#'.$name.'").find(".hideimg").val(result.data.b);
    //     }
    // </script>
    
    static public function upload($name, $value, $label, $description='',$file="info",$is_album = 0,$select = ''){
        if($is_album == 1){
            $value = $value?unserialize($value):array();
        }
        $count = count($value)?count($value):0;
        $string = '<div class="layui-form-item">
                    <label class="layui-form-label">'.$label.'</label>
                    <div class="layui-input-inline input-custom-width" id="'.$name.'" data-count="'.$count.'">';
        if($is_album == 0){
            $string .= '<div class="img_container" style="">
                        <img src="'.get_img($value).'" class="showimg" style="height:100px" />
                        <a href="javascript:void(0);" class="delOneImg" data-nopic="1">删除</a>
                        <input type="hidden" name="'.$name.'" class="hideimg" value="'.$value.'">
                    </div>';
        }else{
            foreach ($value as $key => $val) {
                $string .= '<div class="img_container width goods_drag" style="">
                    <img src="'.$val['image'].'" class="img_src" style="height:100px" />
                    <a href="javascript:void(0);" class="delImg">删除</a>';
                if(empty($select)){
                    $string .= '<input type="text" name="'.$name.'['.$key.'][intro]" class="layui-input" placeholder="说明" value="" />';
                }else{
                    $string .= '<select name="'.$name.'['.$key.'][select]">';
                    $options = explode(',', $select);
                    foreach ($options as $k => $option) {
                        $option = explode(':', $option);
                        $selected = $option[1] == $val['select'] ? 'selected=""' : '';
                        $string .= '<option value="'.$option[1].'" '.$selected.'>'.$option[1].'</option>';
                    }
                    $string .= '</select>';
                }
                $string .= '<input type="hidden" name="'.$name.'['.$key.'][image]" value="'.$val['image'].'">
                </div>';
            }
        }
        
        $string .= '</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="goods_swfupload" data-name="'.$name.'" data-dir="upload" style="width:auto;">
                    <button type="button" class="layui-btn fa fa-arrow-circle-o-up formUploadBtn" id="uploadBtn_'.$name.'" data-id="'.$name.'" data-url="'.U('Upload/upload').'" data-file="'.$file.'" data-session="'.session_id().'" data-isalbum="'.$is_album.'" data-select="'.$select.'">上传文件</button>
                </div>
                <div id="uploadBtn_'.$name.'-filelist">Your browser doesn\'t have Flash, Silverlight or HTML5 support.</div>
                <div class="layui-form-mid layui-word-aux">'.$description.'</div>
            </div>';
        return $string;
        // <button type="button" class="layui-btn fa fa-inbox selectImg" data-name="'.$name.'" data-dir="'.$name.'" data-multi="">从服务器选择</button>
    }
    
    /**
     * 日期时间
     * @param string $name  表单名称
     * @param string $value 默认值
     * @param array $options 选项列表
     * @return string
     */
    static public function date($name, $value, $label, $description='',$placeholder='YYYY-MM-DD hh:mm:ss',$verify='datetime' ,$istime = true) {
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label>';
        $string .='<div class="layui-input-inline input-custom-width"><input type="text" name="'.$name.'" value="'.$value.'" id="date" lay-verify="'.$verify.'" placeholder="'.$placeholder.'" autocomplete="off" class="layui-input" onclick="layui.laydate({elem: this,istime: '.$istime.', format: \'YYYY-MM-DD hh:mm:ss\' })"></div>';
        if($description) {
            $string .= '<div class="layui-form-mid layui-word-aux">'.$description.'</div>';
        }
        $string .= '</div>';
        return $string;
    }

    /**
     * 百度编辑器
     * @param string $name   表单名称
     * @param string $value  默认值
     * @param string $width 宽度
     * @param string $height 高度
     * @return string
     */
    static public function umeditor($name, $value='',$label, $width ='100%', $height = '500',$toolbar = FALSE,$id='umeditor') {
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label>';
        $string .= '<div class="layui-input-block"><script type="text/plain" id="'.$id.'" style="width:'.$width.';height:'.$height.';">'.$value.'</script></div>';
        $string .= '</div>';

        $width = (!empty($width)) ? $width : '100%';
        $height = (!empty($height)) ? $height : '500';

        $string .= '<script type="text/javascript">';

        $string .= 'var um_'.$id.' = UM.getEditor(\''.$id.'\', {
            textarea : \''.$name.'\'
            ,initialFrameWidth:\''.$width.'\'
            ,initialFrameHeight:\''.$height.'\'
            ,imageUrl:\''.url('upload/upload').'\'
            ,imageFieldName:\'file\'';
        if($toolbar){
            $string .= ',toolbar:[ \''.$toolbar .'\']';
        }
            
        $string .= '});';
        $string .= '</script>';
        return $string;
    }

    /**
     * wang编辑器
     */
    static public function editor($name, $value='',$label, $width ='500px', $height = '300px'){
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label>';
        $string .= '<div class="layui-input-block"><textarea name="'.$name.'" id="'.$name.'" style="width:'.$width.';max-width:'.$width.';height:'.$height.';">'.$value.'</textarea></div></div>';
        $string .= '<script type="text/javascript">
                  var editor = new wangEditor('.$name.');
                  wangEditor.config.printLog = false;
                  editor.config.uploadImgUrl = "'.U('Upload/editorUpload',array('path'=>'editor')).'";
                  editor.config.uploadImgFileName = "imgFile";
                  editor.config.hideLinkImg = false;
                  editor.create();
                </script>';
        return $string;
    }

    /**
     * 图集
     * @param string $name  表单名称
     * @param array $value 默认值
     * @return string
     */
    static public function images($name, $value, $label, $description='',$id = 'images') {
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label><div class="layui-input-block images-block-container">';
        if(is_array($value)){
            foreach ($value as $k => $v) {
                $string .= '<div class="image-block"><input type="hidden" name="images['.$k.']" value="'.$v.'" class="images-input"><img class="img" src="'.$v.'"><div class="image-block-mask"><span class="del_btn"><i class="layui-icon">&#x1006;</i></span><a class="layui-btn set-index">设为主图</a></div></div>';
            }
        }
        $string .= '<div class="image-add-blcok"><input type="file" name="file" lay-method="post" lay-type="images"  lay-title="" class="layui-upload-file" id="'.$id.'"></div></div>';
        if($description) {
            $string .= '<div class="layui-form-mid layui-word-aux">'.$description.'</div>';
        }
        $string .= '</div>';
        return $string;
    }

    /**
     * 单行文本  选择图标
     * @param string $name   表单名称
     * @param string $value  默认值
     * @param array $label   参数
     * @param array $description   表单提示
     * @param array $verify   验证方式
     * @return string
     */
    static public function input_icon($type = 'text',$name, $value, $label, $description='',$placeholder='',$verify='',$is_readonly = false) {
        $string = '<div class="layui-form-item"><label class="layui-form-label">'.$label.'</label>';
        $string .= '<div class="layui-input-inline input-custom-width"><input type="'.$type.'" name="'.$name.'" value="'.$value.'" lay-verify="'.$verify.'" autocomplete="off" placeholder="'.$placeholder.'" '.($is_readonly ? 'readonly' : '').' class="layui-input"></div>';
        $string .= '<div class="layui-form-mid layui-form-icon"><i class="fa '.$value.'"></i></div><div class="layui-form-mid layui-form-icon" onclick="layer_show(\'图标\',&quot;'.U('Index/icon').'&quot)">查看图标</div>';
        if($description) {
            $string .= '<div class="layui-form-mid layui-word-aux">'.$description.'</div>';
        }
        $string .= '</div>';
        return $string;
    }

}
?>