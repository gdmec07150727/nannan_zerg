<?php
namespace app\api\controller;
use think\Request;

class Article{
	public function lst(){
		$cate_id = input('id')+1;
		//$data = db('article')->where('cate_id',$cate_id)->select();
		$data = db('article')->alias('a')->join('cate c','c.id=a.cate_id')->where('cate_id',$cate_id)->select();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		
	}
}
?>