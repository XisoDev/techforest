<style>
    body{
        background:#fff;
    }
</style>
<header id="header_pc" class="d-none d-lg-block">
    <div class="container py-0 my-0">
        <nav class="navbar navbar-expand-lg navbar-light m-0 p-0">
            <ul class="navbar-nav ml-auto">
                <?php
                $key = true;
                foreach($oMenu->common->list as $item){
                    echo sprintf('<li class="nav-item xs_content weight_normal %s"><a class="nav-link" href="%s" %s>%s</a></li>',$item["active"],$item["link"],$item["new_window"],$item["title"]);
                    if($key){
                        echo "<li class=\"nav-item xs_content weight_normal\"><a class=\"nav-link xs_content\">|</a></li>";
                        $key = false;
                    }
                }
                ?>
                <li class="nav-item xs_content active weight_normal"><a class="nav-link" href="#"><img src="/oPage/images/imgicons/bell.png" class="imgicon pt-1" height="18" /></a></li>
            </ul>
        </nav>
    </div>
    <hr class="p-0 m-0" />
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?=getUrl('company')?>"><img src="/oPage/images/logo.png" height="40" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <?php

                    //유저타입읽어서 메뉴변경
                    if($_SESSION["USER_TYPE"] == "company"){
                        $main_menu = $oMenu->company->list;
                    }else{
                        $main_menu = $oMenu->technician->list;
                    }
                    foreach($main_menu as $key => $item){
                        if(!is_array($item["submenu"])) {
                            echo sprintf('<li class="nav-item px-2 weight_normal %s"><a class="nav-link" href="%s" %s>%s', $item["active"], $item["link"], $item["new_window"], $item["title"]);
                        }else{
                            echo sprintf('<li class="nav-item dropdown px-2 weight_normal %s"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-%s" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> %s', $item["active"], $key, $item["title"]);
                        }
                        echo "</a>";
                        if(is_array($item["submenu"])){
                            echo " <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown-{$key}\">";
                            foreach($item["submenu"] as $sub_item){
                                echo sprintf("<a class=\"dropdown-item\" href=\"%s\" %s>%s</a>",$sub_item["link"], $sub_item["new_window"], $sub_item["title"]);
                            }
                            echo "</div>";
                        }
                        echo "</li>";
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</header>

<?php
//none 레이아웃은 해당 모듈내의 비주얼폴더를 참조하도록 함
$bg_url = "/oPage/" . $module . "/visual/" . $act . ".jpg";
$no_auto_bg_url = "/oPage/" . $module . "/visual/" . $act . ".noauto.jpg";
$mobile_bg_url = "/oPage/" . $module . "/visual/" . $file_name . ".mobile.jpg";


if(file_exists(_XISO_PATH_ . $bg_url) && !$output->get('false_sub_visual')) {
    ?>
    <section class="sub_visual d-none d-lg-block" style="background-image:url('<?=$bg_url?>');">
        <h4><?=$site_info->title?></h4>
        <hr style="width:50px;" class="mx-auto border-white" />
        <p class="weight_lighter"><?=$site_info->desc?></h4></p>
    </section>
    <?php
}
?>