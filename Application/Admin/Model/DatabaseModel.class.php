<?php
namespace Admin\Model;
use Think\Model;
class DatabaseModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    // 读取数据库表结构信息
    public function bakupTable($table_list) {
        M()->query("SET SQL_QUOTE_SHOW_CREATE = 1"); //1，表示表名和字段名会用``包着的,0 则不用``
        $outPut = '';
        if (!is_array($table_list) || empty($table_list)) {
            return false;
        }
        foreach ($table_list as $table) {
            $outPut.="-- 数据库表：`{$table}` 结构信息\n";
            $outPut .= "DROP TABLE IF EXISTS `{$table}`;\n";
            $tmp = M()->query("SHOW CREATE TABLE {$table}");
            $outPut .= $tmp[0]['Create Table'] . " ;\n\n";
        }
        return $outPut;
    }
    
    // 读取已经备份SQL文件列表，并按备份时间倒序，名称升序排列
    public function getSqlFilesList() {
        $list = array();
        $size = 0;
        $path = RUNTIME_PATH . 'Backup/';
        $handle = opendir($path);

        while ($file = readdir($handle)) {
            if (preg_match('#\.sql$#i', $file)) {
                $fp = fopen($path . $file, 'rb');
                $bakinfo = fread($fp, 2000);
                fclose($fp);
                $detail = explode("\n", $bakinfo);
                $bk = array();
                $bk['name'] = $file;
                //$bk['type'] = substr($detail[1], 9);
                //$bk['description'] = substr($detail[3], 15);
                //$bk['time'] = substr($detail[4], 9);
                $_size = filesize($path . $file);
                $bk['size'] = byte_format($_size);
                $size+=$_size;
                $bk['pre'] = substr($file, 0, strrpos($file, '_'));
                //$bk['num'] = substr($file, strrpos($file, '_') + 1, strrpos($file, '.') - 1 - strrpos($file, '_'));
                $mtime = filemtime($path . $file);
                $bk['time'] = $mtime;
                $list[$mtime][$file] = $bk;
            }
        }
        closedir($handle);
        krsort($list); //按备份时间倒序排列
        $newArr = array();
        foreach ($list as $k => $array) {
            ksort($array); //按备份文件名称顺序排列
            foreach ($array as $arr) {
                $newArr[] = $arr;
            }
        }
        unset($list);
        return array("list" => $newArr, "size" => byte_format($size));
    }
    
    // 生成数据表结构
    public function bakStruct($table_list) {
        $sql = '';
        if (!is_array($table_list) || empty($table_list)) {
            return false;
        }
        foreach ($table_list as $table){
            $sql .= "--\r\n";
            $sql .= "-- 数据表结构: `$table`\r\n";
            $sql .= "--\r\n\r\n";
            $sql .= "DROP TABLE IF EXISTS `$table`;\r\n";
            $query  = M()->query("SHOW CREATE TABLE `$table`"); 
            $sql .= $query[0]['Create Table'] . ";\r\n\r\n";
            $sql .= $this->bakRecord($tbName);
            $sql .= "\r\n";
        }
        return str_replace(',)',')',$sql);
    }
    
    // 生成数据表中的数据
    public function bakRecord($tbName) {
        $rs = M()->query('select * from '.$tbName);
        if(count($rs)<=0) { return ''; }
        foreach ($rs as $k=>$v) {
            $sql .= "INSERT INTO `$tbName` VALUES (";
            foreach ($v as $key=>$value){
                
                if($value=='') {
                    $value = '';
                }
                $type = gettype($value);
                if($type=='string') {
                    $value = "'".addslashes($value)."'";
                }
                $sql .= "$value," ;
            }
            $sql .= ");\r\n";
        }
        return str_replace(',)',')',$sql);
    }

}