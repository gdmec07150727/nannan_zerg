<?php
namespace app\api\controller;

class News{
	public function lst(){
		$new = db('news')->select();
		echo json_encode($new,JSON_UNESCAPED_UNICODE);
	}
}
?>