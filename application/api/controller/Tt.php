<?php
namespace app\api\controller;
use think\Request;

class Tt{
	public function lst(){
		//$concent = input('concent');
		$file = request()->file('file');
		$concent = input('txt');
		$cba = "威威";
        if ($file) {
            $info = $file->move('static/upload/weixin/');
            if ($info) {
                $file = $info->getSaveName();
                $res = ['errCode'=>0,'errMsg'=>'图片上传成功','file'=>$file];
                $srr = str_replace('\\', '/', $res['file']);
                $aa = "https://hungking.top/nannan/public/static/upload/weixin/".$srr;
                $cc = stripslashes($aa);
                $data = [
                	'txt' => $concent,
                	'img' => $cc,
                ];
                db('test')->insert($data);
                echo json_encode($concent,JSON_UNESCAPED_UNICODE);
            }
        }
	}
	public function lstat(){
		$all = input('param.');
		$file = request()->file('file');
        if ($file) {
            $info = $file->move('static/upload/weixin/');
            if ($info) {
                $file = $info->getSaveName();
                $res = ['errCode'=>0,'errMsg'=>'图片上传成功','file'=>$file];
                $srr = str_replace('\\', '/', $res['file']);
                $aa = "https://hungking.top/nannan/public/static/upload/weixin/".$srr;
                $cc = stripslashes($aa);
                $data = [
                	'txt' => $all['concent'],
                	'img' => $all['img'],
                ];
                db('test')->insert($data);
                echo json_encode($all['concent']);
            }
        }
	}
}

?>