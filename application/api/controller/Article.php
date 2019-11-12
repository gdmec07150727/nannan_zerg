<?php
namespace app\api\controller;
use think\Request;

class Article{
	public function lst(){
		$username = input('username');
		$data = db('article')->where('author',$username)->select();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
}
?>