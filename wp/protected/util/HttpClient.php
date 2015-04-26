<?php
/**
 * Created by PhpStorm.
 * User: lkl
 * Date: 2015/4/20
 * Time: 23:36
 */
class HttpClient{
    public  static function get($url){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT,6*100);
        curl_setopt($ch, CONNECTION_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output ;
    }
}