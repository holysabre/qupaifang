<?php
namespace Home\Controller;
use Think\Controller;
class SubjectController extends BaseController {

	public $model;
	public function __construct() {
        parent::__construct();
        $this->model = D('subject');
    }

    //转向跳转
    public function turnUrl(){
        $action = I('request.action');
        if($action){
            $this->model->$action();
        }
    }

    //标的主页
    public function index(){
        //正在竞拍
        $now_where = array(
            'status' => 2,
        );
    	$now_list = $this->model->getList($now_where,6);
    	$this->assign('now_list',$now_list);
        //dumps($now_list);

        //即将开拍
        //明天 
        $tomorrow_where = array(
            'status' => 1,
            'start_time' => array('between',array(strtotime('+1 day'),strtotime('+2 day'))),
        );
        $tomorrow_list = $this->model->getList($tomorrow_where,8);
        $this->assign('tomorrow_list',$tomorrow_list);
        //后天 
        $thedayaftertomorrow_where = array(
            'status' => 1,
            'start_time' => array('between',array(strtotime('+1 day'),strtotime('+2 day'))),
        );
        $thedayaftertomorrow_list = $this->model->getList($thedayaftertomorrow_where,8);
        $this->assign('thedayaftertomorrow_list',$thedayaftertomorrow_list);

        //已结束
        $end_where = array(
            'status' => 3,
        );
        $end_list = $this->model->getList($end_where,8);
        $this->assign('end_list',$end_list);

    	$this->display();
    }

    //列表
    public function lists(){
        //标的分类
        $subject_category = D('Admin/SubjectCategory')->findAll();
        $this->assign('subject_category',$subject_category);
        //标的城市
        $subject_city = D('Admin/SubjectCity')->findAll();
        $this->assign('subject_city',$subject_city);

        //配置
        $config = $this->config;
        $this->assign('Config',$config);

        $this->display();
        //dumps($config);
    }

    //异步获取标的列表
    public function ajax_list(){
        $where['examine'] = 1;
        $where['shelves'] = 1;
        //$where['end_time'] = array('gt',time());
        $data = $this->model->getList($where);
        $list = array();
        if ($data['list']) {
            foreach ($data['list'] AS $key => $val) {
                $val['linkurl'] = U('Subject/detail',array('id'=>$val['id']));
                $val['image'] = get_img($val['image']);
                $val['evaluate_price'] = sprintf("%.2f", $val['evaluate_price']/10000);
                $val['current_price'] = $val['current_price']?sprintf("%.2f", $val['current_price']/10000):$val['evaluate_price'];
                $val['endtime_yearmonth'] = date('m月d日',$val['end_time']);
                $val['endtime_time'] = date('h:i',$val['end_time']);
                $list[] = $val;
            }
        }
        
        $data['list'] = $list;
        $this->ajax_check('', 1, $data);
    }
    
    //标的详情
    public function detail(){
    	$info = $this->model->getDetail();
    	$this->assign('info',$info);
    	$this->display();
    }
    
    //报名交保证金 / 一口价出价
    public function post_bond(){
        D('Payment')->postBond();
    }

    //竞拍加价
    public function makeup_bidding(){
        
    }

    //收藏
    public function collect(){
        
    }

}