<?php
namespace app\api\controller;
use think\Request;
use think\Db;

class Commen{
	public function add(){
		$all = input('param.');
		$now_time= time();
		$now_date= date('Y-m-d',$now_time);
		$a = "";
		$data = [
			'art_id' => $all['art_id'],
			'uopenid' => $all['uopenid'],
			'content' => $all['content'],
			'art_openid' => $all['art_openid'],	
			'data' => $now_date,
		];
		if(db('commen')->insert($data))
		{
			$a = "true";
		}else{
			$a = "false";
		}
		echo json_encode($a,JSON_UNESCAPED_UNICODE);
	}

	public function lst(){
		$art_id = input('art_id');
		$data = db('commen')->alias('c')->join('user u','c.uopenid=u.openid')->where('art_id',$art_id)->field(['c.*','u.username','u.userimg'])->select();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}

	public function lst_user(){
		$art_openid = input('art_openid');
		$data = db('commen')->alias('c')->join('user u','c.uopenid=u.openid')->join('article a','a.id=c.art_id')->where('art_openid',$art_openid)->field(['c.*','u.username','u.userimg','a.id as aid','a.pic'])->select();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);

	}

}

?>