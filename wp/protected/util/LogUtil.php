<?php

class LogUtil {

    public static  function  accessLog(){
        Yii::log(json_encode(self::getRequstheaders()));
    }

    public static function  getRequstheaders(){

        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;

    }
}

?>