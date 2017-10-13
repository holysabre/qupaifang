<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $admin = $this->admin;
        $where = array();
        if($admin['is_system'] != 1){
            $where['a.id'] = array('neq',1); 
        }
    	$data = $this->where($where)->select();
        $data = M()->field('a.*,r.name as role_name')->table('p_admin as a')->join('p_admin_role as r on a.role_id = r.id')->where($where)->select();
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
    				$add = $this->add($data);
	    			if($add){
	    				$this->admin_log_add('', '添加管理员成功,ID:'.$add.', 标题:'.$data['name'], 2);
	    				$this->ajax_check('添加管理员成功!', 1);
	    			}else{
	    				$this->ajax_check('添加管理员失败!');
	    			}
    			}else{
    				if($this->save($data)){
    					$this->admin_log_add('', '更新管理员成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新管理员成功!', 1);
    				}else{
    					$this->ajax_check('更新管理员失败!');
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

    //处理登录
    public function login() {
        if (IS_POST) {
            $username = I('post.username');
            $password = I('post.password');
            $yzcode   = I('post.yzcode');
            if (empty($username)) {
                $this->ajax_check('用户名不能为空!');
            }            
            if (empty($password)) {
                $this->ajax_check('密码不能为空!');
            }
            if (empty($yzcode)) {
                $this->ajax_check('请输入验证码!');
            }
            $Verify = new \Think\Verify();
            $code   = $Verify->check($yzcode,'v_1');
            if($code !== true) {
                $this->ajax_check('验证码错误!');
            }
            $where = array('username'=>$username, 'password'=>md5($password));
            $info  = $this->field(true)->where($where)->find();
            if ($info) {
                if ($info['is_enable'] == 0) {
                    $this->admin_log_add($info['username'], '管理员登录失败,已被禁用');
                    $this->ajax_check('账户已被禁用!');
                }
                $session = array();
                $session['adminid']     = $info['id'];
                $session['username']   = $info['username'];
                $session['adminroleid'] = $info['role_id'];
                $session['is_system']    = $info['is_system'];
                $session['logintime']   = time();
                session(ADMINPANGE, $session);
                $data = array();
                $data['logincount'] = $info['logincount']+1;
                $data['lasttime']   = $info['logintime'];
                $data['lastip']     = $info['ip'];
                $data['logintime']  = time();
                $data['lastip']         = get_client_ip();
                $result = $this->where( array('id'=>$info['id']) )->save($data);
                if($result) {
                    $this->admin_log_add($username, '管理员登录成功');
                    $this->ajax_check('登录成功!', 1);
                }
            }
            $this->admin_log_add($username, '管理员登录失败,用户名或密码错误');
            $this->ajax_check('用户名或密码错误!');
        }
    }

}