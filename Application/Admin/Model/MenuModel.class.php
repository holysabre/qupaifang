<?php
namespace Admin\Model;
use Think\Model;
class MenuModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	$data = $this->order('sort asc')->select();
    	return $data;
    }

    public function edit($id){
    	if(IS_POST){
    		$data = $this->create();
    		if($data){
    			$data['time'] = time();
    			if($id == 0){
    				$add = $this->add($data);
	    			if($add){
	    				$this->admin_log_add('', '添加菜单成功,ID:'.$add.', 标题:'.$data['name'], 2);
	    				$this->ajax_check('添加菜单成功!', 1);
	    			}else{
	    				$this->ajax_check('添加菜单失败!');
	    			}
    			}else{
    				if($this->save($data)){
    					$this->admin_log_add('', '更新菜单成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新菜单成功!', 1);
    				}else{
    					$this->ajax_check('更新菜单失败!');
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
    	$info = $this->field('id,name,pid')->where($where)->order('sort asc,id asc')->select();
    	return $info;
    }

    // 删除
    public function deleteOne() {
        $ids    = trim(I('request.id'), ',');
        
        if ($ids == '') {
            $this->ajax_check('请选择要操作的数据!');
        }
        
        /* 当前分类下是否有子分类 */
        $cat_count  = $this->where(array('pid'=>$ids))->count();
        
        /* 如果不存在下级子分类和数据，则删除之 */
        if ($cat_count == 0) {
            $map = array('id' => array('IN', $ids) );
            if (false !== $this->where($map)->delete()) {
                $this->admin_log_add('', '删除菜单成功,ID:'.$ids, 2);
                $this->ajax_check('操作菜单成功!', 1);
            } else {
                $this->ajax_check('操作菜单失败!');
            }
        } else {
            $this->ajax_check('不是末级分类或者此分类下还存在有数据,您不能删除!');
        }
    }

    //获取头部菜单
    public function getTopMenu(){
        $admin = $this->admin;
        if($admin['is_system'] != 1){
            $nodes = D('AdminRole')->nodes($admin['adminroleid']);
            $admin_role = explode(',', $nodes);
            $where['id'] = array('in',$admin_role);
        }
        $where['pid'] = 0;
        $where['is_show'] = 1;
        $menu = $this->where($where)->order('sort asc')->select();
        return $menu;
    }

    //获取左侧菜单
    public function getLeftMenu($id){
        $menu = S('menu');
        $menu = $menu[$id]['_child'];
        $admin = $this->admin;
        if($admin['is_system'] != 1){
            $nodes = D('AdminRole')->nodes($admin['adminroleid']);
            $admin_role = explode(',', $nodes);
            foreach ($menu as $key => $value) {
                if(in_array($key,$admin_role)){
                    $_menu[$key] = $value;
                }
            }
            return $_menu;
        }else{
            return $menu;
        }
    }
}