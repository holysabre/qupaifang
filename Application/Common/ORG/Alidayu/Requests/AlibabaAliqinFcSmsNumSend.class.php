<?php
namespace Alidayu\Requests;

/**
 * 阿里大于 - 短信发送
 *
 */
class AlibabaAliqinFcSmsNumSend extends Request
{
    // 接口名称
    protected $method = 'alibaba.aliqin.fc.sms.num.send';

    // 初始化
    public function __construct()
    {
        $this->apiParas = array(
            'extend'             => '', // 可选 公共回传参数，在“消息返回”中会透传回该参数；
            'sms_type'           => 'normal', // 必须 短信类型，传入值请填写normal
            'sms_free_sign_name' => '', // 必须 短信签名，传入的短信签名必须是在阿里大于“管理中心-短信签名管理”中的可用签名
            'sms_param'          => '', // 可选 短信模板变量，传参规则{"key":"value"}，key的名字须和申请模板中的变量名一致，多个变量之间以逗号隔开
            'rec_num'            => '', // 必须 短信接收号码。支持单个或多个，传入号码为11位手机号码，不能加0或+86。传入多个号码，以英文逗号分隔，一次调用最多传入200个号码
            'sms_template_code'  => ''  // 必须 短信模板ID，传入的模板必须是在阿里大于“管理中心-短信模板管理”中的可用模板
        );
    }

    // 设置公共回传参数
    public function setExtend($value)
    {
        $this->apiParas["extend"] = $value;
        return $this;
    }

    // 设置短信类型，传入值请填写normal
    public function setSmsType($value = 'normal')
    {
        $this->apiParas["sms_type"] = $value;
        return $this;
    }

    // 设置短信签名
    public function setSmsFreeSignName($value)
    {
        $this->apiParas["sms_free_sign_name"] = $value;
        return $this;
    }

    // 设置短信内容模板参数
    public function setSmsParam($value)
    {
        if (is_array($value)) {
            $value = $this->jsonStr($value);
        }

        $this->apiParas["sms_param"] = $value;
        return $this;
    }

    // 设置短信接受的手机号
    public function setRecNum($value)
    {
        if (is_array($value))
        $value = implode(',', $value);

        $this->apiParas["rec_num"] = $value;
        return $this;
    }

    // 设置短信模板ID
    public function setSmsTemplateCode($value)
    {
        $this->apiParas["sms_template_code"] = $value;
        return $this;
    }

}
