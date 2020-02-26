<?php
namespace app\api\controller;

class Follow{
	public function lst(){
		$data = input('param.');
		$fol = db('user')->alias('u')->join('follow f','u.openid=f.uopenid')->where('openid',$data['openid'])->column('f.fopenid');
		if($fol==null)
		{
			$artt = 0;
			echo json_encode($artt,JSON_UNESCAPED_UNICODE);
		}else{
			$where = array();
			$where['openid'] = array('in',$fol);
			for($i=0;$i<count($fol);$i++)
			{
				$art = db('article')->alias('a')->join('cate c','c.id=a.cate_id')->where($where)->field(['a.*','c.catename','c.id as cid'])->select();
				for($i=0;$i<count($art);$i++)
				{
					$num = db('commen')->where('art_id',$art[$i]['id'])->count();
					$art[$i]['com'] = $num;
				}
			}
			echo json_encode($art,JSON_UNESCAPED_UNICODE);
		}
		
	}
	public function foll(){
		$data = input('param.');
		//$fol = db('user')->alias('u')->join('follow f','u.id=f.uid')->where('username',$data['username'])->column('f.fid');
		$fol = db('follow')->where('uopenid',$data['openid'])->select();
		echo json_encode($fol,JSON_UNESCAPED_UNICODE);
	}
	public function pass(){
		$data = input('param.');
		//$fol = db('user')->alias('u')->join('follow f','u.id=f.fid')->where('username',$data['username'])->column('f.uid');
		$fol = db('follow')->where('fopenid',$data['openid'])->select();
		echo json_encode($fol,JSON_UNESCAPED_UNICODE);
	}
	public function guan(){
		$openid = input('openid');
		$id = input('id');
		$data = db('follow')->where('uopenid',$openid)->column('fopenid');
		$data2 = db('article')->where('id',$id)->value('openid');
		$a = "";
		if(in_array($data2, $data))
		{
			$a = "true";
		}else if($openid==$data2){
			$a = "0";
		}else{
			$a = "false";
		}
		echo json_encode($a,JSON_UNESCAPED_UNICODE);
	}
	public function add(){
		$uopenid = input('uopenid');
		$fopenid = input('fopenid');
		$now_time= time();
		$now_date= date('Y-m-d',$now_time);
		$data = [
			'uopenid'=>$uopenid,
			'fopenid'=>$fopenid,
			'data'=>$now_date
		];
		if(db('follow')->insert($data))
		{
			$a = "true";
		}else{
			$a = "false";
		}
		echo json_encode($a,JSON_UNESCAPED_UNICODE);
	}
	public function del(){
		
		$fopenid = input('fopenid');
		
		if(db('follow')->where('fopenid',$fopenid)->delete())
		{
			$a = "false";
		}else{
			$a = "true";
		}
		echo json_encode($a,JSON_UNESCAPED_UNICODE);
	}
}
?>