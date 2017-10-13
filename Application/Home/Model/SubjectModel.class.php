<?php
namespace Home\Model;
use Think\Model;
class SubjectModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    //获取标的列表
    public function getList($where = array(),$pagenum = 8){
        //筛选条件
        $where['is_delete'] = 0;//正常状态
        
        $tomorrow = array('between',array(strtotime('+1 day'),strtotime('+2 day')));
        $tomorrow2 = array('between',array(strtotime('+2 day'),strtotime('+3 day')));

        //异步筛选条件
        $ajax = I('request.ajax');
        if($ajax){
            $ajax = explode(',', trim($ajax,','));
            foreach ($ajax as $key => $value) {
                $value = explode(':', $value);
                if($value[1] != 0){
                    $where[$value[0]] = $value[1];
                }
                if($value[1] == 'tomorrow'){
                    $where['start_time'] = $tomorrow;
                }elseif($value[1] == 'tomorrow2'){
                    $where['start_time'] = $tomorrow2;
                }
            }
        }
        //处理开拍时间
        if($data['start_time']){
            $start_time = time() + $data['start_time'] * 24 * 60 *60;
            $where['start_time'] = array('lt',$start_time);
        }
        //dumps($where);
        //排序
        $order = 'examine desc, id desc';

        $count = $this->where($where)->count();
        $Page  = new \Think\Page($count, $pagenum, I('request.'));
        $Page->setConfig('header', '<span class="info">共 %TOTAL_ROW% 条记录</span>');
        $array = $this->where($where)->order($order)->limit($Page->firstRow . ',' . $Page->listRows)->select();

        foreach ($array as $key => $value) {
            $this->checkStatus($value);
            //计算出价次数
            $bid_log = $this->getBidLog($value['id']);
            $array[$key]['bid_count'] = count($bid_log);
            //报名次数
            $bond_count = $this->getBondCount($value['id']);
            $array[$key]['bond_count'] = count($bond_count);
            //是否收藏
            $array[$key]['is_collection'] = $this->isCollection($value['id']);
        }
        //echo $this->getLastSql();
        $data = array();
        $data = I('request.');
        $data['list'] = $array;
        $data['page'] = $Page->show();
        $data['count'] = $count;
        //dumps($array);
        return $data;
    }

    //获取标的详情
    public function getInfo($s_id){
        $id = I('request.id');
        $id = $s_id?$s_id:$id;
        $info = $this->getSingleInfo($id);
        $info['album'] = unserialize($info['album']);

        $where = array();
        $where['s_id'] = $id;
        $building = M('Subject_building')->where($where)->select();
        foreach ($building as $key => $value) {
            $info['building_type'] .= $value['title'].',';
            $_building[$value['building_type']] = $value;
        }
        $info['building_type'] = rtrim($info['building_type'],',');
        $info['building'] = $_building;
        $info['content'] = htmlspecialchars_decode($info['content']);
        //dumps($info);
        return $info;
    }

    //获取标的详情
    public function getDetail(){
        $id = I('request.id');
        if(!$id){
            return false;
        }
        $info = $this->getSingleInfo($id);
        $info['album'] = unserialize($info['album']);

        $where = array();
        $where['s_id'] = $id;
        $building = M('Subject_building')->where($where)->select();
        foreach ($building as $key => $value) {
            $info['building_type'] .= $value['title'].',';
            $_building[$value['building_type']] = $value;
        }
        $info['building_type'] = rtrim($info['building_type'],',');
        $info['building'] = $_building;
        $info['content'] = htmlspecialchars_decode($info['content']);
        $info['is_bond'] = $this->isBond($id);
        $info['is_collection'] = $this->isCollection($info['id']);

        //增加点击数 （围观数量）
        $result = $this->where('id='.$id)->setInc('onlook',1);

        //dumps($info);
        return $info;
    }

    //获取标的信息（单表）
    public function getSingleInfo($id){
        $info = $this->find($id);
        $this->checkStatus($info);
        $this->checkDeal($info);
        return $info;
    }

    //根据时间判断标的的状态
    public function checkStatus($info){
        if($info['status'] != 3){
            if(time() > $info['start_time'] && time() < $info['end_time'] && $info['shelves'] == 1){
                //当达到开拍时间后 改变竞拍状态
                $result = $this->where('id='.$info['id'])->setField('status',2);
            }elseif(time() > $info['end_time']){
                //竞拍结束 改变竞拍状态
                $result = $this->where('id='.$info['id'])->setField('status',3);
            }
        }
    }

    /**
     * 检查是否成交
     * 如果已经成交 改变is_deal 继续成交步骤
     * 如果没有成交 流拍
     */
    public function checkDeal($info){
        if($info['status'] != 3){
            return false;
        }
        $where['s_id'] = $info['id'];
        $where['status'] = 1;
        $result = M('subject_bid')->where($where)->find();
        //dumps($result);
        if($result && $info['is_deal'] != 1){
            //成交
            $result2 = $this->where('id='.$info['id'])->setField('is_deal',1);
            if($result2){
                //增加成交表数据
                $data = array();
                $data['buy_id'] = $result['m_id'];
                $data['sell_id'] = $info['m_id'];
                $data['s_id'] = $info['id'];
                $data['time'] = time();
                $result3 = M('deal')->add($data);
                $result4 = D('Payment')->deal($info,$result);
            }
        }else{
            //流拍
        }
    }


    /**
     * $status 状态 1即将竞拍，2正在竞拍，3已结束
     * $limit 条数
     */
    public function getLimit($status = 1,$limit = 8){
        $where = array();
        $where['status'] = $status;
        $where['is_delete'] = 0;

        $order = 'end_time asc';

        $count = $this->where($where)->count();
        $list = $this->where($where)->order($order)->limit($limit)->select();

        $data = array();
        $data['list'] = $list;
        $data['count'] = $count;
        return $data;
    }

    //获取标的列表 根据条件
    public function getListsByTerm($table,$where = array()){
        $member = $this->member;
        $field = 'a.m_id,a.time,b.id,b.sale_type,b.is_delete,b.status,b.image,b.title,b.current_price,b.evaluate_price';
        $where['a.m_id'] = $member['id'];
        $where['b.is_delete'] = 0;

        $list = M($table.' as a')->join('left join p_subject as b on a.s_id = b.id')->field($field)->where($where)->order('a.time desc')->select();
        // dumps($where);
        // echo M()->_sql();
        // echo M()->getDbError();

        foreach($list as $k=>$v){
            $data[date('Y-m-d',$v['time'])][]=$v;//分组
        }

        $array = array();
        $array['list'] = $data;
        $array['count'] = count($list);
        return $array;
    }


    //获取已成交标的
    public function getDeal($belongs = 'buy'){
        $member = $this->member;
        $field = 'a.time,b.id,b.sale_type,b.is_delete,b.status,b.image,b.title,b.current_price,b.evaluate_price';
        $where['b.is_delete'] = 0;
        if($belongs == 'buy'){
            $where['a.buy_id'] = $member['id'];
            $field .= ',a.buy_id';
        }elseif($belongs == 'sell'){
            $where['a.sell_id'] = $member['id'];
            $field .= ',a.sell_id';
        }

        $list = M('deal as a')->join('left join p_subject as b on a.s_id = b.id')->field($field)->where($where)->order('a.time desc')->select();

        foreach($list as $k=>$v){
            $data[date('Y-m-d',$v['time'])][]=$v;//分组
        }

        $array = array();
        $array['list'] = $data;
        $array['count'] = count($list);
        return $array;
    }

    //出售
    public function agree(){
        $is_agreement = I('request.is_agreement');
        if($is_agreement){
            //记录操作
            $log = array();
            $log['m_id'] = $this->m_id;
            $log['desc'] = '';
            $log['action'] = '已阅读并同意服务协议';
            $log_result = subject_log($log);
            if($log_result){
               $this->ajax_check('已阅读并同意服务协议',1,'',U('Member/sell2')); 
            }
        }
    }

    //填写房屋基本信息
    public function houseInfo(){
        $id = I('request.id',0);
        $data = $this->create();
        $obligee = I('request.obligee');

        // dumps($data);
         // dumps($obligee);
         // exit;

        $data['m_id'] = $this->m_id;
        //$data['title'] = $data['title']?$obligee['obligee_main']['address']:$data['title'];//如果不存在标题，则为主房地址
        //图片集第一张为主图
        $image = reset($obligee['album']['images']);
        $data['image'] = $image['img'];
        $data['album'] = serialize($obligee['album']['images']);//图片集处理
        $data['content'] = htmlspecialchars($data['content']);
        //时间格式转时间戳
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        $data['time'] = time();
        $data['longitude'] = $data['longitude']?$data['longitude']:'119.916823';//默认经度
        $data['latitude'] = $data['latitude']?$data['latitude']:'32.471535';//默认纬度
        if($id == 0){
            $data['addtime'] = time();
            $result = $this->add($data);
            if($result){
                $res = $this->houseInfoType($result,$obligee);
                //记录操作
                $log = array();
                $log['s_id'] = $result;
                $log['m_id'] = $this->m_id;
                $log['desc'] = '';
                $log['action'] = '填写标的信息（新增）';
                $log_result = subject_log($log);
                $data = array(
                    'title' => '房地产（不动产）出售确认书',
                );
                $this->ajax_check('已生成出售确定书',1,$data,U('Contract/bid_contract',array('id'=>$result)));
            }else{
                $this->ajax_check('信息填写有误，请检查...');
            }
        }else{
            $result = $this->save($data);
            if($result){
                $res = $this->houseInfoType($result,$obligee);
                //记录操作
                $log = array();
                $log['s_id'] = $id;
                $log['m_id'] = $this->m_id;
                $log['desc'] = '';
                $log['action'] = '填写标的信息（修改）';
                $log_result = subject_log($log);
                $data = array(
                    'title' => '房地产（不动产）出售确认书',
                );
                $this->ajax_check('已生成出售确定书',1,$data,U('Contract/bid_contract',array('id'=>$id)));
            }else{
                $this->ajax_check('信息填写有误，请检查...');
            }
        }
    }

    //房屋类型信息
    public function houseInfoType($id,$data){
        $table = M('subject_building');
        //去掉图片集 和 空的房屋类型信息
        foreach ($data as $key => $value) {
            if($key == 'album' || empty($value['certificates_number']) || $value['certificates_number'] == '输入有效证件号'){
                unset($data[$key]);
            }
        }
        foreach ($data as $key => $value) {
            $where['s_id'] = $id;
            $where['building_type'] = $key;
            $is_set = $table->where($where)->find();
            // echo $key;
            // dumps($value);
            $map = array(
                'title' => $value['title'],
                'province' => $value['province'],
                'city' => $value['city'],
                'area' => $value['area'],
                'address' => $value['address'],
                'certificates_type' => $value['certificates_type'],
                'certificates_number' => $value['certificates_number'],
                's_id' => $id,
                'building_type' => $key,
                'certificates_image' => serialize($value['images']),
                'time' => time(),
            );
            if($is_set){
                $where['s_id'] = $id;
                $where['building_type'] = $key;
                $result = $table->where($where)->save($map);
            }else{
                $result = $table->add($map);
            }
            //echo M()->_sql();
        }
        return true;
    }

    //确认出售合同
    public function confirmContract(){
        $id = I('request.id');
        $res = $this->where('id='.$id)->setField(array('is_confirm'=>1,'time'=>time()));
        if($res){
            //记录操作
            $log = array();
            $log['s_id'] = $id;
            $log['m_id'] = $this->m_id;
            $log['desc'] = '';
            $log['action'] = '核对完成，确认出售';
            $log_result = subject_log($log);
            if($log_result){
               $this->ajax_check('',1,'',U('Member/sell4')); 
            }
        }
    }

    //获取当前信息
    public function getCurrentInfo(){
        $s_id = I('request.s_id');//标的id
        $where['s_id'] = $s_id;
        $info = $this->getSingleInfo($s_id);
        $list = M('subject_bid')->where($where)->select();
        foreach ($list as $key => $value) {
            $list[$key]['price'] = number_format($value['price']);
            $list[$key]['time'] = date('Y年m月d日 H:i:s',$value['time']);
        }
        $current_info = $this->getCurrentBid($s_id);
        $data = array();
        $data['status'] = $info['status'];
        $data['current_price'] = number_format($current_info['price']);
        $data['current_person'] = $current_info['bid_no'];
        $data['end_time'] = $info['end_time'] * 1000; //*1000 转js时间戳
        $data['list'] = $list;
        $this->ajax_check('',1,$data);
    }

    //获取当前价
    public function getCurrentBid($s_id){
        $where['s_id'] = $s_id;
        $where['status'] = 1;
        $current_info = M('subject_bid')->where($where)->find();
        $info = $this->getSingleInfo($s_id);

        if(!$current_info){
            $current_info['price'] = $info['start_price'];
        }
        return $current_info;
    }

    //获取竞买记录
    public function getBidLog($s_id){
        $where['s_id'] = $s_id;
        $order = 'status desc,time desc';
        $result = M('subject_bid')->where($where)->order($order)->select();
        return $result;
    }

    //获取报名记录
    public function getBondCount($s_id){
        $where['s_id'] = $s_id;
        $list = M('bond')->where($where)->select();
        return $list;
    }

    //判断是否已经提交保证金
    public function isBond($id){
        $member = $this->member;
        $where['m_id'] = $member['id'];
        $where['s_id'] = $id;
        $result = M('bond')->where($where)->find();
        return $result?1:0;
    }

    //竞拍
    public function auction(){
        $member = $this->member;
        $m_id = $member['id'];
        $s_id = I('request.s_id');
        $info = $this->getInfo($s_id);
        $increase_price = I('request.increase_price');
        //判断竞拍是否开始
        if(time() < $info['start_time']){
            $this->ajax_check('竞拍尚未开始');
        }
        //判断竞拍金额是否小于当前价格
        $current_info = $this->getCurrentBid($s_id);
        if($increase_price <= $current_info['price']){
            $this->ajax_check('竞拍价格不能小于当前价格');
        }
        //记录到竞拍记录表
        $data = array(
            's_id' => $s_id,
            'm_id' => $m_id,
            'bid_no' => $member['bid_no'],
            'price' => $increase_price,
            'status' => 1,
            'time' => time()
        );
        $result = M('subject_bid')->add($data);
        //出局 
        $this->updateBid($s_id,$result);
        //更新标的当前价
        $result = $this->where('id='.$s_id)->setField(array('current_price'=>$increase_price));
        //写入会员操作日志
        if($result){
            //记录操作
            $log = array();
            $log['s_id'] = $s_id;
            $log['m_id'] = $m_id;
            $log['desc'] = '';
            $log['action'] = '参与竞拍，出价'.$increase_price;
            $log_result = subject_log($log);
        }
        //判断是否需要延时
        if(($info['end_time'] - time()) < 300){
            //延迟5分钟
            $result = $this->where("id=".$s_id)->setInc('end_time',$info['delay_period'] * 60);
        }
        //返回结果
        $this->ajax_check('出价成功',1);
    }

    //一口价
    public function buyout(){
        $member = $this->member;
        $m_id = $member['id'];
        $s_id = I('request.s_id');
        $info = $this->getInfo($s_id);
        //判断竞拍是否开始
        if(time() < $info['start_time']){
            $this->ajax_check('竞拍尚未开始');
        }
        //扣款到冻结保证金
        
        
        //记录到竞拍记录表
        $data = array(
            's_id' => $s_id,
            'm_id' => $m_id,
            'bid_no' => $member['bid_no'],
            'price' => $info['start_price'],
            'status' => 1,
            'time' => time()
        );
        $result = M('subject_bid')->add($data);
        //写入会员操作日志
        if($result){
            //记录操作
            $log = array();
            $log['s_id'] = $s_id;
            $log['m_id'] = $m_id;
            $log['desc'] = '';
            $log['action'] = '一口价拍下，出价'.$info['start_price'];
            $log_result = subject_log($log);
        }
        //返回结果
        $this->ajax_check('出价成功',1);
    }

    //更改竞拍表的 领先 出局
    public function updateBid($s_id,$b_id){
        if($b_id){
            $where['s_id'] = $s_id;
            $where['id'] = array('lt',$b_id);
            $result = M('subject_bid')->where($where)->setField(array('status'=>0));
            return $result;
        }
    }

    //更改标的状态
    public function changeSubject(){
        $id = I('request.id');
        $key = I('request.key');
        $value = I('request.value');
        if($id){
            //判断是否允许上下架
            if($key == 'shelves'){
                $this->checkShelves($id,$value);
            }
            $where['id'] = $id;
            $map[$key] = $value;
            $result = $this->where($where)->setField($map);
            if($result){
                $this->ajax_check('修改成功',1);
            }else{
                $this->ajax_check('操作失败');
            }
        }
    }

    //判断是否满足上下架的条件
    public function checkShelves($id,$value){
        if($value == 1){
            //上架
            //未通过审核 不允许上架
            //结束时间已过期 不允许上架
            $info = $this->getSingleInfo($id);
            if($info['status'] > 1 || $info['examine'] != 1){
                $this->ajax_check('不满足上架条件，无法上架');
            }
        }elseif ($value == 0) {
            //下架
            //当该标的有提交保证金时，不允许下架
            $where['s_id'] = $id;
            $result = M('bond')->where($where)->select();
            if($result){
                $this->ajax_check('该标的有已提交的保证金，不允许下架');
            }
        }
    }

    //收藏
    public function collection(){
        $member = $this->member;
        if(!$member){
            $this->ajax_check('请先登录',2);
        }
        $s_id = I('request.s_id');
        $status = I('request.status');
        $data = array(
            's_id' => $s_id,
            'm_id' => $member['id']
        );
        if($status == 0){
            $data['time'] = time();
            $result = M('collection')->add($data);
            if($result){
                $this->ajax_check('已收藏',1);
            }
        }else{
            $result = M('collection')->where($data)->delete();
            if($result){
                $this->ajax_check('取消收藏',1);
            }
        }
    }

    //判断是否收藏
    public function isCollection($s_id){
        $member = $this->member;
        if(!$member){
            return 0;
        }
        $where['m_id'] = $member['id'];
        $where['s_id'] = $s_id;
        $result = M('collection')->where($where)->find();
        if($result){
            return 1;
        }
    }

    //删除标的
    //标的is_delete 状态变为0
    public function delete(){
        $id = I('request.id');
        $info = $this->getSingleInfo($id);
        if($info['shelves'] == 1){
            $this->ajax_check('标的已上架，不允许删除');
        }
        $result = $this->where('id='.$id)->setField('is_delete',1);
        if($result){
            $this->ajax_check('已删除',1);
        }
    }

    //判断标的是否为自己上架
    public function isSelf(){
        $member = $this->member;
        if(!$member){
            $this->ajax_check('未登录');
        }
        $id = I('request.s_id');
        $info = $this->getSingleInfo($id);
        if($info['m_id'] == $member['id']){
            $this->ajax_check('不能参与自己上架的标的',2);
        }else{
            $this->ajax_check('验证通过',1);
        }
    }

    //获取成交标的列表（附带地址）
    public function getDealList(){
        $where = array();
        $subject_list = M('deal as a')->field('a.s_id,a.time,a.deal_price,b.id,b.title,b.building_area,b.onlook,b.image')->join('left join p_subject as b on a.s_id = b.id')->where($where)->order('a.time desc')->select();
        //echo M()->getDbError();
        $building_list = M('subject_building')->select();
        foreach ($subject_list as $key => $value) {
            foreach ($building_list as $k => $v) {
                if($value['id'] == $v['s_id'] && $v['building_type'] == 'obligee_main'){
                    $subject_list[$key]['building_address'] = $v['area'];
                }
            }
        }
        return $subject_list;
    }

}