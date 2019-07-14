<?php

require_once('./common.php');

$output = new stdClass();

if(isset($_REQUEST['act'])){
    if(!isset($args)) $args = new stdClass();

    $action = explode(".",$_REQUEST['act']);
    $module = $action[0];
    $function_name = $action[1];

    $call_file = sprintf(_XISO_PATH_ . "/modules/%s/%s.controller.php",$module,$module);

    if(file_exists($call_file)){
        require_once $call_file;

        $moduleFile = $module."Controller";
        $object = new $moduleFile();

        if(method_exists($object, $function_name)){
            $args = (object) $_REQUEST;
            unset($args->act);
            unset($args->module);

            $output = $object->$function_name($args);
        }else{
            $output = new Object(-1, "잘못된 요청입니다." . $object . " - " . $function_name);
        }
    }else{
        $output = new Object(-1, "존재하지 않는 모듈입니다.");
    }
}else{
    $output = new Object(-1, "응답할 데이터가 없습니다.");
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
