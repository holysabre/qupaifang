<?php
namespace Home\Controller;
use Think\Controller;
class ContractController extends BaseController {

	public function __construct() {
        parent::__construct();
    }

    //竞价/一口价方式出售确认书
    public function bid_contract(){
        if(IS_POST){
            $res = D('Subject')->confirmContract();
        }else{
            $info = D('Subject')->getInfo();
            $this->assign('info',$info);
            $this->assign('action',I('request.action'));
            $this->display();
        }
    }

}
