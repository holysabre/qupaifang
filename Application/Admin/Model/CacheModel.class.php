<?php
namespace Admin\Model;
use Think\Model;
class CacheModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function cache($table){
    	$table = $table.'Cache';
    	$this->$table();
    }

    //菜单缓存
    public function menuCache(){
    	S('menu',null);
    	$where['is_left'] = 1;
        $where['is_show'] = 1;
        $data = M('menu')->where($where)->order('sort asc')->select();
        $data = list_to_tree($data);
        S('menu',$data);
    }

    //分类缓存
    public function categoryCache(){
        S('category',null);
        $where = $_data = array();
        $data = M('category')->where($where)->order('sort asc')->select();
        foreach ($data as $key => $value) {
            if($_data[$value['type']] == $value['type']){
                $_data[$value['type']][] = $value;
            }else{
                $_data[$value['type']][] = $value;
            }
        }
        S('category',$_data);
    }

    //站点设置缓存
    public function configCache(){
        S('site',null);
        $where = array();
        $where['is_show'] = 1;
        $data = M('config')->where($where)->select();
        S('site',$data);
    }

}