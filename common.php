<?php

/*******************************************************************************
 ** 공통 변수, 상수, 코드
 *******************************************************************************/
error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );

// 보안설정이나 프레임이 달라도 쿠키가 통하도록 설정
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

//==========================================================================================================================
// extract($_GET); 명령으로 인해 page.php?_POST[var1]=data1&_POST[var2]=data2 와 같은 코드가 _POST 변수로 사용되는 것을 막음
// 081029 : letsgolee 님께서 도움 주셨습니다.
//--------------------------------------------------------------------------------------------------------------------------
$ext_arr = array ('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST',
    'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS',
    'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS');
$ext_cnt = count($ext_arr);
for ($i=0; $i<$ext_cnt; $i++) {
    // POST, GET 으로 선언된 전역변수가 있다면 unset() 시킴
    if (isset($_GET[$ext_arr[$i]]))  unset($_GET[$ext_arr[$i]]);
    if (isset($_POST[$ext_arr[$i]])) unset($_POST[$ext_arr[$i]]);
}
//==========================================================================================================================



define("_XISO_", TRUE);
@session_start();

if (!defined('_XISO_PATH_')){
    define('_XISO_PATH_', str_replace('common.php', '', str_replace('\\', '/', __FILE__)));
}

$domain = $_SERVER['HTTP_HOST'];

if($_SESSION['_XISO_MESSAGE_TYPE_']){
    $_XISO_ERROR_ = $_SESSION['_XISO_MESSAGE_TYPE_'];
    unset($_SESSION['_XISO_MESSAGE_TYPE_']);
}

if($_SESSION['_XISO_MESSAGE_']){
    $_XISO_MESSAGE_ = $_SESSION['_XISO_MESSAGE_'];
    unset($_SESSION['_XISO_MESSAGE_']);
}


//check Agents
$userAgent = $_SERVER["HTTP_USER_AGENT"];

//Check Mobile
$mAgent = array("iPhone","iPod","Android","Blackberry", 
    "Opera Mini", "Windows ce", "Nokia", "sony" );
$isMobile = false;
for($i=0; $i<sizeof($mAgent); $i++){
    if(stripos( $userAgent, $mAgent[$i] )){
        $isMobile = true;
        break;
    }
}

//Check IE
$is_IE = false;
$ua = htmlentities($userAgent, ENT_QUOTES, 'UTF-8');
if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0') !== false && strpos($ua, 'rv:11.0') !== false)) {
    $is_IE = true;
}

//사이트 기본정보 호출
require_once "./config/config.db.php";
require_once "./config/config.site.php";

//기본 클래스 호출
require_once "./inc/MysqliDb.php";
require_once "./inc/class.object.php";
require_once "./inc/class.page.php";
require_once "./inc/class.file.php";
require_once "./inc/func.date.php";
require_once "./inc/func.inc.php";

//$oDB = new MysqliDb($_db_config['host'], $_db_config['user_name'],$_db_config['password'],$_db_config['db'],$_db_config['port']);

//모듈로드전에 회원 세션을 정의
require_once "./modules/member/member.controller.php";
$oMember = new memberController();
if($_SESSION['LOGGED_INFO']){
    $logged_info = $oMember->getMemberInfoByMemberSrl($_SESSION['LOGGED_INFO']);
}else{
    $logged_info = false;
}

//모듈내에서 읽어올 변수들 미리생성
$add_html_header = array();
$add_html_footer = array();
$add_body_class = array();
$add_global_var = array();
$set_template_file = false;
$tpath = "/";
$is_dark = false;

if(isset($_GET['cur'])) $current_url = $_GET['cur'];
else $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

