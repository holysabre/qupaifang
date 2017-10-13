<?php
namespace Alidayu\Requests;

/**
 * 阿里大于 - 文本转语音通知
 *
 */
class AlibabaAliqinFcTtsNumSinglecall extends Request
{
    // 接口名称
    protected $method = 'alibaba.aliqin.fc.tts.num.singlecall';

    // 初始化
    public function __construct()
    {
        $this->apiParas = array(
            'called_num'        => '', // 必须 被叫号码，支持国内手机号与固话号码,格式如下057188773344,13911112222,4001112222,95500
            'called_show_num'   => '', // 必须 被叫号显，传入的显示号码必须是阿里大鱼“管理中心-号码管理”中申请或购买的号码
            'extend'            => '', // 可选 公共回传参数，在“消息返回”中会透传回该参数；举例：用户可以传入自己下级的会员ID，在消息返回时，该会员ID会包含在内，用户可以根据该会员ID识别是哪位会员使用了你的应用
            'tts_code'          => '', // 可选 TTS模板ID，传入的模板必须是在阿里大鱼“管理中心-语音TTS模板管理”中的可用模板
            'tts_param'         => '', // 可选 文本转语音（TTS）模板变量，传参规则{"key"："value"}，key的名字须和TTS模板中的变量名一致，多个变量之间以逗号隔开，示例：{"name":"xiaoming","code":"1234"}
        );
    }

    // 设置被叫号码
    public function setCalledNum($value)
    {
        $this->apiParas["called_num"] = $value;
        return $this;
    }

    // 设置被叫号显
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

    // 设置TTS模板ID
    public function setTtsCode($value)
    {
        $this->apiParas["tts_code"] = $value;
        return $this;
    }

    // 设置内容模板参数
    public function setTtsParam($value)
    {
        if (is_array($value)) {
            $value = $this->jsonStr($value);
        }
        
        $this->apiParas["tts_param"] = $value;
        return $this;
    }


    

}
