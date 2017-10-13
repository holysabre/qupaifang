<?php
namespace Alidayu\Requests;

/**
 * 阿里大于 - 语音通知
 *
 */
class AlibabaAliqinFcVoiceNumSinglecall extends Request
{
    // 接口名称
    protected $method = 'alibaba.aliqin.fc.voice.num.singlecall';

    // 初始化
    public function __construct()
    {
        $this->apiParas = array(
            'called_num'        => '', // 必须 被叫号码
            'called_show_num'   => '', // 必须 被叫号码侧的号码显示
            'extend'            => '', // 可选 公共回传参数
            'voice_code'        => '', // 必须 语音文件ID
        );
    }

    // 设置被叫号码
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

    // 设置公共回传参数
    public function setExtend($value)
    {
        $this->apiParas["extend"] = $value;
        return $this;
    }

    // 设置语音文件ID
    public function setVoiceCode($value)
    {
        $this->apiParas["voice_code"] = $value;
        return $this;
    }

}
