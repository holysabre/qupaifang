<?php
namespace Home\Model;
use Think\Model;
class ArticleModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //列表
    public function getList(){
    	$pagenum = 5;
        $catid   = I('request.catid');
        $keywords= I('request.keywords');

        if($catid && $catid != ''){
        	$category = D('Category')->getCategory('news');
        	$ids = tree_child($category,$catid);
        	array_push($ids,$catid);
        	$where['a.catid'] = array('in',$ids);
        }

        if ($keywords != '') $where['a.title'] = array('like', "%{$keywords}%");

        $where['a.is_show'] = 1;
        $order = 'a.sort asc,a.addtime desc';

        $count = $this->where($where)->count();
        $Page  = new \Think\Page($count, $pagenum, I('request.'));
        $Page->setConfig('header', '<span class="info">共 %TOTAL_ROW% 条记录</span>');
        // $array = $this->where($where)->order($order)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $array = M()->field('a.*,c.title as cate_title')->table('p_article as a')->join('left join p_category as c on a.catid = c.id')->where($where)->order($order)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        //echo M()->_sql();
        $data = array();
        $data = I('request.');
        $data['list'] = $array;
        $data['page'] = $Page->show();
        $data['count'] = $count;
        //dumps($data);
        return $data;
    }

    //详情
    public function getInfo(){
    	$id = I('request.id');
    	if(!$id) return false;
        $where['a.id'] = $id;
    	$info = M()->field('a.*,c.title as cate_title')->table('p_article as a')->join('left join p_category as c on a.catid = c.id')->where($where)->find();
        //增加点击数
        $res = $this->where("id = $id")->setInc('clickcount',1);
    	return $info;
    }

    //获取status列表
    public function getListStatus($status,$limit){
        $where = array();
        $where['status'] = array('in',$status);
        $where['is_show'] = 1;
        $order = 'sort asc,addtime desc';
        $list = $this->where($where)->order($order)->limit($limit)->select();
        // echo M()->_sql();
        // dumps($list);
        return $list;
    }

    //根据条件获取文章条数
    public function getLimitList($data = array()){
        if($data['cid']) $where['a.cid'] = $data['cid'];
        if($data['status']) $where['a.status'] = $data['status'];
        $where['a.is_show'] = 1;
        $limit = $data['limit'] ? $data['limit'] : 10;
        $order = 'a.sort asc,a.addtime desc';
        $list = M()->field('a.*,c.title as cate_title')->table('p_article as a')->join('left join p_category as c on a.catid = c.id')->where($where)->order($order)->limit($limit)->select();
        return $list;
    }

}