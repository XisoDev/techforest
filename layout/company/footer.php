<?php

if(!isset($footer_false)){
    echo "<div style=\"height:50px;\"></div>";
}
?>

<footer class="d-none d-sm-block">
    <div class="container">
        <div class="row">
            <div class="col-3 pt-5">
<!--                logo ?-->

                <img src="/oPage/images/footer_logo_gray.png" height="60" />

            </div>
            <div class="col-9 pt-3">
                <h6 class="text-warning mt-4 mb-0 pt-0 pb-0">CONTACT</h6>
                <p class="text-light weight_lighter xs_content">
                    경남 창원시 마산회원구 봉암북7길 21, ICT 진흥센터 5동 607호<br />
                    <a class="text-light" href="tel:+82218009665">1800-9665</a> | <a class="text-light" href="tel:+8255-259-5315">055-259-5315</a>
                </p>

                <h6 class="text-warning mt-4 mb-0 pt-0 pb-0">COMPANY</h6>
                <p class="text-light weight_lighter xs_content">
                    상호 : 기술자숲 주식회사 | 사업자등록번호 : 592-81-00527 | 대표 <b class="weight_normal">공태영</b><br />
                    통신판매업 신고번호 : 2016-마산회원-0136호 | 직업정보제공사업 : 창원제 2016-3호
                </p>


                <h6 class="text-warning mt-4 mb-0 pt-0 pb-0">INFO</h6>
                <div class="pull-right">
                    <a href="https://www.facebook.com/gsjsoop/" target="_blank" class="text-light"><img src="/oPage/images/imgicons/facebook_gray.png" height="20" class="imgicon" /></a>
                    <span class="xxs_content px-3 text-light weight_lighter" style="vertical-align: 6px;">|</span>
                    <a href="http://blog.naver.com/gsjsoop" target="_blank" class="text-light"><img src="/oPage/images/imgicons/blog_gray.png" height="20" class="imgicon" /></a>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light m-0 p-0">
                <ul class="navbar-nav">
                    <?php
                    $key = true;
                    foreach($oMenu->footer->list as $item_key => $item){
                        if($key){
                            $add_class = "ml-0 pl-0";
                            $key = false;
                        }else{
                            $add_class = "";
                        }
                        echo sprintf('<li class="nav-item xs_content weight_normal"><a class="text-secondary nav-link %s" href="%s" %s>%s</a></li>',$add_class,$item["link"],$item["new_window"],$item["title"]);
                        if($item_key < count($oMenu->footer->list)-1){
                            echo "<li class=\"nav-item xs_content weight_normal\"><a class=\"text-secondary nav-link xs_content\">|</a></li>";
                        }
                    }
                    ?>
                    <?if($m_idx > 0){?>
                    <li class=\"nav-item xs_content weight_normal"><a class="text-secondary nav-link xs_content">|</a></li>
                    <li class="nav-item xs_content weight_normal"><a class="text-secondary nav-link" href="javascript:withdrawCompany();">회원탈퇴</a></li>
                    <?}?>
                </ul>
                </nav>

                <p class="text-secondary py-4">copyright c 기술자숲 주식회사 all right reserverd.</p>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
  function withdrawCompany(){
    var confirm_text = confirm("정말 회원탈퇴를 하시겠습니까?");
    if(confirm_text){
      var params = {};
      params["m_idx"] = <?=$m_idx?>;
      exec_json("company.withdrawCompany",params,function(ret_obj){
          toastr.success(ret_obj.message);
          location.reload();
    });
  }
  }
</script>
