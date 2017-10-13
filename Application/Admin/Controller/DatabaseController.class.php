<?php
namespace Admin\Controller;
use Think\Controller;
class DatabaseController extends BaseController {

	private $model = '';
    private $size = 0;
    public function __construct() {
        parent::__construct();
        $this->model = D('Database');
        $this->size = 1024*1024*2;
    }

    public function index(){
    	$dbName = C('DB_NAME');
        $data = M()->query('SHOW TABLE STATUS FROM `'.$dbName.'`');
        $this->assign("data", $data);
        $this->display();
        //dump($data);
    }

    // 恢复列表
    public function restore() {
        if (IS_POST) {
            $this->restorePost();
        } 
        else {
            $data = D("Database")->getSqlFilesList();
            $this->assign("list",  $data['list']);
            $this->assign("total", $data['size']);
            $this->assign("files", count($data['list']));
            $this->display();
        }
    }

    // 执行语句
    public function sqlPost() {
        if (IS_POST) {
            $sql = I('post.sql');
            if ($sql == '') {
                $this->assign('type',  0);
                $this->assign('error', '请先输入SQL语句');
            } 
            else {
                $this->_assignSql($sql);
            }
        } 
        else {
            $this->assign('sql', '');
            $this->assign('type', -1);
        }
        $this->display();
    }

    // 修复 优化 查看结构
    public function index_step() {
        $step   = I('get.step');
        if ($step != 2) {
            $this->ajax_check('非法参数!');
        }
        $value    = I('get.value');
        $url    = explode("|", $value);
        $do     = $url[0];
        $table  = $url[1];
        $model  = M();
        switch($do) {
        case 'optimize'://优化
            $rs = $model->query("OPTIMIZE TABLE `$table` ");
            if($rs) {
                $this->ajax_check("执行优化表： $table  成功!",1);
                
            }
            else {
                $this->ajax_check("执行优化表： $table  失败,原因是: ". $model->getDbError());
                
            }
            break;
        case 'repair'://修复
            $rs = $model->query("REPAIR TABLE `$table` ");
            if($rs) {
                $this->ajax_check("修复表： $table  成功!",1);
                
            }
            else {
                $this->ajax_check("修复表： $table  失败,原因是: ". $model->getDbError());
            }
            break;
        default://结构
            $query = $model->query("SHOW CREATE TABLE `$table`");
            if ($query) {
                $this->ajax_check('<pre>'.trim($query[0]['Create Table']).'</pre>', 1);
            }
        }
        $this->ajax_check('非法使用!!!');
    }

    // 备份数据库
    public function export() {
        $tables     = I('post.tables');
        if ( isset($_POST['systemBackup']) ) {
            if (!in_array( $this->admin['adminroleid'], array(1,2))) {
                $this->ajax_check('只有创始人(超级管理员)|管理员账号登录后方可自动备份操作!');
            }
            
            $dir    = RUNTIME_PATH . 'Backup/'.date('Ym');
            if (file_exists($dir.'_1.sql')) {
                $this->ajax_check('本月度系统已经进行了自动备份操作!');
            }
            
            $type   = '系统自动备份';
            $table  = $this->getTable();
        } 
        else {
            $type   = '管理员后台手动备份';
            if(empty($tables)) {
                $table = $this->getTable();
            } 
            else {
                $table = $tables;
            }
            $dir    = RUNTIME_PATH . 'Backup/'.date('YmdHis').rand(10000,99999);
        }
        
        if (count($table) == 0 && !isset($_POST['systemBackup'])) {
            $this->ajax_check('请先选择要备份的表!');
        }
        
        $time = time();
        
        //$dataTable  = $this->getTable('eg_all');
        //$this->pt($dataTable);
        $model      = M();
        
        $file_n     = 1;
        $content    = '/* This file is created by MySQLReback ' . date('Y-m-d H:i:s') . ' */';
        foreach ($table as $dbName) {
            
            // 创建表结构
            $tableRs = mysql_query("SHOW CREATE TABLE `{$dbName}`");
            if ($tableRow = mysql_fetch_row($tableRs)) {
                $content .= "\n-- 创建表结构 {$dbName} --";
                $content .= "\nDROP TABLE IF EXISTS `{$dbName}`;-- MySQLReback --\n{$tableRow[1]};-- MySQLReback --";
            }
            
            $content .= "\n-- 插入数据 {$dbName} --\n";
            $rs = mysql_query("SHOW TABLE STATUS LIKE '{$dbName}'");
            if ( $row = mysql_fetch_assoc($rs) ) {
                $page = ceil($row['Rows'] / 10000) - 1;
                for ($i = 0; $i <= $page; $i++) {
                    $res = mysql_query("SELECT * FROM `{$dbName}` LIMIT " . ($i * 10000) . ", 10000");
                    $data = array();
                    while ($row = mysql_fetch_assoc($res)) {
                        //$data[] = $row;
                        $tn = 0;
                        $temSql = '';
                        foreach ($row as $v) {
                            $temSql .= $tn == 0 ? "" : ",";
                            $temSql .= $v == '' ? "''" : "'".addslashes($v)."'";
                            $tn++;
                        }
                        $temSql = "INSERT INTO `{$dbName}` VALUES ({$temSql});-- MySQLReback --\n";
                        
                        $sqlNo = "-- 当前SQL卷标：#{$file_n} -- \n\n";
                        if ( strlen($sqlNo) + strlen($content) + strlen($temSql) > $this->size ) {
                            $file = $dir ."_" . $file_n . ".sql";
                            $content = $file_n == 1 ? $sqlNo . $content : $sqlNo . $content;
                            file_put_contents($file, $content, FILE_APPEND);
                            $content = "";
                            $file_n++;
                        }
                        $content .= $temSql;
                    }
                }
            } 
        }
        
        if (strlen($content) > 0) {
            $sqlNo = "-- 当前SQL卷标：#{$file_n} --\n\n";
            $file = $dir . "_" . $file_n . ".sql";
            $content = $file_n == 1 ? $sqlNo . $content : $sqlNo . $content;
            file_put_contents($file, $content, FILE_APPEND);
            $file_n++;
        }
        /*
        if (!empty($content)) {
            $fileName = date('YmdHis') . '_' . mt_rand(100000000, 999999999) . '.sql';
            if ( !file_put_contents($fileName, $content, LOCK_EX) ) {
                $this->ajax_check('写入文件失败,请检查磁盘空间或者权限!');
            }
        }*/
        $time = time() - $time;
        
        if(file_exists($file)) {
            $this->ajax_check("备份成功,生成" . ($file_n - 1) . "个文件,耗时: {$time} 秒!", 1);
        } 
        else {
            $this->ajax_check("备份失败!");
        }
        return true;
    }

    // 获取数据库中所有表
    private function getTable() {
        $dbName = C('DB_NAME');
        $result = M()->query('SHOW TABLES FROM `'.$dbName.'`');
        $arr    = array();
        foreach ($result as $tab){
            //$arr[] = $table[0];
            $arr[] = $tab['Tables_in_' . $dbName];
        }
        return $arr;
    }

    // 恢复数据库
    public function restorePost() {
        function_exists('set_time_limit') && set_time_limit(0); //防止备份数据过程超时
        $file = I('post.file');
        $glob = glob(RUNTIME_PATH . 'Backup/'.$file.'*.sql');
        
        $model      = M();
        $time       = time();
        
        foreach ($glob as $file) {
            if (!file_exists($file)) continue;
            $content = file_get_contents($file);
            if (!empty($content)) {
                $content = explode(';-- MySQLReback --', $content);
                foreach ($content as $i => $sql) {
                    $sql = trim($sql);
                    if (!empty($sql)) $rs = $model->query($sql);
                }
            }
        }
        $time = time() - $time;
        $this->ajax_check("导入成功,耗时：{$time} 秒钟!", 1);
    }
    
    // 删除文件
    public function delete(){
        $sqlFiles = I('post.sqlFiles');
        $sqlFiles = explode(',', $sqlFiles);
        
        if($sqlFiles) {
            foreach ($sqlFiles as $file) {
                delDirAndFile(RUNTIME_PATH . 'Backup/' . $file);
            }
            $this->ajax_check("备份文件删除成功!",1);
        } 
        else {
            $this->ajax_check("参数错误!");
        }
    }
    
    private function _assignSql($sql) {
        $model = M();
        $sql = stripslashes($sql);
        
        $this->assign('sql', $sql);

        /* 解析查询项 */
        $sql = str_replace("\r", '', $sql);
        $query_items = explode(";\n", $sql);
        foreach ($query_items as $key=>$value) {
            if (empty($value)) {
                unset($query_items[$key]);
            }
        }
        /* 如果是多条语句,拆开来执行 */
        if (count($query_items) > 1) {
            foreach ($query_items as $key=>$value) {
                if ($model->query($value)) {
                    $this->assign('type',  1);
                } 
                else {
                    $this->assign('type',  0);
                    $this->assign('error', $model->getDbError());
                    return;
                }
            }
            return; //退出函数
        }

        /* 单独一条sql语句处理 */
        if (preg_match("/^(?:UPDATE|DELETE|TRUNCATE|ALTER|DROP|FLUSH|INSERT|REPLACE|SET|CREATE)\\s+/i", $sql)) {
            if ($model->query($sql)) {
                $this->assign('type',  1);
            } 
            else {
                $this->assign('type',  0);
                $this->assign('error', $model->getDbError());
            }
        } 
        else {
            $data = $model->query($sql);
            if ($data === false) {
                $this->assign('type',  0);
                $this->assign('error', $model->getDbError());
            } 
            else {
                $result = '';
                if (is_array($data) && isset($data[0]) === true) {
                    $result = "<table class=\"noalt\">\n<thead>\n<tr>";
                    $keys = array_keys($data[0]);
                    for ($i = 0, $num = count($keys); $i < $num; $i++) {
                        $result .= "<th>" . $keys[$i] . "</th>\n";
                    }
                    $result .= "</tr>\n</thead>\n";
                    foreach ($data AS $data1) {
                        $result .= "<tbody>\n<tr>\n";
                        foreach ($data1 AS $value) {
                            $result .= "<td>" . $value . "</td>";
                        }
                        $result .= "</tr>\n</tbody>\n";
                    }
                    $result .= "</table>\n";
                } 
                else {
                    $result ="<center><h3>没有数据</h3></center>";
                }

                $this->assign('type',   2);
                $this->assign('result', $result);
            }
        }
    }
}