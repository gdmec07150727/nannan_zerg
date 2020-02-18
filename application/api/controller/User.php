<?php
namespace app\api\controller;
use think\Request;
use think\Db;
use think\Session;

class User{

	public function exam(){
		echo "hello world";
	}
	public function lst(){
		$username = input('username');
		$data = db('user')->where('username',$username)->find();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}

	public function add(){
		// $username = input('username');
		// $userimg = input('userimg');
		// $openid = input('openid');
		// $username = input('username');
		// $userimg = input('userimg');
		
		$all = input('param.');
		$data = [
			'username' => $all['username'],
			'userimg' => $all['userimg'],
			'openid' => $all['openid']
		];
		//$this->getOpenid($data['code']);
		if(!db('user')->where('openid',$data['openid'])->find()){
			db('user')->insert($data);
		}

		$user = db('user')->where('openid',$data['openid'])->find();
		session('uid',$user['id']);
		session('username',$user['openid']);
		//联表查询
		$arti = Db::name('article')->alias('a')->join('cate c','c.id=a.cate_id')->where('user_id',$user['id'])->select();
		echo json_encode($arti,JSON_UNESCAPED_UNICODE);
	}

	public function edit(){
		$all = input('param.');
		$data = [
			'username' => $all['newname'],
			'userimg' => $all['img'],
		];
		if(Db::table('user')->where('username',$all['username'])->update($data)){
			$a['state'] = 1;
		}else{
			$a['state'] = 0;
		}
		echo json_encode($a,JSON_UNESCAPED_UNICODE);
	}
}
?>