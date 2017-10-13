<?php 
use Alidayu\Alidayu;

header('content-type:text/html;charset=utf8;');
include './Alidayu/Alidayu.class.php';

spl_autoload_register(function ($classname) {
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR . 'Alidayu' . DIRECTORY_SEPARATOR;

    if (strpos($classname, "Alidayu\\") === 0) {
        $path = str_replace(
            '\\', 
            DIRECTORY_SEPARATOR, 
            substr($classname, strlen('Alidayu\\'))
        );
        $file = $baseDir . $path . '.php';
        if (is_file($file))
            require_once $file;
    }
});

$app = array(
    'app_key' => '23849007',
    'app_secret' => '933fbcb3eaeb01c4c7fe66999c9a23bf',
    'sandbox' => false, // 是否为沙箱环境，默认false
);
$alidayu = new Alidayu($app);

// echo '<br />' . $alidayu->return_url . '<br />';

// 短信发送 passed AlibabaAliqinFcSmsNumSend
 $resp = $alidayu->request('alibaba.aliqin.fc.sms.num.send', function($req) {
    $req->setRecNum('13750607533')
    ->setSmsParam(array(
        'name' => rand(100000, 999999),
        'time' => '2分钟'
    ))
    ->setSmsFreeSignName('so鱼')
    ->setSmsTemplateCode('SMS_67610192');
}); 

// 短信发送记录查询 passed AlibabaAliqinFcSmsNumQuery
/* $resp = $alidayu->request('alibaba.aliqin.fc.sms.num.query', function($req) {
    $req->setBizId('')
        ->setRecNum('13750607533')
        ->setQueryDate('20170523')
        ->setCurrentPage(1)
        ->setPageSize('10');
}); */

// 文本转语音通知 passed AlibabaAliqinFcTtsNumSinglecall

// 语音通知 passed AlibabaAliqinFcVoiceNumSinglecall

// 多方通话 passed AlibabaAliqinFcVoiceNumDoublecall

// 流量直充 passed AlibabaAliqinFcFlowCharge

// 流量直充查询 passed AlibabaAliqinFcFlowQuery

// 流量直充档位表 passed AlibabaAliqinFcFlowGrade

// 流量直充分省接口 passed AlibabaAliqinFcFlowChargeProvince

// echo '<pre>';
// print_r($resp);
// echo '</pre>';









