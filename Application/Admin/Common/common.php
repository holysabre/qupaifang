<?php

// 模板列表编辑调用
function get_span($value, $id, $field = 'name', $preg = '', $msg = '') {
    $str = $preg ? ' data-preg="' . $preg . '"' : '';
    $str .= $msg ? ' data-msg="' . $msg . '"' : '';
    return '<span data-tdtype="edit" data-field="' . $field . '" data-id="' . $id . '"'.$str.' class="fa fa-edit" title="点击即可编辑">' . $value . '</span>';
}

// 模板列表切换调用
function get_toggle($value, $id, $field = 'status', $btn = true) {
    $font = explode(',', $text);
    if ($btn === true) {
    	$checked = $value==1?'checked':'';
        return '<input type="checkbox" class="input_toggle" name="switch" lay-skin="switch" data-id="' . $id . '" data-field="' . $field . '" data-val="' . $value . '" '.$checked.' />';
    }
}

// 转换小写替换空格
function str_lower($str) {
    $str = trim($str);
    $str = strtolower($str);
    $str = str_replace(' ', '_', $str);
    return $str;
}



/**
* 计算文件大小
*
* @param int    $bytes
* @return string
*/
function byte_format($bytes) {
    $sizetext = array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");
    $i = floor(log($bytes, 1024));
    return round($bytes / pow(1024, $i), 2) . $sizetext[$i] . ' ';
}

// 循环删除文件及文件夹
function delDirAndFile($path, $delDir = false) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ($item = readdir($handle))) {
            if ($item != "." && $item != "..") {
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
            }
        }
        closedir($handle);
        if ($delDir) {
            return rmdir($path);
        }
    } else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return false;
        }
    }
}
