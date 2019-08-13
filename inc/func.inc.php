<?php
if (!defined('_XISO_')) exit();

function createToken(){
    global $add_html_header;
    //페이지 토큰
    //토큰의 스텍을 쌓을만큼 쌓다가 토큰사용처에서 사용이 되고나면 그쪽 내부함수에서 초기화 해줌.
    if(!is_array($_SESSION['XISO_TOKEN_BEFORE'])){
        $_SESSION['XISO_TOKEN_BEFORE'] = array();
    }
    $_SESSION['XISO_TOKEN'] = bin2hex(openssl_random_pseudo_bytes(16));
    array_push($_SESSION['XISO_TOKEN_BEFORE'],$_SESSION['XISO_TOKEN']);
    $add_html_header[] = '<script type="text/javascript">var _xiso_token = "'.$_SESSION['XISO_TOKEN'].'";</script>';
}

function unsetToken(){
    unset($_SESSION['XISO_TOKEN_BEFORE']);
    unset($_SESSION['XISO_TOKEN']);
}

function loadLayout($layout = 'default'){
    global $layout_info;
    global $add_html_header;
    global $add_html_footer;
    global $add_body_class;
    global $add_global_var;
    global $tpath;

    $layout_info->path = sprintf(_XISO_PATH_ . '/layout/%s/',$layout);
    $tpath = sprintf("/layout/%s/",$layout);

    include $layout_info->path . "load.php";
}

function moduleLoadDefault($file_path = false){
    if(!$file_path) return;

    global $add_html_header;
    global $add_html_footer;
    global $add_body_class;
    global $add_global_var;

    $file_path = sprintf(_XISO_PATH_ . '/%s/',$file_path);

    include $file_path . "_load.php";
}

function set_message($message,$type = 'info'){
    global $_XISO_MESSAGE_;
    global $_XISO_ERROR_;

    $_SESSION['_XISO_MESSAGE_TYPE_'] = $type;
    $_SESSION['_XISO_MESSAGE_'] = $message;
    $_XISO_ERROR_ = $type;
    $_XISO_MESSAGE_ = $message;
}

function set_error($message){
    set_message($message,"danger");
}

function goLogin($prev_url = false){
    if(!$prev_url){
        global $current_url;
        $prev_url = $current_url;
    }
    $login_url = getUrl('member', 'login', false, array('cur' => $prev_url));
    header('Location: ' . $login_url);
}

function build_http_query( $query ){

    $query_array = array();

    foreach( $query as $key => $key_value ){

        $query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );

    }

    return implode( '&', $query_array );

}

function getUrl($mid = false, $act = false, $document_srl = false, $args = array()){
    global $site_info;
    $retUrl = $site_info->url . "/";
    if($mid){
        $retUrl = $retUrl . $mid . "/";
        if($act){
            $retUrl = $retUrl . $act . "/";

        }
    }

    if($document_srl){
        $retUrl = $retUrl . $document_srl . "/";
    }

    if(count($args)){
        $query = array();
        foreach($args as $key => $val){
            if(!$val) continue;
            $query[] = $key. "=" . urlencode($val);
        }
        $retUrl = $retUrl . "?" . join("&",$query);
    }

    return $retUrl;
}

function remoteFileExist($file_path) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$file_path);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(curl_exec($ch)!==false) {
        return $file_path;
    } else {
        return false;
    }
}

function getImgUrl($file_name){
    global $site_info;

    if ($file_name) {
        $img_url = $site_info->storage . "loan/" . $file_name;
    } else {
        $img_url = false;
    }
    return remoteFileExist($img_url);
}

function getModule($module,$type = 'view'){
    //모듈 런
    if($type == 'controller'){
        $call_file = sprintf(_XISO_PATH_ . "/modules/%s/%s.controller.php",$module,$module);
    }else{
        $call_file = sprintf(_XISO_PATH_ . "/modules/%s/%s.php",$module,$module);
    }

    if(file_exists($call_file)){
        require_once $call_file;

        if($type == 'controller') {
            $moduleFile = $module . "Controller";
        }else{
            $moduleFile = $module . "View";
        }
        return new $moduleFile();

    }else{
        return new Object("존재하지 않는 모듈입니다.");
    }
}

function setSEO($title, $description = false){
    global $site_info;

    //SET SEO
    $site_info->title_for_browser = $title . " - " . $site_info->title;
    $site_info->title = $title;
    $site_info->desc = ($description) ? $description : $site_info->desc;
}

function cut_str($string, $cut_size = 200, $tail = '...')
{
    $width = Array(0, 12, 4, 4, 4, 6, 6, 10, 8, 4, 5, 5, 6, 6, 4, 6, 4, 6,
        6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 4, 4, 8, 6, 8, 6, 12, 8, 8,
        9, 8, 8, 7, 9, 8, 3, 6, 8, 7, 11, 9, 9, 8, 9, 8, 8, 8, 8,
        8, 10, 8, 8, 8, 6, 11, 6, 6, 6, 4, 7, 7, 7, 7, 7, 3, 7,
        7, 3, 3, 6, 3, 11, 7, 7, 7, 7, 4, 7, 3, 7, 6, 10, 7, 7,
        7, 6, 6, 6, 9, 0);

    $str_buffer = "";
    $len_buffer = 0;
    $count = 0;

    $len = strlen($string);

    $cut_size = $width[1] * $cut_size / 2;

    while ($count < $len) {

        $asc = ord(substr($string, $count, 1));

        if ($asc < 128) {
            $len_buffer += $width[$asc - 30];

            if ($len_buffer > $cut_size) {
                $str_buffer .= "...";
                break;
            }

            $str_buffer .= substr($string, $count, 1);
            $count += 1;
        } else {
            $len_buffer += $width[1];

            if ($len_buffer > $cut_size) {
                $str_buffer .= "...";
                break;
            }

            $str_buffer .= substr($string, $count, 3);
            $count += 3;
        }
    }

    if ($tail) return "$str_buffer";
    else return $str_buffer . "";
}

function onlynumber($string){
    return preg_replace("/[^0-9]*/s", "", $string);
}

function mobile_format($string){
    return preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/", "$1-$2-$3", $string);
}

function change_price($str){
    if(!$str) return 0;

    $len = strlen($str);
    $div = floor($len/4);
    $per = $len%4;

    $res = Array();
    $com = Array("","만","억","조");
    $result = "";

    for($i=0; $i<$div; $i++){
        $res[$i] = substr($str,$len-($i*4+4),4);
    }

    if($per != 0){
        $res[count($res)] = substr($str,0,$per);
    }

    for($i=0; $i<count($res); $i++){
        if($res[$i] != 0) $res[$i] = number_format($res[$i]).$com[$i];
        else $res[$i] = "";
    }

    for($i=count($res); $i >=0; $i--) $result .= $res[$i];

    return $result;
}

function is_file_check($file_name, $type = "img"){

    $file_ext = explode(".", strrev($file_name));
    $file_ext = strrev($file_ext[0]);

    if(!$type or $type == 'img'){

        //타입이 이미지 경우
        $img_ok = array("gif", "png", "jpg", "jpeg", "bmp", "GIF", "PNG", "JPG", "JPEG", "BMP");
        if(!in_array($file_ext, $img_ok)) return false;
        else return true;

    } else {

        //갤러리 외의 타입은 웹 코드 파일을 막는다.
        $img_no = array("html", "htm", "php", "js", "jsp", "asp", "HTML", "HTM", "PHP", "JS", "JSP", "ASP");
        if(in_array($file_ext, $img_no)) return false;
        else return true;
    }
}
