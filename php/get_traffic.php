<?
$url = basename($_SERVER["PHP_SELF"]);
$date = date("Y-m-d H:i:s", time());
$ref = $_REQUEST["ref"];

// $checkExit: 사이트 최초 접속시 새로고침 OR history 이동 체크
$checkExit = $_POST["exit"];
// $referer: 사이트 이동 유무 체크
$referer = $_SERVER['HTTP_REFERER'];
$ip = $_SERVER['REMOTE_ADDR'];


if(strpos($referer, "gsjsoop.com")){
} else {
  if(!$ref){
    $ref = "log";
  }
  $sql = "INSERT INTO TF_log(type, message, reg_date, ip_type) VALUES('$url', '$ref', '$date', '$ip')";
  $res = mysql_query($sql);
}
?>
