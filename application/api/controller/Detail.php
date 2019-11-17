<?php
namespace app\api\controller;

class Detail{
	public function detail(){
		$id = input('id');
		$new = db('news')->find($id);
		echo json_encode($new,JSON_UNESCAPED_UNICODE);
	}
}
?>