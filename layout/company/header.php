<style media="screen">
  .no_notice{
    text-align: center;
    margin-top: 65px;
    padding: 0;
  }
  .bell{
    width: 40px;
    margin-bottom: 30px;
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
                <li class="nav-item xs_content active weight_normal"><a id="open_notice" class="nav-link" style="cursor:pointer"><img src="/oPage/images/imgicons/bell.png" class="imgicon pt-1" height="18" /></a></li>
                <div class="notice_menu" uib-dropdown-menu="" aria-labelledby="simple-dropdown">
                  <?php if(!$output->get("member_notice")){?>
                    <ul class="no_notice">
                      <img src="/oPage/images/notification.png" class="bell" alt="">
                      <p>오늘은 알림이 없어요</p>
                    </ul>
                  <?}else{?>
                  <?php foreach($output->get("member_notice") as $val){
                    $reg_time = $val['reg_date'];

                    //알림 발생 시간
                    $reg_y = date("Y", strtotime($reg_time));
                    $reg_m = date("m", strtotime($reg_time));
                    $reg_d = date("d", strtotime($reg_time));
                    $reg_H = date("H", strtotime($reg_time));
                    $reg_i = date("i", strtotime($reg_time));

                    $reg_hour = $reg_y.".".$reg_m.".".$reg_d." ";
                    if($reg_H > 12){
                      $reg_H -= 12;
                      $reg_hour .= "오후";
                    }else{
                      $reg_hour .= "오전";
                    }

                    $reg_hour .= $reg_H."시".$reg_i."분";
                    ?>
                  <ul class="notification-list" ng-if="feeds" onclick="See_more(<?=$val['mn_idx'].",".$val['n_idx'].",".$val['num']?>)">
                    <li ng-repeat="feed in feeds" ng-class="{'unread' : feed.status != 'R'}" class="ng-scope unread">
                      <div class="n_status">
                        <div class="n_img">
                          <img src="/oPage/images/notification.png">
                        </div>
                      </div>
                      <div class="n_text">
                        <p ng-bind-html="feed.message" class="ng-binding">
                          <?if($val['n_idx']==1){?>
                          <span class="red">[<?=$val['notice_type']?>발생]</span>[<?=$val['h_title'];?>]공고에 <b><?=$val['notice_type']?></b> 가 발생</span>했습니다. 확인해보세요!
                          <?}else if($val['n_idx']==4){?>
                            <span class="red">[<?=$val['notice_type']?>]</span><span style="font-weight:500">해당 공고가 종료되었습니다.</span>[<?=$val['h_title'];?>]
                          <?}?></p>
                        <span class="n_rdate"><?=$reg_hour?></span>
                      </div>
                  </li>
                </ul>
              <? } } ?>
                <ul class="notification-list">
                  <span class="btn-round btn btn-warning btn-xxs mb-2">주의사항</span>
                  <p class="xs_content content_padding py-0">알림메세지는 7일동안 보관되며 확인 여부와 상관없이 리스트에서 자동으로 삭제됩니다.</p>
                </ul>
              </div>

            </ul>
        </nav>
    </div>
    <hr class="p-0 m-0" />
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?=getUrl('company')?>"><img src="/oPage/images/logo_blue.png" height="40" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <?php
                    foreach($oMenu->company->list as $key => $item){
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
<header id="header_mobile" class="d-lg-none">
    <div class="overlay" data-toggle="offcanvas" style="display: none;"></div>
    <div id="sidebar-wrapper" class="position-relative">
        <div class="sidebar-card">

            <div class="px-3 py-2">
            <div class="row">
                <?php if(!$logged_info) { ?>
                <div class="col-12">
                    <h5 class="weight_normal mb-1 mt-2">로그인 해 주세요 :)</h5>
                </div>
                <?php } ?>

                <?php if($logged_info) { ?>
                    <div class="col-4">
                        <div class="avatar square" style="background-image:url('/layout/none/assets/images/no_company.png');"></div>
                    </div>
                    <div class="col-8">
                        <h5 class="weight_normal mb-1 mt-2"><?=$logged_info['c_name']?> 님</h5>
                        <h5 class="weight_lighter mt-0">환영합니다.</h5>
                    </div>
                <?php } ?>
            </div>
            </div>
            <div class="btn-group rounded-0 btn-block mt-2">
                <?php
                    foreach($oMenu->common->list as $item){
                        echo sprintf('<a href="%s" %s class="btn btn-primary">%s</a>', $item["link"], $item["new_window"],$item["title"]);
                    }
                ?>
            </div>
        </div>
        <aside class="nav flex-column">
            <?php
            foreach($oMenu->company->list as $item){
                if(is_array($item["submenu"])){
                    $item["link"] = "#";
                }
                if($item["icon"]){
                    echo sprintf('<a class="nav-link weight_normal mt-2 %s" href="%s" %s><i class="%s"></i> %s',$item["active"],$item["link"],$item["new_window"],$item["icon"],$item["title"]);
                }else if($item['imgicon']){
                    echo sprintf('<a class="nav-link weight_normal mt-2 %s" href="%s" %s><img src="/oPage/images/imgicons/%s.png" class="imgicon" height="16" /> %s',$item["active"],$item["link"],$item["new_window"],$item["imgicon"],$item["title"]);
                }
                if(is_array($item["submenu"])){
                    echo '<span class="pull-right text-black-50 has_submenu"><i class="xi-angle-right"></i></span>';
                }
                echo "</a>";
                if(is_array($item["submenu"])){
                    echo "<ul class=\"nav submenu\" style='display:none;'>";
                    echo "<li class=\"nav-item\">";
                    foreach($item["submenu"] as $sub_item){
                        echo sprintf("<a class=\"nav-link  text-secondary\" href=\"%s\" %s>- %s</a>",$sub_item["link"], $sub_item["new_window"], $sub_item["title"]);
                    }
                    echo "</li>";
                    echo "</ul>";
                }
            }
            ?>
        </aside>
        <div class="position-absolute bg-light p-3" data-toggle="offcanvas" style="bottom:0; left:0; width:100%;">
            <i class="xi-arrow-left"></i> 뒤로가기
        </div>
    </div>
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg bg-white">
            <a class="navbar-brand mx-auto" href="<?=getUrl('company')?>">기술자숲</a>
        </nav>
        <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        <?php if($logged_info) { ?>
        <a href="<?=getUrl('ncenter')?>" class="toggle_alert">
            <img src="/oPage/images/imgicons/bell_white.png" class="white"/>
            <img src="/oPage/images/imgicons/bell.png" class="black"/>
            <span id="notice_count" class="badge bg-red"><?=count($output->get("member_notice"))?></span>
        </a>
        <?php } ?>
    </div>
</header>
<?php if($logged_info) { ?>
    <a href="<?=getUrl('ncenter')?>" class="noheader_alert toggle_alert">
        <img src="/oPage/images/imgicons/bell_white.png" class="white"/>
        <img src="/oPage/images/imgicons/bell.png" class="black"/>
        <span id="notice_count" class="badge bg-red"><?=count($output->get("member_notice"))?></span>
    </a>
<?php } ?>
<?php
// 액트가 index이면 모듈명을 참조
$file_name = ($act != "index") ? $act : $module;
$bg_url = "/oPage/company/visual/" . $file_name . ".jpg";
$no_auto_bg_url = "/oPage/company/visual/" . $file_name . ".noauto.jpg";
$mobile_bg_url = "/oPage/company/visual/" . $file_name . ".mobile.jpg";

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
<script type="text/javascript">
  function See_more(mn_idx,n_idx,num){
    var params = {};
    params['mn_idx'] = mn_idx;
    params['n_idx'] = n_idx;
    params['num'] = num;

    exec_json("ncenter.see_more",params,function(ret_obj){
      if(ret_obj.error!=0){
        toastr.success(ret_obj.message);
      }else{
        location.href = ret_obj.message;
      }


    });

  }
  $("#open_notice").click(function(){
    if($('.notice_menu').css("display")=='none'){
      $('.notice_menu').css("display","block");
    }else{
      $('.notice_menu').css("display","none");
    }
  });
</script>
