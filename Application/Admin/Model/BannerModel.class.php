<?php
namespace Admin\Model;
use Think\Model;
class BannerModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $pagenum = 10;
        $where = array();
        $count = $this->where($where)->count();
        $Page  = new \Think\Page($count, $pagenum, I('request.'));
        $Page->setConfig('header', '<span class="info">共 %TOTAL_ROW% 条记录 每 %LISTROWS% 条/页</span>');
        $array = $this->where($where)->order('sort asc,id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        //echo $this->getLastSql();
        $data = array();
        $data = I('request.');
        $data['list'] = $array;
        $data['page'] = $Page->show();
        $data['count'] = $count;
        return $data;
    }

    public function edit($id){
    	if(IS_POST){
    		$data = $this->create();
    		if($data){
    			$data['time'] = time();
                //多图处理
                $album = I('album');
                if(!empty($album)){
                    $data['album'] = serialize($album);
                }
    			if($id == 0){
    				$add = $this->add($data);
	    			if($add){
	    				$this->admin_log_add('', '添加幻灯片成功,ID:'.$add.', 标题:'.$data['name'], 2);
	    				$this->ajax_check('添加幻灯片成功!', 1);
	    			}else{
	    				$this->ajax_check('添加幻灯片失败!');
	    			}
    			}else{
    				if($this->save($data)){
    					$this->admin_log_add('', '更新幻灯片成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新幻灯片成功!', 1);
    				}else{
    					$this->ajax_check('更新幻灯片失败!');
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
    	$info = $this->field('id,title,pid')->where($where)->order('sort asc')->select();
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