<?php
namespace Alidayu\Requests;

use Exception;

/**
 * 阿里大于 - 请求基类
 *
 */
abstract class Request
{
    /**
     * 接口名称
     * @var string
     */
    protected $method;

    /**
     * 接口请求参数
     * @var array
     */
    protected $apiParas = array();

    /**
     * 获取接口名称
     * @return string
     */
    public function getApiMethodName()
    {
        return $this->method;
    }

    /**
     * 获取请求参数
     * @return array
     */
    public function getApiParas()
    {
        return $this->apiParas;
    }

    /**
     * 设置其它文本参数
     * @return array
     */
    public function setTextParam($key, $value) 
    {
        $this->apiParas[$key] = $value;
        return $this;
    }

    /**
     * 格式化数组为json字符串（避免数字等不符合规格）
     * @param  array $params 数组
     * @return string
     */
    public function jsonStr($params = array())
    {
        $arr = array();

        array_walk($params, function($value, $key) use (&$arr) {
            $arr[] = "\"{$key}\":\"{$value}\"";
        });

        if (is_array($arr) || count($arr) > 0) {
            return '{' . implode(',', $arr) . '}';
        }

        return '';
    }

    /**
     * 获取随机位数数字
     * @param  integer $len 长度
     * @return string
     */
    public function randStr($len = 6)
    {
        $chars = str_repeat('0123456789', $len);
        $chars = str_shuffle($chars);
        $str   = substr($chars, 0, $len);
        return $str;
    }

    /**
     * 校验字段 fieldName 的值$value非空
     **/
    public function checkNotNull($value, $fieldName) {
        if ($this->checkEmpty($value)) {
            throw new Exception("客户端检查错误，缺少所需参数：" .$fieldName , 40);
        }
    }

    /**
     * 校验$value是否非空
     * @return bool
     **/
    public function checkEmpty($value) 
    {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (is_array($value) && count($value) == 0)
            return true;
        if (is_string($value) && trim($value) === "")
            return true;

        return false;
    }

}
