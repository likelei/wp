<?php
require_once dirname(__FILE__).'/../util/WechatUtil.php' ;
require_once dirname(__FILE__).'/../util/LogUtil.php' ;

class HomeController extends Controller
{

	public function actionIndex()
	{

        LogUtil::accessLog();
        if(isset($_GET["echostr"])){
            $echoStr = $_GET["echostr"];
            //valid signature , option
            if(self::checkSignature()){
                echo $echoStr;
                exit;
            }else{
                echo "if fails";
            }
        }else{
            $this->responseMsg();
        }
    }


    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr =   isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"]:"";
        Yii::log("post data is=$postStr");
        //extract post data
        if (!empty($postStr)){

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $msgType = $postObj->MsgType;

            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
             $msgType = "text";
             $contentStr = WechatUtil::getAccessToken();
             $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
             echo $resultStr;

        }
    }


    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

}