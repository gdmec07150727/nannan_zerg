<?php
namespace app\api\controller;

class Banner{
	public function swip(){
		$img = db('imglist')->select();
		echo json_encode($img);
	}
}
?>