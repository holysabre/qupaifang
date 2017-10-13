<?php
namespace Home\Model;
use Think\Model;
class ProductsModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //列表
    public function getIndex(){
    	$pagenum = 16;
        $catid   = I('request.catid');
        $keywords= I('request.keywords');
        $min_price = I('request.min_price','','intval');
        $max_price = I('request.max_price','','intval');
        $price = I('request.price');
        $order = I('request.order');

        $where = array();

        if($catid && $catid != ''){
        	$category = D('Category')->procategory('products');
        	$ids = tree_child($category,$catid);
        	array_push($ids,$catid);
        	$where['catid'] = array('in',$ids);
        }

        if($min_price && $max_price){
            $where['price'] = array('between',array($min_price,$max_price));
        }else{
            if($min_price){
            $where['price'] = array('gt',$min_price);
            }
            if($max_price){
                $where['price'] = array('lt',$max_price);
            }
        }

        
        if ($keywords != '') $where['title'] = array('like', "%{$keywords}%");

        $where['is_show'] = 1;
        $where['stock'] = array('gt',0);//库存为0时 不显示

        if($order){
            $order = 'sort asc,id '.$order;
        }else{
            $order = 'sort asc,id desc';
        }

        $count = $this->where($where)->count();
        $Page  = new \Think\Page($count, $pagenum, I('request.'));
        $Page->setConfig('header', '<span class="info">共 %TOTAL_ROW% 条记录</span>');
        $array = $this->where($where)->order($order)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        //echo $this->getLastSql();
        $data = array();
        $data = I('request.');
        $data['list'] = $array;
        $data['page'] = $Page->show();
        $data['count'] = $count;
        return $data;
    }

    //详情
    public function getInfo(){
    	$id = I('request.id');
    	if(!$id) return false;
    	$info = $this->find($id);
    	$info['imgdata'] = unserialize($info['imgdata']);
        //增加点击数
        $res = $this->where("id = $id")->setInc('click',1);
    	return $info;
    }

}