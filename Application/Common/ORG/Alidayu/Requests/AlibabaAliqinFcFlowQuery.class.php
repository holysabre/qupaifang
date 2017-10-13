<?php
namespace Alidayu\Requests;

/**
 * 阿里大于 - 流量直充查询
 *
 */
class AlibabaAliqinFcFlowQuery extends Request
{
    // 接口名称
    protected $method = 'alibaba.aliqin.fc.flow.query';

    // 初始化
    public function __construct()
    {
        $this->apiParas = array(
            'out_id' => '', // 必须 唯一流水号
        );
    }

    // 唯一流水号
    public function setOutId($value)
    {
        $this->apiParas["out_id"] = $value;
        return $this;
    }
    
}
