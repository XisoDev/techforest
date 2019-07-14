<?php

require_once('./common.php');

$output = new stdClass();

$request = file_get_contents("php://input");

parse_str($request,$args);
$args = (object)$args;

if($args->act && $args->module){

    $module = $args->module;
    $function_name = $args->act;

    if($args->is_view == "Y") {
        $call_file = sprintf(_XISO_PATH_ . "/modules/%s/%s.php", $module, $module);
    }else{
        $call_file = sprintf(_XISO_PATH_ . "/modules/%s/%s.controller.php", $module, $module);
    }

    if(file_exists($call_file)){
        require_once $call_file;

        if($args->is_view == "Y") {
            $moduleFile = $module."View";
        }else{
            $moduleFile = $module."Controller";
        }

        $object = new $moduleFile();

        if(method_exists($object, $function_name)){
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

echo json_encode($output);