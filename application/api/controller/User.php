<?php
namespace app\api\controller;
use think\Request;
use think\Db;

class User{
	public function add(){
		// $username = input('username');
		// $userimg = input('userimg');
		$all = input('param.');
		$data = [
			'username' => $all['username'],
			'userimg' => $all['userimg'],
		];

		if(!db('user')->where('username',$data['username'])->find()){
			db('user')->insert($data);
		}

		$user = db('user')->where('username',$data['username'])->find();
		//联表查询
		$arti = Db::name('article')->alias('a')->join('cate c','c.id=a.cate_id')->where('user_id',$user['id'])->select();
		echo json_encode($arti,JSON_UNESCAPED_UNICODE);


		
	}
}
?>