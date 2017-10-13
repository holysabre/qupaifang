<?php
namespace Home\Model;
use Think\Model;
class PageModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //列表
    public function getNavigation($where = array()){
        $where['is_show'] = 1;
        $where['pid'] || $where['pid'] = 0;
        $list = $this->field('id,pid,title,tag,is_show,recommend,html,sort')->where($where)->select();
        return $list;
    }

    //详情
    public function getInfo(){
    	$id = I('request.id');
        $where = array();
        $where['id'] = $id;
        $info = $this->where($where)->find();
        if(!$id){
            $list = $this->where(array('is_show'=>1))->order('id asc')->select();
            $info = reset($list);
        }
        if(empty($info['content'])){
            $nav = $this->getNavigation($info['id']);
            $nav = reset($nav);
            $info = $this->find($nav['id']);
        }
        //dumps($info);
        return $info;
    }

}