<?php
namespace Admin\Model;
use Think\Model;
class SubjectModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $pagenum = I('request.pagenum', 10);
        $catid   = I('request.catid');
        $is_show  = I('request.is_show');
        $keywords= I('request.keywords');

        $where = array();

        if ($catid != '' || $catid != 0) $where['catid'] = $catid;
        if ($is_show != '') $where['is_show'] = $is_show;
        if ($keywords != '') $where['title'] = array('like', "%{$keywords}%");

        $count = $this->where($where)->count();
        $Page  = new \Think\Page($count, $pagenum, I('request.'));
        $Page->setConfig('header', '<span class="info">共 %TOTAL_ROW% 条记录 每 %LISTROWS% 条/页</span>');
        $array = $this->where($where)->order('time desc,id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
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
                    $data['image'] = empty($data['image'])?reset($album):$data['image'];//主图
                    $data['album'] = serialize($album);//相册
                }
                if(!empty($data['certificate_album'])){
                    $data['certificate_album'] = serialize($data['certificate_album']);
                }
                //生成二维码
                if(empty($data['qrcode']) && $id != 0){
                    $text = U('Home/Subject/detail',array('id'=>$id));
                    $data['qrcode'] = create_qrcode($text);
                }
                //综合评级
                $data['rate'] = $data['rate'] > 5 ? 5 : $data['rate'];

    			if($id == 0){
                    $data['add_time'] = time();
    				$add = $this->add($data);
	    			if($add){
	    				$this->admin_log_add('', '添加标的成功,ID:'.$add.', 标题:'.$data['name'], 2);
	    				$this->ajax_check('添加标的成功!', 1,'',U('index'));
	    			}else{
	    				$this->ajax_check('添加标的失败!');
	    			}
    			}else{
    				if($this->save($data)){
                        if($data['examine'] == 1){
                            //如果通过审核 给客户发送短信
                            // import('Common/ORG/Sms');
                            // $sms = new \Sms();
                            // $msg = '您提交的标的已经通过审核';
                            // $member_info = D('Member')->find($id);
                            // $mobile = $member_info['mobile'];
                            // $status = $sms->send_verify($mobile, $msg);
                            // if (!$status) {
                            //     $this->ajax_check('短信发送失败',0,$sms->error);
                            // }
                        }
    					$this->admin_log_add('', '更新标的成功,ID:'.$id.', 标题:'.$data['name'], 2);
                        $this->ajax_check('更新标的成功!', 1,'',U('index'));
    				}else{
    					$this->ajax_check('更新标的失败!');
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
            $where = array();
            $where['s_id'] = $id;
            $building = M('subject_building')->where($where)->select();
            $info['building'] = $building;
            $info['content'] = htmlspecialchars_decode($info['content']);
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

}