<?php

// 以print_r打印数组的方式排版
function dumps($data) {
    dump($data, true, null, false);
}

function url($url){

}

/**
 * 设置id为键
 */
function lists_key($list,$key = 'id'){
    $_list = array();
    foreach ($list as $k => $v) {
        $_list[$v[$key]] = $v;
    }
    return $_list;
}

/**
 * 获取分类某类别
 *
 * @param integer   $id      分类ID
 * @param array     $list    数组
 * @return array
 */
function tree_cate($list, $id = 0, $pid = 'pid') {
    $child = array();
    if (is_array($list)) {
        foreach ($list as $key => $val) {
            if ($val[$pid] == $id) $child[$key] = $val;
        }
    }
    return $child ? $child : false;
}

/**
 * 获取分类树 
 *
 * @param array     $list    数组
 * @param integer   $id      父级ID
 * @param integer   $level   等级
 * @param string    $adds    字符串
 * @param array     $type_arr 集合数组
 * @return array
 */
function tree_list($list, $id = 0, $level = 0, $nbsp = '&nbsp;', $adds = '', &$type_arr = array()) {
    //static $type_arr = array();
    $number = 1;
    $icon  = array('│ ', '├─ ', '└─ ');
    $child = tree_cate($list, $id);
    if (is_array($child)) {
        $total = count($child);
        foreach ($child as $val) {
            $j = $k = '';
            if ($number == $total) {
                $j .= $icon[2];
                $k = $adds ? $nbsp : '';
            } else {
                $j .= $icon[1];
                $k = $adds ? $icon[0] : '';
            }
            $spacer = $adds ? $adds . $j : '';
            $nbsp1 = $nbsp;
            $val['level']      = $level;
            $val['number']     = $number;
            $val['total']      = $total;
            $val['title_show'] = $spacer;
            $type_arr[$val['id']] = $val;
            tree_list($list, $val['id'], $level+1, $nbsp, ($adds . $k . $nbsp1), $type_arr);
            $number++;
        }
    }
    return $type_arr;
}

/**
 * 把返回的数据集转换成Tree
 *
 * @param array $list       要转换的数据集
 * @param string $pid       parent标记字段
 * @param string $level     level标记字段
 * @return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
    $tree = array();
    static $level = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $list[$key]['level'] = 0;
                $tree[$data['id']] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = & $refer[$parentId];
                    $level[$data[$pk]] = $level[$parentId]+1;
                    $list[$key]['level'] = $level[$data[$pk]];
                    $parent[$child][$data['id']] = &$list[$key];
                } 
            }
        }
    }
    return $tree;
}

/**
 * 查找某一分类的所有子类
 *
 * @param array     $data       数组
 * @param integer   $parent_id  父类ID
 * @return array
 */
function tree_child($data, $parent_id, $pid = 'pid', $id = 'id') {
    $result = array();
    $fids   = array($parent_id);
    do {
        $cids = array();
        $flag = false;
        foreach ($fids as $fid) {
            for ($i = count($data) - 1; $i >=0; $i--) {
                $node = $data[$i];
                if ($node[$pid] == $fid) {
                    array_splice($data, $i , 1); //删除它们并用其它值代替
                    $result[]   = $node[$id];
                    $cids[]     = $node[$id];
                    $flag       = true;
                }
            }
        }
        $fids = $cids;
    } while($flag === true);
    return $result;
}

/**
* 判断图片是否外链或者本地链接
*
* <img id="containImg" src="{$data.img|get_img=###,'','100x100.png'}" onerror="this.src='__PUBLIC__100x100.png'" />
* @param string        $img    图片路径
* @param string        $ext    扩展
* @param string        $err    图片不存在显示图片
* @return string
*/
function get_img($img, $ext = '', $err = '100x100.png') {
    if (strpos($img, 'http') !== false) {
        $_img   = $img;
    } else {
        $no     = (substr($err, 0, 1) == '/' ? '' : __ROOT__ . '/Public/images/') . $err;
        $yes    = __ROOT__ . str_replace('./', '/', $img);
        $_img   = (!empty($img) && file_exists($img . $ext)) ? ($yes . $ext) : $no;
    }
    return $_img;
}

function get_content_sub($content = '', $length = 100) {
    $content = htmlspecialchars_decode($content);
    $content = trim(strip_tags($content)); // 函数剥去 HTML、XML 以及 PHP 的标签。
    if(mb_strlen($content, 'utf-8') > $length) {
        $string = mb_substr($content, 0, $length, 'utf-8');
    } 
    else {
        $string = $content;
    }
    return $string;
}

/**
* 字符截取
*
* @param string    $str         字符
* @param array     $length      截取长度
* @param string    $tags        允许保留剥去字符串中的 HTML 标签
* @param string    $encoding    编码
* @return string
*/
function get_substr($str, $length, $tags ='', $encoding = 'utf-8') {
    $str = htmlspecialchars_decode($str);
    $str = trim(strip_tags($str, $tags));// 函数剥去 HTML、XML 以及 PHP 的标签。
    $str = str_replace('&nbsp;', '', $str);
    if (mb_strlen($str, $encoding) > $length) {
        $string = mb_substr($str, 0, $length, $encoding) . '...';
    } else {
        $string = $str;
    }
    return $string;
}

/**
 * 阿里大于 短信发送
 */

// function sendSms($mobile){
//    $app = array(
//         'app_key' => 'LTAIPqwtGRJhQP7c',
//         'app_secret' => 'jPUJ4OQ61gzESQc7sB8DgWgc65ppvF',
//         'sandbox' => false, // 是否为沙箱环境，默认false
//     );
//     $alidayu = new \Alidayu\Alidayu($app);
//     $smscode['code'] = rand(100000, 999999);
//     $smscode['time'] = time();
//     $resp = $alidayu->request('alibaba.aliqin.fc.sms.num.send', function($req) {
//         $req->setRecNum('13750607533')
//         ->setSmsParam(array(
//             'name' => $smscode['code'],
//             'time' => '5分钟'
//         ))
//         ->setSmsFreeSignName('Pange')
//         ->setSmsTemplateCode('SMS_67610192');
//     });
//     dump($resp);

//     echo '<br />' . $alidayu->return_url . '<br />';
// }
// 


/**
 * 发送邮件
 * @param array    $config   数组变量
 * @param string   $title    邮件标题
 * @param string   $content  邮件内容
 * @return int
 */
function get_email($config, $title, $content) { 
    import('Common.ORG.email');
    // 调用方法
    $mail = array(
        'server' => 'smtp.163.com', // smtp服务器
        'port'  => 25, // smtp服务器端口
        'user'  => 'tzlehuan@163.com', // 邮箱账户
        'pass'  => 'eglobe2016', // 邮箱密码
        'from'  => 'tzlehuan@163.com', // 发送人
        'to'    => '1812168237@qq.com', // 收件人
        'cc'    => '', // 抄送
        'bcc'   => '', // 秘密抄送
        'type'  => 'HTML'
    );
    $config = array_merge($mail, $config);
    $smtp = new \email($config);
    $smtp->debug    = true; //是否显示发送的调试信息
    //$smtp->useSSL   = true; //是否启用ssl
    $smtp->auth     = true; //是否启用登陆
    $state = $smtp->sendmail($title, $content);
    return $state;
}

//拼音获取函数===========================================================
/**
 * 返回指定中文的拼音
 * @param string $str
 * @param bool $first 当为true时返回中文拼音首字母
 * @param string $code 编码
 * @return array 返回汉字对应的拼音
 */
function yd_pinyin($str, $first = true, $code = 'UTF8'){
    $_Data = array ('zuo' => '-10254', 'zun' => '-10256', 'zui' => '-10260', 'zuan' => '-10262', 'zu' => '-10270', 'zou' => '-10274', 'zong' => '-10281', 'zi' => '-10296', 'zhuo' => '-10307', 'zhun' => '-10309', 'zhui' => '-10315', 'zhuang' => '-10322', 'zhuan' => '-10328', 'zhuai' => '-10329', 'zhua' => '-10331', 'zhu' => '-10519', 'zhou' => '-10533', 'zhong' => '-10544', 'zhi' => '-10587', 'zheng' => '-10764', 'zhen' => '-10780', 'zhe' => '-10790', 'zhao' => '-10800', 'zhang' => '-10815', 'zhan' => '-10832', 'zhai' => '-10838', 'zha' => '-11014', 'zeng' => '-11018', 'zen' => '-11019', 'zei' => '-11020', 'ze' => '-11024', 'zao' => '-11038', 'zang' => '-11041', 'zan' => '-11045', 'zai' => '-11052', 'za' => '-11055', 'yun' => '-11067', 'yue' => '-11077', 'yuan' => '-11097', 'yu' => '-11303', 'you' => '-11324', 'yong' => '-11339', 'yo' => '-11340', 'ying' => '-11358', 'yin' => '-11536', 'yi' => '-11589', 'ye' => '-11604', 'yao' => '-11781', 'yang' => '-11798', 'yan' => '-11831', 'ya' => '-11847', 'xun' => '-11861', 'xue' => '-11867', 'xuan' => '-12039', 'xu' => '-12058', 'xiu' => '-12067', 'xiong' => '-12074', 'xing' => '-12089', 'xin' => '-12099', 'xie' => '-12120', 'xiao' => '-12300', 'xiang' => '-12320', 'xian' => '-12346', 'xia' => '-12359', 'xi' => '-12556', 'wu' => '-12585', 'wo' => '-12594', 'weng' => '-12597', 'wen' => '-12607', 'wei' => '-12802', 'wang' => '-12812', 'wan' => '-12829', 'wai' => '-12831', 'wa' => '-12838', 'tuo' => '-12849', 'tun' => '-12852', 'tui' => '-12858', 'tuan' => '-12860', 'tu' => '-12871', 'tou' => '-12875', 'tong' => '-12888', 'ting' => '-13060', 'tie' => '-13063', 'tiao' => '-13068', 'tian' => '-13076', 'ti' => '-13091', 'teng' => '-13095', 'te' => '-13096', 'tao' => '-13107', 'tang' => '-13120', 'tan' => '-13138', 'tai' => '-13147', 'ta' => '-13318', 'suo' => '-13326', 'sun' => '-13329', 'sui' => '-13340', 'suan' => '-13343', 'su' => '-13356', 'sou' => '-13359', 'song' => '-13367', 'si' => '-13383', 'shuo' => '-13387', 'shun' => '-13391', 'shui' => '-13395', 'shuang' => '-13398', 'shuan' => '-13400', 'shuai' => '-13404', 'shua' => '-13406', 'shu' => '-13601', 'shou' => '-13611', 'shi' => '-13658', 'sheng' => '-13831', 'shen' => '-13847', 'she' => '-13859', 'shao' => '-13870', 'shang' => '-13878', 'shan' => '-13894', 'shai' => '-13896', 'sha' => '-13905', 'seng' => '-13906', 'sen' => '-13907', 'se' => '-13910', 'sao' => '-13914', 'sang' => '-13917', 'san' => '-14083', 'sai' => '-14087', 'sa' => '-14090', 'ruo' => '-14092', 'run' => '-14094', 'rui' => '-14097', 'ruan' => '-14099', 'ru' => '-14109', 'rou' => '-14112', 'rong' => '-14122', 'ri' => '-14123', 'reng' => '-14125', 'ren' => '-14135', 're' => '-14137', 'rao' => '-14140', 'rang' => '-14145', 'ran' => '-14149', 'qun' => '-14151', 'que' => '-14159', 'quan' => '-14170', 'qu' => '-14345', 'qiu' => '-14353', 'qiong' => '-14355', 'qing' => '-14368', 'qin' => '-14379', 'qie' => '-14384', 'qiao' => '-14399', 'qiang' => '-14407', 'qian' => '-14429', 'qia' => '-14594', 'qi' => '-14630', 'pu' => '-14645', 'po' => '-14654', 'ping' => '-14663', 'pin' => '-14668', 'pie' => '-14670', 'piao' => '-14674', 'pian' => '-14678', 'pi' => '-14857', 'peng' => '-14871', 'pen' => '-14873', 'pei' => '-14882', 'pao' => '-14889', 'pang' => '-14894', 'pan' => '-14902', 'pai' => '-14908', 'pa' => '-14914', 'ou' => '-14921', 'o' => '-14922', 'nuo' => '-14926', 'nue' => '-14928', 'nuan' => '-14929', 'nv' => '-14930', 'nu' => '-14933', 'nong' => '-14937', 'niu' => '-14941', 'ning' => '-15109', 'nin' => '-15110', 'nie' => '-15117', 'niao' => '-15119', 'niang' => '-15121', 'nian' => '-15128', 'ni' => '-15139', 'neng' => '-15140', 'nen' => '-15141', 'nei' => '-15143', 'ne' => '-15144', 'nao' => '-15149', 'nang' => '-15150', 'nan' => '-15153', 'nai' => '-15158', 'na' => '-15165', 'mu' => '-15180', 'mou' => '-15183', 'mo' => '-15362', 'miu' => '-15363', 'ming' => '-15369', 'min' => '-15375', 'mie' => '-15377', 'miao' => '-15385', 'mian' => '-15394', 'mi' => '-15408', 'meng' => '-15416', 'men' => '-15419', 'mei' => '-15435', 'me' => '-15436', 'mao' => '-15448', 'mang' => '-15454', 'man' => '-15625', 'mai' => '-15631', 'ma' => '-15640', 'luo' => '-15652', 'lun' => '-15659', 'lue' => '-15661', 'luan' => '-15667', 'lv' => '-15681', 'lu' => '-15701', 'lou' => '-15707', 'long' => '-15878', 'liu' => '-15889', 'ling' => '-15903', 'lin' => '-15915', 'lie' => '-15920', 'liao' => '-15933', 'liang' => '-15944', 'lian' => '-15958', 'lia' => '-15959', 'li' => '-16155', 'leng' => '-16158', 'lei' => '-16169', 'le' => '-16171', 'lao' => '-16180', 'lang' => '-16187', 'lan' => '-16202', 'lai' => '-16205', 'la' => '-16212', 'kuo' => '-16216', 'kun' => '-16220', 'kui' => '-16393', 'kuang' => '-16401', 'kuan' => '-16403', 'kuai' => '-16407', 'kua' => '-16412', 'ku' => '-16419', 'kou' => '-16423', 'kong' => '-16427', 'keng' => '-16429', 'ken' => '-16433', 'ke' => '-16448', 'kao' => '-16452', 'kang' => '-16459', 'kan' => '-16465', 'kai' => '-16470', 'ka' => '-16474', 'jun' => '-16647', 'jue' => '-16657', 'juan' => '-16664', 'ju' => '-16689', 'jiu' => '-16706', 'jiong' => '-16708', 'jing' => '-16733', 'jin' => '-16915', 'jie' => '-16942', 'jiao' => '-16970', 'jiang' => '-16983', 'jian' => '-17185', 'jia' => '-17202', 'ji' => '-17417', 'huo' => '-17427', 'hun' => '-17433', 'hui' => '-17454', 'huang' => '-17468', 'huan' => '-17482', 'huai' => '-17487', 'hua' => '-17496', 'hu' => '-17676', 'hou' => '-17683', 'hong' => '-17692', 'heng' => '-17697', 'hen' => '-17701', 'hei' => '-17703', 'he' => '-17721', 'hao' => '-17730', 'hang' => '-17733', 'han' => '-17752', 'hai' => '-17759', 'ha' => '-17922', 'guo' => '-17928', 'gun' => '-17931', 'gui' => '-17947', 'guang' => '-17950', 'guan' => '-17961', 'guai' => '-17964', 'gua' => '-17970', 'gu' => '-17988', 'gou' => '-17997', 'gong' => '-18012', 'geng' => '-18181', 'gen' => '-18183', 'gei' => '-18184', 'ge' => '-18201', 'gao' => '-18211', 'gang' => '-18220', 'gan' => '-18231', 'gai' => '-18237', 'ga' => '-18239', 'fu' => '-18446', 'fou' => '-18447', 'fo' => '-18448', 'feng' => '-18463', 'fen' => '-18478', 'fei' => '-18490', 'fang' => '-18501', 'fan' => '-18518', 'fa' => '-18526', 'er' => '-18696', 'en' => '-18697', 'e' => '-18710', 'duo' => '-18722', 'dun' => '-18731', 'dui' => '-18735', 'duan' => '-18741', 'du' => '-18756', 'dou' => '-18763', 'dong' => '-18773', 'diu' => '-18774', 'ding' => '-18783', 'die' => '-18952', 'diao' => '-18961', 'dian' => '-18977', 'di' => '-18996', 'deng' => '-19003', 'de' => '-19006', 'dao' => '-19018', 'dang' => '-19023', 'dan' => '-19038', 'dai' => '-19212', 'da' => '-19218', 'cuo' => '-19224', 'cun' => '-19227', 'cui' => '-19235', 'cuan' => '-19238', 'cu' => '-19242', 'cou' => '-19243', 'cong' => '-19249', 'ci' => '-19261', 'chuo' => '-19263', 'chun' => '-19270', 'chui' => '-19275', 'chuang' => '-19281', 'chuan' => '-19288', 'chuai' => '-19289', 'chu' => '-19467', 'chou' => '-19479', 'chong' => '-19484', 'chi' => '-19500', 'cheng' => '-19515', 'chen' => '-19525', 'che' => '-19531', 'chao' => '-19540', 'chang' => '-19715', 'chan' => '-19725', 'chai' => '-19728', 'cha' => '-19739', 'ceng' => '-19741', 'ce' => '-19746', 'cao' => '-19751', 'cang' => '-19756', 'can' => '-19763', 'cai' => '-19774', 'ca' => '-19775', 'bu' => '-19784', 'bo' => '-19805', 'bing' => '-19976', 'bin' => '-19982', 'bie' => '-19986', 'biao' => '-19990', 'bian' => '-20002', 'bi' => '-20026', 'beng' => '-20032', 'ben' => '-20036', 'bei' => '-20051', 'bao' => '-20230', 'bang' => '-20242', 'ban' => '-20257', 'bai' => '-20265', 'ba' => '-20283', 'ao' => '-20292', 'ang' => '-20295', 'an' => '-20304', 'ai' => '-20317', 'a' => '-20319',);
    if (strtolower($code) != 'gb2312') { 
        $str = _U2_Utf8_Gb($str); 
    }
    $_Res = '';
    for ($i=0; $i<strlen($str); $i++) {
        $_P = ord(substr($str, $i, 1));
        if ($_P>160) {
            $_Q = ord(substr($str, ++$i, 1)); 
            $_P = $_P*256 + $_Q - 65536;
        }
        $py = _Pinyin($_P, $_Data);
        if (!empty($py)) {
            $_Res .= $first ? $py[0] : $py;
        }
    }
    $py = preg_replace("/[^a-zA-Z0-9]*/", '', $_Res);
    $py = strtolower($py); //返回小写字母
    return $py;
}
function _Pinyin($_Num, $_Data) {
    if ($_Num>0 && $_Num<160) {
        return chr($_Num);
    } elseif ($_Num<-20319 || $_Num>-10247) {
        return '';
    } else {
        foreach ($_Data as $k=>$v) {
            if ($v<=$_Num) break;
        }
        return $k;
    }
}
function _U2_Utf8_Gb($_C) {
    $_String = '';
    if ($_C < 0x80) {
        $_String .= $_C;
    } elseif($_C < 0x800) {
        $_String .= chr(0xC0 | $_C>>6);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif($_C < 0x10000) {
        $_String .= chr(0xE0 | $_C>>12);
        $_String .= chr(0x80 | $_C>>6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif($_C < 0x200000) {
        $_String .= chr(0xF0 | $_C>>18);
        $_String .= chr(0x80 | $_C>>12 & 0x3F);
        $_String .= chr(0x80 | $_C>>6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    }
    //加上"//ignore"使有不能转换的字符出现时不报错
    return iconv('UTF-8', 'GB2312//ignore', $_String);
}