<!DOCTYPE html>
<html>
<body>
<?php
include "common.php";
//以下信息请登录控制台获取
define("APPKEY", "f8dc18de340345188d5ddfc9e286c17d") ;
define("TOKEN","e76091f7f88a4f26866f8eef16576712");
//前端生成的uuid传入
define("VEIFYID","a32cb10a204c938c9beaad5ba3bb0ffd");
/**
 * 网站后台校验
 * 入参：
 * $data 传入的参数
 * $sign_str 签名信息
 * 出参：
 *   返回的json
 */
function verify($data,$sign_str){
    //请求url完整目录
    $http_url = URL."/openapi/verify?signature=".$sign_str ;
    //请求字符串
    foreach($data as $key => $value){
        $http_url = $http_url."&".$key."=".$value ;
    }
    $response_data = curl_get_https($http_url) ;
    return $response_data ;
}


/**
 * 以下取verify5验证信息
 * verifyid 即前端用户验证生成的的uuid 
 * timestamp 当前时间,单位毫秒
 */
$cur_time = (string)get_millisecond() ;
$data = array("token"=>TOKEN,"timestamp"=>$cur_time,"verifyid"=>VEIFYID);
ksort($data) ;
//生成签名
$sign_str = sign($data) ;
$response_data = verify($data, $sign_str) ;
echo "verify返回结果:".$response_data ;
?>
</body>
</html>