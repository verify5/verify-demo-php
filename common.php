<?php
//验证Host，请在控制台获取
define("URL","http://free7jysj6c2.verify5.com") ;

//获取毫秒的时间戳
function get_millisecond(){
    list($t1,$t2) = explode(' ',microtime());
    $time = ceil(($t1 + $t2) * 1000);
    return $time;
}
//签名
function sign($data){
    //加签字符串,key1value1key2value2...[APPkEY]
    $signStr = "" ;
    foreach($data as $key => $value){
        $signStr = $signStr.$key.$value ;

    }
    $signStr = $signStr.APPKEY ;
    $signStr = md5($signStr);
    return $signStr ;
}
//https请求
function curl_get_https($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  // 跳过检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 跳过检查
    $tmpInfo = curl_exec($curl); 
    curl_close($curl);
    return $tmpInfo;   //返回json对象
}
?>
