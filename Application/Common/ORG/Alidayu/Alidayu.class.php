<?php 
namespace Alidayu;

use Think\Exception;

class Alidayu {

    /**
     * API请求地址
     * @var string
     */
    protected $api_uri = 'http://gw.api.taobao.com/router/rest';

    /**
     * 沙箱请求地址
     * @var string
     */
    protected $api_sandbox_uri = 'http://gw.api.tbsandbox.com/router/rest'; 

    /**
     * 应用
     * @var string
     */
    protected $app;

    /**
     * 签名规则
     * @var string
     */
    protected $sign_method = 'md5';

    /**
     * 响应格式。可选值：xml，json。
     * @var string
     */
    protected $format = 'json';

	public $return_url = '';

    /**
     * 初始化
     * @param array $config 阿里大于配置类
     */
    public function __construct($app)
    {
        $this->app = $app;

        // 判断配置
        if (empty($this->app['app_key']) || empty($this->app['app_secret'])) {
            throw new Exception("阿里大于配置信息：app_key或app_secret错误");
        }
    }

    /**
     * 请求API
     * @param  string   $method   接口名称
     * @param  callable $callable 执行函数
     * @return [type]             [description]
     */
    public function request($method, callable $callable)
    {
        // A. 校验
        if (empty($method) || !$classname = $this->getMethodClassName($method)) {
            throw new Exception("method错误");
        }
        
        // B. 获取路径
        $classNameSpace = __NAMESPACE__ . '\\Requests\\' . $classname;
        // dumps($classNameSpace);
        // if (!class_exists($classNameSpace)) 
        //     throw new Exception("method不存在");

        // C. 创建对象
        $request = new $classNameSpace;

        // D. 执行匿名函数
        if (is_callable($callable)) {
            call_user_func($callable, $request);
        }

        return call_user_func_array(array($this, 'execute'), array($request));
    }
    
    /**
     * 发起请求数据
     * @param  $request 请求类
     * @return false|object
     */
    public function execute($request)
    {
        $method        = $request->getApiMethodName();
        $publicParams  = $this->getPublicParams();
        $serviceParams = $request->getApiParas();
        $serviceParams = array_filter($serviceParams);

        $params = array_merge(
            $publicParams,
            array(
                'method' => $method
            ),
            $serviceParams
        );

        // 签名
        $params['sign'] = $this->generateSign($params);

        // 请求数据
        $resp = $this->curl(
            $this->app['sandbox'] ? $this->api_sandbox_uri : $this->api_uri,
            $params
        );

        // 解析返回
        return $this->parseRep($resp);
    }

    /**
     * 设置签名方式
     * @param string $value 签名方式，支持md5, hmac
     */
    public function setSignMethod($value = 'md5')
    {
        $this->sign_method = $value;
        return $this;
    }

    /**
     * 设置回传格式
     * @param string $value 响应格式，支持json/xml
     */
    public function setFormat($value = 'json')
    {
        $this->format = $value;
        return $this;
    }

    /**
     * 解析返回数据
     * @return array|false
     */
    protected function parseRep($response)
    {
        if ($this->format == 'json') {
            $resp = json_decode($response);

            if (false !== $resp) {
                $resp = current($resp);
            }
        }
        elseif ($this->format == 'xml') {
            $resp = @simplexml_load_string($response);
        }
        else {
            throw new Exception("format错误...");
        }

        return $resp;
    }

    /**
     * 返回公共参数
     * @return array 
     */
    protected function getPublicParams()
    {
        return array(
            'app_key'     => $this->app['app_key'],
            'timestamp'   => date('Y-m-d H:i:s'),
            'format'      => $this->format,
            'v'           => '2.0',
            'sign_method' => $this->sign_method
        );
    }

    /**
     * 按Md5方式生成签名
     */
    protected function generateSign($params)
	{
		ksort($params);

        $arr = array();
		foreach ($params as $k => $v) {
            $arr[] = $k . $v;
		}

        $app_secret = $this->app['app_secret'];
        if ($this->sign_method == 'md5') {
            return strtoupper(
                md5($app_secret . implode('', $arr) . $app_secret)
            );
        } 
        elseif ($this->sign_method == 'hmac') {
            return strtoupper(
                hash_hmac('md5', implode('', $arr), $app_secret)
            );
        }
	}

    /**
     * 通过接口名称获取对应的类名称
     * @param  string $method 接口名称
     * @return string         
     */
    protected static function getMethodClassName($method)
    {
        $methods = explode('.', $method);
        
        if (!is_array($methods))
            return false;

        $tmp = array();

        foreach ($methods as $value) {
            $tmp[] = ucwords($value);
        }

        $className = implode('', $tmp);

        return $className;
    }

    /**
     * curl请求
     * @param  string $url        string
     * @param  array|null $postFields 请求参数
     * @return [type]             [description]
     */
    protected function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "top-sdk-php");
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (is_array($postFields) && 0 < count($postFields)) {
            $postBodyString = "";
            foreach ($postFields as $k => $v) {
                if (!is_string($v))
					continue;
                
                $postBodyString .= "$k=" . urlencode($v) . "&"; 
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString, 0, -1));
        }

        $this->return_url = $url . '?' . rtrim($postBodyString, '&');
        $reponse = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch), 0);
        } 
        else {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode) {
                throw new Exception($reponse, $httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }

}















