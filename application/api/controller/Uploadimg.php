<?php
namespace app\api\controller;
use think\Request;

class Uploadimg{
	public function lst(){
		$file = request()->file('file');
        if ($file) {
            //info = $file->move('static/upload/weixin/');
            $info = $file->move(ROOT_PATH.'public'.DS.'static/upload/weixin');
            if ($info) {
                $file = $info->getSaveName();
                $res = ['errCode'=>0,'errMsg'=>'图片上传成功','file'=>$file];
                $path = 'http://127.0.0.1/nannan/public/static/upload/weixin/';
                return json($path.$file);
            }
		}
	}
}
?>