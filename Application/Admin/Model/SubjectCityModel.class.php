<?php
namespace Admin\Model;
use Think\Model;
class SubjectCityModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $where = array();
        $list = $this->where($where)->order('sort asc,id asc')->select();
        //echo $this->getLastSql();
        return $list;
    }

    public function edit($id){
    	if(IS_POST){
    		$data = $this->create();
    		if($data){
    			$data['time'] = time();
    			if($id == 0){
    				$add = $this->add($data);
	    			if($add){
	    				$this->admin_log_add('', '添加城市成功,ID:'.$add.', 标题:'.$data['name'], 2);
	    				$this->ajax_check('添加城市成功!', 1);
	    			}else{
	    				$this->ajax_check('添加城市失败!');
	    			}
    			}else{
    				if($this->save($data)){
    					$this->admin_log_add('', '更新城市成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新城市成功!', 1);
    				}else{
    					$this->ajax_check('更新城市失败!');
    				}
    			}
    		}else{
    			$this->ajax_check($this->getDbError());
    		}
    	}
    }

    public function findOne($id){
    	if($id){
    		$info = $this->find($id);
    		return $info;
    	}
    }

    public function findAll(){
    	$where = array();
    	$list = $this->field('id,name')->where($where)->order('sort asc')->select();
    	return $list;
    }


    // 删除
    public function deleteOne() {
        $ids    = trim(I('request.id'), ',');
        
        if ($ids == '') {
            $this->ajax_check('请选择要操作的数据!');
        }
        $map = array('id' => array('IN', $ids) );
        if (false !== $this->where($map)->delete()) {
            $this->admin_log_add('', '删除产品成功,ID:'.$ids, 2);
            $this->ajax_check('删除产品成功!', 1);
        } else {
            $this->ajax_check('删除产品失败!');
        }
        
    }

    //标的分类  根据pid返回列表
    public function getListByPid($pid){
        $where = array();
        $where['pid'] = $pid;
        $list = $this->where($where)->select();
        $list = lists_key($list);
        return $list;
    }

}