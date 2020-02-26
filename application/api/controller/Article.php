<?php
namespace app\api\controller;
use think\Request;

class Article{
	public function lst(){
		$cate_id = input('id')+1;
		//$data = db('article')->where('cate_id',$cate_id)->select();
		//$data = db('article')->alias('a')->join('cate c','c.id=a.cate_id')->where('cate_id',$cate_id)->field(['a.id','c.catename','c.id'])->select();
		$data = db('article')->alias('a')->join('cate c','a.cate_id=c.id','right')->where('cate_id',$cate_id)->field(['a.*','c.catename','c.id as cid'])->select();
		for($i=0;$i<count($data);$i++)
		{
			$num = db('commen')->where('art_id',$data[$i]['id'])->count();
			$data[$i]['com'] = $num;
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
	public function lstt(){
		
		$data = db('article')->select();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
	public function arti_det(){
		$id = input('id');
		$data = db('article')->alias('a')->join('cate c','a.cate_id=c.id','right')->where('a.id',$id)->field(['a.*','c.catename','c.id as cid'])->select();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
	public function add(){
		$file = request()->file('file');
		$all = input('param.');
		$now_time= time();
		$now_date= date('Y-m-d',$now_time);
        if ($file) {
            $info = $file->move('static/upload/weixin/');
            if ($info) {
                $file = $info->getSaveName();
                $res = ['errCode'=>0,'errMsg'=>'图片上传成功','file'=>$file];
                $srr = str_replace('\\', '/', $res['file']);
                $aa = "http://127.0.0.1/nannan/public/static/upload/weixin/".$srr;
                $cc = stripslashes($aa);
                $data = [
                	'username'=>$all['username'],
                	'openid'=>$all['openid'],
                	'user_id'=>'0',
                	'picture'=>$all['picture'],
                	'content' => $all['txt'],
                	'pic' => $cc,
                	'cate_id'=>$all['cateid'],
                	'data'=>$now_date
                ];
                db('article')->insert($data);
                echo json_encode($all['username'],JSON_UNESCAPED_UNICODE);
            }
        }

	}
}
?>