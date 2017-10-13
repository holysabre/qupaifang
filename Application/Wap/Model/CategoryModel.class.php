<?php
namespace Wap\Model;
use Think\Model;
class CategoryModel extends BaseModel {

	public function __construct() {
        parent::__construct();
    }

    //获取分类
    public function procategory($type = 'products'){
        $data = S('category');
        if(!$data){
            $data = D('Admin/Category')->index($type);
        }
        $data = $data['products'];
    	foreach ($data as $key => $value) {
    		//判断是否存在链接
    		if(!empty($value['link'])){
    			$categoryurl = $value['link'];
    		}else{
    			$categoryurl = U('products/'.$value['html']);
    		}
    		$data[$key]['categoryurl'] = $categoryurl;
    	}
    	return $data;
    }
    

}