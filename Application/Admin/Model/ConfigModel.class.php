<?php
namespace Admin\Model;
use Think\Model;
class ConfigModel extends BaseModel {

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
                        $cache = D('Cache')->configCache();
	    				$this->admin_log_add('', '添加配置成功,ID:'.$add.', 标题:'.$data['name'], 2);
	    				$this->ajax_check('添加配置成功!', 1);
	    			}else{
	    				$this->ajax_check('添加配置失败!');
	    			}
    			}else{
    				if($this->save($data)){
                        $cache = D('Cache')->configCache();
    					$this->admin_log_add('', '更新配置成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新配置成功!', 1);
    				}else{
    					$this->ajax_check('更新配置失败!');
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
    	$info = $this->field('id,name,pid')->where($where)->order('sort asc')->select();
    	return $info;
    }

    // 删除
    public function deleteOne() {
        $ids    = trim(I('get.id'), ',');
        
        if ($ids == '') {
            $this->ajax_check('请选择要操作的数据!');
        }
        
        /* 当前分类下是否有子分类 */
        $cat_count  = $this->where(array('pid'=>$ids))->count();
        
        /* 如果不存在下级子分类和数据，则删除之 */
        if ($cat_count == 0) {
            $map = array('id' => array('IN', $ids) );
            if (false !== $this->where($map)->delete()) {
                $this->admin_log_add('', '删除配置成功,ID:'.$ids, 2);
                $this->ajax_check('操作配置成功!', 1);
            } else {
                $this->ajax_check('操作配置失败!');
            }
        } else {
            $this->ajax_check('不是末级分类或者此分类下还存在有数据,您不能删除!');
        }
        
    }

    //获取站点设置 
    public function getSetting(){
        $where['group'] = array('neq',0);
        $where['is_show'] = 1;
        $list = $this->where($where)->order('sort asc')->select();
        foreach ($list as $key => $value) {
            if($_list[$value['group']] == $value['group']){
                $_list[$value['group']][] = $value;
            }else{
                $_list[$value['group']][] = $value;
            }
        }
        ksort($_list);
         // dumps($_list);
        return $_list;
    }

    //更新站点设置内容
    public function updateSetting(){
        $data = I('request.');
        if($data){
            foreach ($data as $key => $value) {
                $where['name'] = $key;
                $field['value'] = $value;
                $res = $this->where($where)->setField($field);
            }
            $cache = D('Cache')->configCache();
            $this->ajax_check('保存成功',1);
        }
    }

    //获取后台站点信息
    public function getConfig(){
        $where = array();
        $order = 'sort asc';
        $list = $this->where($where)->order($order)->select();
        foreach ($list as $key => $value) {
            $_list[$value['name']] = $value;
        }
        return $_list;
    }

}