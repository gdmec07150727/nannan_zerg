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
		$openid = input('openid');
		$data = db('user')->where('openid',$openid)->find();
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
		session('openid',$user['openid']);
		session('username',$user['username']);
		//联表查询
		$arti = Db::name('article')->alias('a')->join('cate c','c.id=a.cate_id')->where('openid',$user['openid'])->field(['a.*','c.catename','c.id as cid'])->select();
		for($i=0;$i<count($arti);$i++)
		{
			$num = db('commen')->where('art_id',$arti[$i]['id'])->count();
			$arti[$i]['com'] = $num;
		}
		echo json_encode($arti,JSON_UNESCAPED_UNICODE);
	}

	public function edit(){
		$all = input('param.');
		$data = [
			'username' => $all['newname'],
			'userimg' => $all['img'],
		];
		if(Db::table('user')->where('openid',$all['openid'])->update($data)){
			$a['state'] = 1;
		}else{
			$a['state'] = 0;
		}
		echo json_encode($a,JSON_UNESCAPED_UNICODE);
		//https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIYwT5Qe2QMHJfy2w2s2xbXa21kenhCE7wsl2yeicL5FWGbwy5B40dficeFDibPhKwUiaeHAag4ukU1gw/132
	}
}
?>