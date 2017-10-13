<?php
namespace Alidayu\Requests;

/**
 * 阿里大于 - 短信发送记录查询
 *
 */
class AlibabaAliqinFcSmsNumQuery extends Request
{
    // 接口名称
    protected $method = 'alibaba.aliqin.fc.sms.num.query';

    // 初始化
    public function __construct()
    {
        $this->apiParas = array(
            'biz_id'        => '',  // 可选 短信发送流水
            'current_page'  => '1', // 必须 分页参数,页码
            'page_size'     => '10', // 必须 分页参数，每页数量。最大值50
            'query_date'    => date('Ymd'), // 必须 短信发送日期，支持近30天记录查询，格式yyyyMMdd
            'rec_num'       => '', // 必须 短信接收号码
        );
    }

    // 设置短信发送流水
    public function setBizId($value)
    {
        $this->apiParas["biz_id"] = $value;
        return $this;
    }

    // 设置分页参数,页码
    public function setCurrentPage($value)
    {
        $this->apiParas["current_page"] = $value;
        return $this;
    }

    // 设置分页参数，每页数量。
    public function setPageSize($value)
    {
        $this->apiParas["page_size"] = $value;
        return $this;
    }

    // 设置短信发送日期
    public function setQueryDate($value)
    {
        $this->apiParas["query_date"] = $value;
        return $this;
    }

    // 设置短信接收号码
    public function setRecNum($value)
    {
        $this->apiParas["rec_num"] = $value;
        return $this;
    }

}
