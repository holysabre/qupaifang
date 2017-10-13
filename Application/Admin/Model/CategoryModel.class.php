<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function index($type){
        $where['type'] = $type;
    	$data = $this->where($where)->order('sort asc')->select();
    	return $data;
    }

    public function edit($id){
    	if(IS_POST){
    		$data = $this->create();
    		if($data){
    			$data['time'] = time();
                //父级不允许为自身 或 子集
                if($id){
                    if($data['pid'] == $id){
                        $this->ajax_check('父级不允许为自身!');
                    }elseif(in_array($data['pid'], tree_child($this->index(),$id))){
                        $this->ajax_check('父级不允许为子集!');
                    }
                }
                // 伪静态名
                if ($data['html'] == '') {
                    $data['html'] = yd_pinyin($data['title']);
                } else {
                    !empty($data['html']) && $data['html'] = str_lower($data['html']);
                }
    			if($id == 0){
    				$add = $this->add($data);
	    			if($add){
                        //更新分类缓存
                        $cache = D('Cache')->categoryCache();
	    				$this->admin_log_add('', '添加分类成功,ID:'.$add.', 标题:'.$data['name'], 2);
                        D('cache')->cache('category');
	    				$this->ajax_check('添加分类成功!', 1);
	    			}else{
	    				$this->ajax_check('添加分类失败!');
	    			}
    			}else{
    				if($this->save($data)){
                        //更新分类缓存
                        $cache = D('Cache')->categoryCache();
    					$this->admin_log_add('', '更新分类成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        D('cache')->cache('category');
                        $this->ajax_check('更新分类成功!', 1);
    				}else{
    					$this->ajax_check('更新分类失败!');
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

    public function findAll($type){
    	$where = array();
        $where['type'] = $type;
    	$info = $this->field('id,title,pid')->where($where)->order('sort asc')->select();
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

}