<?php
namespace Home\Model;
use Think\Model;
class PaymentModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //支付保证金
    public function postBond(){
    	$member = $this->member;
    	if(!$member){
    		$this->ajax_check('登录失效，请重新登录');
    	}
    	$m_id = $member['id'];
    	$s_id = I('request.s_id');
    	$pay_password = I('request.pay_password');
    	if(!$pay_password){
    		$this->ajax_check('请输入正确的支付密码');
    	}
        $info = D('Subject')->getSingleInfo($s_id);
        //判断是属于竞拍还是一口价
    	if($info['sale_type'] == 1){
            $bond = $info['bond'];
        }elseif($info['sale_type'] == 2){
            //重新计算保证金(页面传递的值可能存在篡改)
            $bond = M('Subject')->field('id,bond')->find($s_id);
            $bond = $bond['bond'];
        }
    	//查询账户
    	$account = $this->getBalance($m_id);
    	if($account['balance'] < $bond){
    		$this->ajax_check('您的账户余额不足，请充值后重试');
    	}
    	//余额支付
    	//查询账户的支付密码
    	$member_pay_password = M('member')->field('pay_password')->find($m_id);
    	$member_pay_password = $member_pay_password['pay_password'];
    	if(!$member_pay_password){
    		$this->ajax_check('您当前未设置支付密码，请先设置后重试');
    	}
    	if(md5($pay_password) != $member_pay_password){
    		$this->ajax_check('请输入正确的支付密码!');
    	}
        $m = M('member_account');
        //开启事务
        $m->startTrans();
    	$frozen_dec = $m->where('id='.$account['id'])->setDec('balance',$bond);
        //冻结保证金
        $frozen_inc = $m->where('id='.$account['id'])->setInc('frozen',$bond);
        if($frozen_dec && $frozen_inc){
            $m->commit();
            //生成记录表 写入账户日志
            $log1 = array(
                'account_id' => $account['id'],
                'action'     => '余额支付',
                'data'       => '-'.$bond,
                'state'      => '支付成功',
                'remark'     => '',
                'time'       => time(),
                'type'       => 3
            );
            $log_result1 = account_log($log1);
            //生成记录表 写入账户日志
            $log2 = array(
                'account_id' => $account['id'],
                'action'     => '保证金冻结',
                'data'       => '+'.$bond,
                'state'      => '支付成功',
                'remark'     => '',
                'time'       => time(),
                'type'       => 4
            );
            $log_result2 = account_log($log2);
            //记录报名状态
            $data = array(
                'm_id' => $m_id,
                's_id' => $s_id,
                'bond' => $bond,
                'time' => time()
            );
            $bond_result = M('bond')->add($data);
            //返回操作结果
            //判断是属于竞拍还是一口价
            if($info['sale_type'] == 1){
                //一口价出价成功之后 后续操作
                //记录到竞拍记录表
                $data = array(
                    's_id' => $s_id,
                    'm_id' => $m_id,
                    'bid_no' => $member['bid_no'],
                    'price' => $info['start_price'],
                    'status' => 1,
                    'time' => time()
                );
                $result = M('subject_bid')->add($data);
                $res = M('Subject')->where('id='.$s_id)->setField('status',3);
                $this->ajax_check('出价成功',1,U('Member/deal'));
            }elseif($info['sale_type'] == 2){
                $this->ajax_check('报名成功',1);
            }
        }else{
            $m->rollback();
        }
    }

    //标的成交
    public function deal($info,$buy_info){
        $bond = $info['bond'];
        $buy_account = $this->getBalance($buy_info['m_id']);
        $sell_account = $this->getBalance($info['m_id']);
        $m = M('member_account');
        $m->startTrans();//事务开启
        //买家扣除保证金
        $frozen_dec = $m->where('id='.$buy_account['id'])->setDec('frozen',$bond);
        //卖家增加冻结金额
        $frozen_inc = $m->where('id='.$sell_account['id'])->setInc('frozen',$bond);
        //出局买家退还解冻保证金
        $return_bond = true;
        $where = array();
        $where['s_id'] = $info['id'];
        $where['m_id'] = array('neq',$buy_info['id']);
        $list = M('bond')->where($where)->select();
        foreach ($list as $key => $value) {
            $account = $this->getBalance($value['m_id']);
            $result = $m->where('id='.$account['id'])->setDec('frozen',$value['bond']);
            if(!$result){
                $return_bond = false;
            }
        }
        if($frozen_dec && $frozen_inc && $return_bond){
            $m->commit();//事务通过 提交
            //生成记录表 写入账户日志
            $log1 = array(
                'account_id' => $buy_account['id'],
                'action'     => '保证金扣除',
                'data'       => '-'.$bond,
                'state'      => '支付成功',
                'remark'     => '',
                'time'       => time(),
                'type'       => 4
            );
            $log_result1 = account_log($log1);
            //生成记录表 写入账户日志
            $log2 = array(
                'account_id' => $sell_account['id'],
                'action'     => '定金转入',
                'data'       => '+'.$bond,
                'state'      => '支付成功',
                'remark'     => '',
                'time'       => time(),
                'type'       => 4
            );
            $log_result2 = account_log($log2);
        }else{
            $m->rollback();//事务未通过 回滚
        }
        
    }

    //查询账户
    public function getBalance($m_id){
    	$account = M('member_account')->where('m_id='.$m_id)->find();
    	return $account;
    }

    
}