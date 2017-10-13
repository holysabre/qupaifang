<?php
namespace Admin\Model;
use Think\Model;
class WechatModel extends BaseModel {

    public $custom_model;
    public function __construct() {
        parent::__construct();
        $this->custom_model = M('wechat_custom');
    }

    //公众号设置 获取
    public function configInfo($id){
        $info = M('config')->find($id);
        $info = unserialize($info['value']);
        return $info;
    }

    //公众号设置 编辑
    public function configEdit($id){
        $request = I('request.');
        unset($request['m']);
        $data = array();
        $data['value'] = serialize($request);
        $data['time'] = time();
        $res = M('config')->where("id = 10")->save($data);
        if($res){
            $this->admin_log_add('', '更新公众号设置成功,ID:'.$id.', 标题:'.$data['name'], 2);
            $this->ajax_check('更新公众号设置成功!', 1);
        }else{
            $this->ajax_check('更新公众号设置失败!');
        }
    }

    //关注自动回复
    public function follow(){
        $request = I('request.');
        unset($request['m']);
        $data = array();
        $data['value'] = serialize($request);
        $data['time'] = time();
        $res = M('config')->where("id = 11")->save($data);
        if($res){
            $this->admin_log_add('', '更新关注自动回复设置成功,ID:'.$id.', 标题:'.$data['name'], 2);
            $this->ajax_check('更新关注自动回复设置成功!', 1);
        }else{
            $this->ajax_check('更新关注自动回复设置失败!');
        }
    }

    //自定义文本回复 列表
    public function customList($type = 'text'){
        $pagenum = 10;
        $where = array();
        $where['type'] = $type;
        $count = $this->custom_model->where($where)->count();
        $Page  = new \Think\Page($count, $pagenum, I('request.'));
        $Page->setConfig('header', '<span class="info">共 %TOTAL_ROW% 条记录 每 %LISTROWS% 条/页</span>');
        $array = $this->custom_model->where($where)->order('sort asc,id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        foreach ($array as $key => $value) {
            if(!empty($value['mult_ids'])){
                $ids = explode(',', $value['mult_ids']);
                foreach ($ids as $k => $v) {
                    $one = $this->customInfo($v);
                    $array[$key]['title_arr'][$v] = $one['title'];
                }
            }
        }
        //echo $this->getLastSql();
        $data = array();
        $data = I('request.');
        $data['list'] = $array;
        $data['page'] = $Page->show();
        $data['count'] = $count;
        return $data;
    }

    //自定义文本回复编辑
    public function customEdit($id){
    	if(IS_POST){
    		$data = $this->custom_model->create();
            $data['mult_ids'] = $data['mult_ids']?implode(',', $data['mult_ids']):'';
            $data['intro'] = $data['intro']?$data['introduction']:get_content_sub($data['content'], 45);
            // dumps($data);exit;
    		if($data){
    			if($id == 0){
                    $data['ctime'] = time();
    				$add = $this->custom_model->add($data);
	    			if($add){
	    				$this->ajax_check('添加成功!', 1);
	    			}else{
	    				$this->ajax_check('添加失败!');
	    			}
    			}else{
                    $data['etime'] = time();
    				if($this->custom_model->save($data)){
                        $this->ajax_check('更新成功!', 1);
    				}else{
    					$this->ajax_check('更新失败!');
    				}
    			}
    		}else{
    			$this->ajax_check($this->getDbError());
    		}
    	}
    }

    // 自定义回复查询单条
    public function customInfo($id){
    	$info = $this->custom_model->find($id);
        if(!empty($info['mult_ids'])){
            $ids = explode(',', $info['mult_ids']);
            foreach ($ids as $key => $value) {
                $one = $this->customInfo($value['id']);
                $info['mult_list'][] = $one;
            }
        }
        return $info;
    }

    // 自定义回复删除
    public function deleteCustom() {
        $ids    = trim(I('get.id'), ',');
        
        if ($ids == '') {
            $this->ajax_check('请选择要操作的数据!');
        }
        
        $map = array('id' => array('IN', $ids) );
        if (false !== $this->custom_model->where($map)->delete()) {
            //微信操作日志
            $this->ajax_check('操作菜单成功!', 1);
        } else {
            $this->ajax_check('操作菜单失败!');
        }
        
    }

    //日志列表
    public function log(){
        $log_model = M('wechat_log');
        $pagenum = 10;
        $where = array();
        $count = $log_model->where($where)->count();
        $Page  = new \Think\Page($count, $pagenum, I('request.'));
        $Page->setConfig('header', '<span class="info">共 %TOTAL_ROW% 条记录 每 %LISTROWS% 条/页</span>');
        $array = $log_model->where($where)->order('cTime desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        //echo $this->getLastSql();
        $data = array();
        $data = I('request.');
        $data['list'] = $array;
        $data['page'] = $Page->show();
        $data['count'] = $count;
        return $data;
    }

    //日志详情
    public function logDetail($id){
        $info = M('wechat_log')->find($id);
        $info['data'] = unserialize($info['data']);
        $info['data_post'] = $info['data_post'];
        return $info;
    }

}