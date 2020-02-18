<?php
namespace app\api\controller;
use think\Request;

class Square{
	public function lst(){
		$cateid = input('id');
		$data = db('article')->where('cate_id',$cateid)->select();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
}
?>