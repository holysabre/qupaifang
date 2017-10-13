<?php
namespace Admin\Model;
use Think\Model;
class AdminRoleModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        //超管权限
    	$data = $this->select();
    	return $data;
    }

    public function edit($id){
    	if(IS_POST){
    		$data = $this->create();
    		if($data){
                $data['nodes'] = implode(',', $data['nodes']);
    			$data['time'] = time();
    			if($id == 0){
    				$add = $this->add($data);
	    			if($add){
	    				$this->admin_log_add('', '添加角色成功,ID:'.$add.', 标题:'.$data['name'], 2);
	    				$this->ajax_check('添加角色成功!', 1);
	    			}else{
	    				$this->ajax_check('添加角色失败!');
	    			}
    			}else{
    				if($this->save($data)){
    					$this->admin_log_add('', '更新角色成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新角色成功!', 1);
    				}else{
    					$this->ajax_check('更新角色失败!');
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
        $where['id'] = array('neq',0);
    	$list = $this->where($where)->select();
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
            $this->admin_log_add('', '删除角色成功,ID:'.$ids, 2);
            $this->ajax_check('操作角色成功!', 1);
        } else {
            $this->ajax_check('操作角色失败!');
        }
        
    }

    //获取节点
    public function getNodes(){
        $list = D('Menu')->index();
        $list = tree_list($list);
        return $list;
    }

    // 取角色数据
    public function nodes($id) {
        $result = $this->where( array('id'=>$id) )->getField('nodes');
        return $result;
    }

}