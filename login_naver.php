<?php

  require_once('./common.php');
	$type=	$_REQUEST["type"];

	$code=	$_REQUEST["code"];
	$state=	$_REQUEST["state"];

	// 네이버 로그인 콜백 예제
	$client_id = "cXstjgkmgg8Oiz8d7zHx";
	$client_secret = "i6G7wCnYBe";
	$code = $_GET["code"];
	$state = $_GET["state"];
  $redirectURI = urlencode("http://127.0.0.1:8080/company");
  $url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $response = curl_exec($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  // echo "status_code:".$status_code."";
  curl_close($ch);
  if($status_code == 200) {

		$json = json_decode($response);
		//echo "access_token = " . $json["access_token"] . "<br />";
		//echo "refresh_token = " . $json["refresh_token"] . "<br />";
		//echo "token_type = " . $json["token_type"] . "<br />";
		//echo "expires_in = " . $json["expires_in"] . "<br />";

		$token = $json->{'access_token'};
		$header = "Bearer ".$token; // Bearer 다음에 공백 추가
		$url = "https://openapi.naver.com/v1/nid/me";
		$is_post = false;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, $is_post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		$headers[] = "Authorization: ".$header;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// echo "status_code:".$status_code."<br>";
    // echo "response:".$response."<br>";

		curl_close ($ch);
    if($status_code == 200) {
      $output = new stdClass();

      if(!isset($args)) $args = new stdClass();
        $json = json_decode($response);
        $json = $json->{'response'};
          if($type == 1) {
            $is_commerce	= "N";
          } else if($type == 2) {
            $is_commerce	= "Y";
          }

    		$id				=  $json->{"id"};
    		$id = "n".$is_commerce . "_" . $id;
    		$birthday	= $json->{"birthday"};
    		$gender		= $json->{"gender"};
    		$email		= $json->{"email"};
    		$name			= $json->{"name"};

    		$birthday = str_replace("-", "", $birthday);
        $birthday = "0000".$birthday;
        $args2 = array( "id" => $id,
                  "birthday" => $birthday,
                  "gender" => $gender,
                  "email" => $email,
                  "name" => $name,
                  "is_commerce" => $is_commerce,
                 );
         // echo "id:".$id."<br>birthday:".$birthday."<br>gender:".$gender."<br>email:".$email;
        $module = "member";
        $function_name = "procNaverLogin";

        $call_file = sprintf(_XISO_PATH_ . "modules/%s/%s.controller.php",$module,$module);

        if(file_exists($call_file)){
            require_once $call_file;

            $moduleFile = $module."Controller";
            $object = new $moduleFile();

            if(method_exists($object, $function_name)){
                $args = (object) $_REQUEST;

                $output = $object->$function_name($args,$args2);
            }else{
              $output = new Object(-1, "잘못된 요청입니다." . $object . " - " . $function_name);
            }
        }else{
          $output = new Object(-1, "존재하지 않는 모듈입니다.");
        }

    $output->setSession();

    if($output->error == 0){
        $return_url = $_REQUEST['success_return_url'];
        if(!$return_url) $return_url = $output->success_return_url;
    }else{
        $return_url = $_REQUEST['error_return_url'];
        if(!$return_url) $return_url = $output->error_return_url;
    }
    if(!$return_url) $return_url =  $_SERVER['HTTP_REFERER'];
      header('Location: ' . $return_url);
    } else {
      header('Location: ' . getUrl('member','login'));
    }
  } else {
    header('Location: ' . getUrl('member','login'));
  }
?>
