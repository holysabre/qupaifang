<?php
namespace Home\Model;
use Think\Model;
class EvaluationModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function message(){
        $mobile = I('request.mobile');
        if($mobile){
            $data = array();
            $data['theme'] = '估价';
            $data['tel'] = $mobile;
            $data['addtime'] = time();
            $request = $this->add($data);
            if($request){
                $this->ajax_check('提交成功，请等待客服联系',1);
            }else{
                $this->ajax_check('提交失败');
            }
        }
    }



}