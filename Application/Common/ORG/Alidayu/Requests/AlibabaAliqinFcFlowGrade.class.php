<?php
namespace Alidayu\Requests;

/**
 * 阿里大于 - 流量直充档位表
 *
 */
class AlibabaAliqinFcFlowGrade extends Request
{
    // 接口名称
    protected $method = 'alibaba.aliqin.fc.flow.grade';

    // 初始化
    public function __construct()
    {
        $this->apiParas = array();
    }

}
