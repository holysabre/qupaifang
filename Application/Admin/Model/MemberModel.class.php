<?php
namespace Admin\Model;
use Think\Model;
class MemberModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	$data = $this->order('time desc')->select();
    	return $data;
    }

    public function edit($id){
    	if(IS_POST){
    		$data = $this->create();
    		if($data){
                //重置新密码
                $repwd = I('request.repassword');
                if($data['password'] != '' && $repwd){
                    if($data['password'] != $repwd){
                        $this->ajax_check('两次输入的密码不一样!');
                    }else{
                        $data['password'] = md5($data['password']);
                    }
                }
    			$data['time'] = time();
    			if($id == 0){
                    $data['add_time'] = time();
    				$add = $this->add($data);
	    			if($add){
	    				$this->admin_log_add('', '添加会员成功,ID:'.$add.', 标题:'.$data['name'], 2);
	    				$this->ajax_check('添加会员成功!', 1);
	    			}else{
	    				$this->ajax_check('添加会员失败!');
	    			}
    			}else{
    				if($this->save($data)){
    					$this->admin_log_add('', '更新会员成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新会员成功!', 1);
    				}else{
    					$this->ajax_check('更新会员失败!');
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
    	$info = $this->where($where)->order('sort asc')->select();
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
                $this->admin_log_add('', '删除会员成功,ID:'.$ids, 2);
                $this->ajax_check('操作会员成功!', 1);
            } else {
                $this->ajax_check('操作会员失败!');
            }
        } else {
            $this->ajax_check('不是末级分类或者此分类下还存在有数据,您不能删除!');
        }
        
    }

    public function group(){
        $data = M('member_group')->order('time desc')->select();
        return $data;
    }

    public function findGroupOne($id){
        if($id){
            $info = M('member_group')->find($id);
            return $info;
        }
    }

    public function groupEdit($id){
        $table = M('member_group');
        if(IS_POST){
            $data = $table->create();
            if($data){
                $data['time'] = time();
                if($id == 0){
                    $add = $table->add($data);
                    if($add){
                        $this->admin_log_add('', '添加会员组成功,ID:'.$add.', 标题:'.$data['name'], 2);
                        $this->ajax_check('添加会员组成功!', 1);
                    }else{
                        $this->ajax_check('添加会员组失败!');
                    }
                }else{
                    if($table->save($data)){
                        $this->admin_log_add('', '更新会员组成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新会员组成功!', 1);
                    }else{
                        $this->ajax_check('更新会员组失败!');
                    }
                }
            }else{
                $this->ajax_check($this->getDbError());
            }
        }
    }

    //个人账户
    public function wallet($id){
        $info = M('member_wallet')->find();
        return $info;
    }

    //个人账户修改
    public function walletEdit($id){
        $table = M('member_wallet');
        $m_id = I('request.m_id');
        if(IS_POST){
            $data = $table->create();
            if($data){
                $data['m_id'] = $m_id;
                $data['time'] = time();
                if($id == 0){
                    $add = $table->add($data);
                    if($add){
                        $this->write_wallet_log('', '添加会员个人账户信息成功,ID:'.$add.', 标题:'.$data['name'], 2);
                        //记录个人账户日志
                        write_wallet_log($id,$m_id,'充值记录',1,'系统操作',$data['balance'],'重置成功');
                        $this->ajax_check('添加会员个人账户信息成功!', 1);
                    }else{
                        $this->ajax_check('添加会员个人账户信息失败!');
                    }
                }else{
                    if($table->save($data)){
                        $this->write_wallet_log('', '更新会员个人账户信息成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        //记录个人账户日志
                        write_wallet_log($id,$m_id,'充值记录',1,'系统操作',$data['balance'],'重置成功');
                        $this->ajax_check('更新会员个人账户信息成功!', 1);
                    }else{
                        $this->ajax_check('更新会员个人账户信息失败!');
                    }
                }
            }else{
                $this->ajax_check($this->getDbError());
            }
        }
    }




}