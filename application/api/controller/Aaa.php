<?php
namespace app\api\controller;

class Aaa{
    public function codd(){
        $this->getOpenid();
    }

    public function getOpenid() {
        $code = $_GET['code'];//小程序传来的code值
        $appid = 'wxbb9a19c179b7392d';//小程序的appid
        $appSecret = 'a2db33cd2545f71ae1f98a2ef1b28f27';// 小程序的$appSecret
        $wxUrl = 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code';
        $getUrl = sprintf($wxUrl, $appid, $appSecret, $code);//把appid，appsecret，code拼接到url里
        $result = $this->curl_get($getUrl);//请求拼接好的url
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            echo '获取openid时异常，微信内部错误';
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {//请求失败
                var_dump($wxResult);
            } else {//请求成功
                $openid = $wxResult['openid'];
                //session('openid',$openid);
                echo $openid;
            }
        }
    }
    //ofOua5fr-rK7RU-po5jYXDfyNWlI
    //php请求网络的方法
    public function curl_get($url, &$httpCode = 0) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //不做证书校验,部署在linux环境下请改为true
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $file_contents = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $file_contents;
    }
}


?>