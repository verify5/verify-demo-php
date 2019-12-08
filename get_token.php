<!DOCTYPE html>
<html>
<body>

<?php
include 'common.php';
//以下信息请登录控制台获取
define("APPKEY", "f8dc18de340345188d5ddfc9e286c17d") ;
define("APPID","d16ac3ba002c402b87f6dc62aada76d8") ;
/**
 * 更新token信息，传入
 * 入参：
 * $data 传入的参数
 * $sign_str 签名信息
 * 出参：
 *   返回的json
 */
function get_token($data,$sign_str){
    //请求url完整目录
    $http_url = URL."/openapi/getToken?signature=".$sign_str ;
    //请求字符串
    foreach($data as $key => $value){
        $http_url = $http_url."&".$key."=".$value ;
    }
    $response_data = curl_get_https($http_url) ;
    return $response_data ;
}


/**
 * 以下取getToken信息
 * expiredIn 为可选信息,单位毫秒 ,默认有效期30天
 * timestamp 当前时间,单位毫秒
 */
$cur_time = (string)get_millisecond() ;
$data = array("appid"=>APPID,"timestamp"=>$cur_time,"expiredIn"=>"3600000");
ksort($data) ;
//生成签名
$sign_str = sign($data) ;
$response_data = get_token($data, $sign_str) ;
echo "返回结果:".$response_data ;
?>
</body>
</html>