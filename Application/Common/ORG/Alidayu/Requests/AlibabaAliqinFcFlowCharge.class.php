<?php
namespace Alidayu\Requests;

/**
 * 阿里大于 - 流量直充
 *
 */
class AlibabaAliqinFcFlowCharge extends Request
{
    // 接口名称
    protected $method = 'alibaba.aliqin.fc.flow.charge';

    // 初始化
    public function __construct()
    {
        $this->apiParas = array(
            'grade'           => '', // 必须 需要充值的流量
            'out_recharge_id' => '', // 必须 唯一流水号
            'phone_num'       => '', // 必须 手机号
            'reason'          => '', // 可选 充值原因
        );
    }

    // 需要充值的流量
    public function setGrade($value)
    {
        $this->apiParas["grade"] = $value;
        return $this;
    }

    // 唯一流水号
    public function setOutRechargeId($value)
    {
        $this->apiParas["out_recharge_id"] = $value;
        return $this;
    }

    // 手机号
    public function setPhoneNum($value)
    {
        $this->apiParas["phone_num"] = $value;
        return $this;
    }

    // 充值原因
    public function setReason($value)
    {
        $this->apiParas["reason"] = $value;
        return $this;
    }

}
