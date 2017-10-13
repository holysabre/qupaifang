<?php
namespace Alidayu\Requests;

/**
 * 阿里大于 - 多方通话
 *
 */
class AlibabaAliqinFcVoiceNumDoublecall extends Request
{
    // 接口名称
    protected $method = 'alibaba.aliqin.fc.voice.num.doublecall';

    // 初始化
    public function __construct()
    {
        $this->apiParas = array(
            'called_num'        => '', // 必须 被叫号码
            'called_show_num'   => '', // 必须 被叫号码侧的号码显示
            'caller_num'        => '', // 必须 主叫号码
            'caller_show_num'   => '', // 必须 主叫号码侧的号码显示
            'extend'            => '', // 可选 公共回传参数
            'session_time_out'  => '', // 可选 通话超时时长
        );
    }

    // 被叫号码
    public function setCalledNum($value)
    {
        $this->apiParas["called_num"] = $value;
        return $this;
    }

    // 被叫号码侧的号码显示
    public function setCalledShowNum($value)
    {
        $this->apiParas["called_show_num"] = $value;
        return $this;
    }

    // 主叫号码
    public function setCallerNum($value)
    {
        $this->apiParas["caller_num"] = $value;
        return $this;
    }

    // 主叫号码侧的号码显示
    public function setCallerShowNum($value)
    {
        $this->apiParas["caller_show_num"] = $value;
        return $this;
    }

    // 公共回传参数
    public function setExtend($value)
    {
        $this->apiParas["extend"] = $value;
        return $this;
    }

    // 通话超时时长
    public function setSessionTimeOut($value)
    {
        $this->apiParas["session_time_out"] = $value;
        return $this;
    }

}
