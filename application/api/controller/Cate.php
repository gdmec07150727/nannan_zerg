<?php
namespace app\api\controller;

class Cate{
	public function lst(){
		$cate = db('cate')->select();
		echo json_encode($cate,JSON_UNESCAPED_UNICODE);
	}
}
?>