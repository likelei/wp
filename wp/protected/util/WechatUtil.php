<?php
/**
 * wechat php test
 */
require_once dirname(__FILE__).'/../util/HttpClient.php' ;

//define your token
define("TOKEN", "ilovelei");
define("APPID","wx89e9ec1451fb0b79");
define("APP_SECRET","62d64b22ec213ce7580c374cefd3a037");
/**
 * 获取ACCESS_TOKEN的地址
 */
define("ACCESS_TOKEN_URL","https://api.weixin.qq.com/cgi-bin/token?".
        "grant_type=client_credential&secret=".APP_SECRET."&appid=".APPID);


class WechatUtil
{
    private static $_accessToken = null ;
    public static $_expireTime = 0 ;

    public static  function getAccessToken(){
        $now = time();
        Yii::log("存储的值为".WechatUtil::$_expireTime);
        if(empty(WechatUtil::$_accessToken)){
            return WechatUtil::$_accessToken;
        }
        if($now>=(int)WechatUtil::$_expireTime) {
            Yii::log("开始计算".ACCESS_TOKEN_URL);
            $result = HttpClient::get(ACCESS_TOKEN_URL);
            $result = json_decode($result);

            if(isset($result->access_token)){
                WechatUtil::$_accessToken =$result->access_token;
                WechatUtil::$_expireTime = ($now-60)+(int)$result->expires_in *1000 ;
                Yii::log("new time=".WechatUtil::$_expireTime."  and now time =".$now);
            }
        }
        return WechatUtil::$_accessToken;
    }

 }


?>