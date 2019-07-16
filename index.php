<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 18:10
 */

//load Default Info
require_once "./common.php";

//url 읽어서 모듈 로드
if(isset($_GET['mid'])){
    $module = $_GET['mid'];
}else{
    $module = "page";
}

if(isset($_GET['act'])){
    $act = $_GET['act'];
}else{
    $act = "index";
}

if(isset($_GET['document_srl'])){
    $document_srl = $_GET['document_srl'];
}else{
    $document_srl = false;
}

//모듈 런
$function_name = $act;
$call_file = sprintf(_XISO_PATH_ . "/modules/%s/%s.php",$module,$module);
if(file_exists($call_file)){
    require_once $call_file;

    $moduleFile = $module."View";

    $object = new $moduleFile();

    if(method_exists($object, $function_name)){
        $args = (object) $_REQUEST;
        unset($args->act);
        unset($args->module);

        $output = $object->$function_name($args);
    }
}else{
    set_error("존재하지 않는 모듈입니다.");
}

//레이아웃 로드
$layout_info = new stdClass();
loadLayout($site_info->layout);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8" />
    <meta name="Generator" content="XISO" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title><?=$site_info->title?></title>
    <link rel="alternate" type="application/rss+xml" title="Site RSS" href="//<?=$site_info->domain?>/rss" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="canonical" href="<?=$site_info->domain?>" />

    <meta name="keywords" content="<?=$site_info->keyword?>" />
    <meta name="description" content="<?=$site_info->desc?>" />
    <meta name="author" content="<?=$site_info->title?>">
    <meta name="Robots" content="ALL">
    <meta name="robots" content="index,follow">
    <meta name="GOOGLEBOT" content="index, follow">

    <meta property="og:locale" content="ko_KR" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?=$site_info->domain?>" />
    <meta property="og:site_name" content="<?=$site_info->title?>" />
    <meta property="og:title" content="<?=$site_info->title?>" />
    <meta property="og:description" content="<?=$site_info->desc?>" />

    <link rel="icon" type="image/png" href="/favicon.ico">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <?php if($api_key["google_gtag"]){ ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$api_key["google_gtag"]?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?=$api_key["google_gtag"]?>');
    </script>
    <?php } ?>
<?php
    //JS용 전역변수 정의.
    print '<script type="text/javascript">';
    foreach($add_global_var as $key => $val){
        sprintf('var %s = "%s";',$key,$val);
    }
    print '</script>';

    //모듈에서 추가한 헤더 출력
    if(isset($add_html_header)){
        foreach($add_html_header as $val){
            echo $val;
        }
    }
?>
</head>
<body class="<?=join(" ",$add_body_class);?>">
<?php
    include $layout_info->path . "header.php";

    if($output->error < 0){
        set_error($output->message);
        include _XISO_PATH_ . "/oPage/_error.php";
    }else if(file_exists(_XISO_PATH_ . "/oPage/".$set_template_file)){
        include _XISO_PATH_ . "/oPage/".$set_template_file;
    }else{
        include _XISO_PATH_ . "/oPage/404.html";
    }

    include $layout_info->path . "footer.php";

    //하단부 출력
    foreach($add_html_footer as $val){
        echo $val;
        echo "\n";
    }



//모듈에러가 아닌데 메세지가 있는경우 alert 호출
if($_XISO_MESSAGE_){
?>

    <script type="text/javascript">
    jQuery(document).ready(function($){
        toastr.options = {
            "progressBar" : true,
            "timeOut" : 5000,
            "positionClass" : "toast-bottom-right"
        }

        <?php if($_XISO_ERROR_ == "danger") {?>
        toastr.error('<?=$_XISO_MESSAGE_?>');
        <?php }else{ ?>
        toastr.success('<?=$_XISO_MESSAGE_?>');
        <?php } ?>

    });
    </script>

<?php
}
?>
</body>
</html>
