<?php
namespace Admin\Model;
use Think\Model;
class AddressModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //获取地址
    public function getList($id){
        $where['member_id'] = $id;
        $data = $this->where($where)->order('time desc')->select();
        return $data;
    }

    // public function index(){
    // 	$data = $this->order('time desc')->select();
    // 	return $data;
    // }

    // public function edit($id){
    // 	if(IS_POST){
    // 		$data = $this->create();
    // 		if($data){
    // 			$data['time'] = time();
    // 			if($id == 0){
    //                 $data['add_time'] = time();
    // 				$add = $this->add($data);
	   //  			if($add){
	   //  				$this->admin_log_add('', '添加会员成功,ID:'.$insert.', 标题:'.$data['name'], 2);
	   //  				$this->ajax_check('添加会员成功!', 1);
	   //  			}else{
	   //  				$this->ajax_check('添加会员失败!');
	   //  			}
    // 			}else{
    // 				if($this->save($data)){
    // 					$this->admin_log_add('', '更新会员成功,ID:'.$id.', 标题:'.$data['name'], 2);
    //                     $this->ajax_check('更新会员成功!', 1);
    // 				}else{
    // 					$this->ajax_check('更新会员失败!');
    // 				}
    // 			}
    // 		}else{
    // 			$this->ajax_check($this->getDbError());
    // 		}
    // 	}
    // }

    // public function findOne($id){
    // 	if($id){
    // 		$info = $this->find($id);
    // 		return $info;
    // 	}
    // }

    // public function findAll(){
    // 	$where = array();
    // 	$info = $this->where($where)->order('sort asc')->select();
    // 	return $info;

    // }

    // // 删除
    // public function deleteOne() {
    //     $ids    = trim(I('get.id'), ',');
        
    //     if ($ids == '') {
    //         $this->ajax_check('请选择要操作的数据!');
    //     }
        
    //     /* 当前分类下是否有子分类 */
    //     $cat_count  = $this->where(array('pid'=>$ids))->count();
        
    //     /* 如果不存在下级子分类和数据，则删除之 */
    //     if ($cat_count == 0) {
    //         $map = array('id' => array('IN', $ids) );
    //         if (false !== $this->where($map)->delete()) {
    //             $this->admin_log_add('', '删除会员成功,ID:'.$ids, 2);
    //             $this->ajax_check('操作会员成功!', 1);
    //         } else {
    //             $this->ajax_check('操作会员失败!');
    //         }
    //     } else {
    //         $this->ajax_check('不是末级分类或者此分类下还存在有数据,您不能删除!');
    //     }
        
    // }

}