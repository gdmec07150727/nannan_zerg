<?php
namespace app\api\controller;

class Follow{
	public function lst(){
		$data = input('param.');
		$fol = db('user')->alias('u')->join('follow f','u.id=f.uid')->where('username',$data['username'])->column('f.fid');
		if($fol==null)
		{
			$artt = 0;
			echo json_encode($artt,JSON_UNESCAPED_UNICODE);
		}else{
			$where = array();
			$where['user_id'] = array('in',$fol);
			for($i=0;$i<count($fol);$i++)
			{
				$art = db('article')->alias('a')->join('cate c','c.id=a.cate_id')->where($where)->select();
			}
			echo json_encode($art,JSON_UNESCAPED_UNICODE);
		}
		
	}
	public function foll(){
		$data = input('param.');
		$fol = db('user')->alias('u')->join('follow f','u.id=f.uid')->where('username',$data['username'])->column('f.fid');
		echo json_encode($fol,JSON_UNESCAPED_UNICODE);
	}
	public function pass(){
		$data = input('param.');
		$fol = db('user')->alias('u')->join('follow f','u.id=f.fid')->where('username',$data['username'])->column('f.uid');
		echo json_encode($fol,JSON_UNESCAPED_UNICODE);
	}
}
?>