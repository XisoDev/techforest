<?

$rows = $output->get('row');

?>
<style media="screen">
  .reply_style1{
    color:#192b5f;
    border : solid 2px #192b5f;
    padding : 5px 7px;
    border-radius: 20px;
  }

  .reply_style2{
    color:#ffffff;
    border : solid 1px #192b5f;
    background-color: #192b5f;
    padding : 5px 7px;
    border-radius: 20px;
  }

  .a{
    display:none;
  }


</style>
<link rel="stylesheet" href="/layout/company/assets/default.css">
<link rel="stylesheet" href="/layout/none/vendor/bootstrap/bootstrap.min.css">

<section class="bg-white">
    <div class="p-3 mt-4 pt-5 d-lg-none">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">문의하기</h5>
    </div>
    <div class="container pt-lg-5 col-md-8 col-lg-6 col-xl-4 mx-auto">
    <ul class="nav nav-tabs nav-justified mt-0 pt-0 mb-3 mb-md-5 mx-0 px-0" role="tablist">
        <li class="nav-item py-2 position-relative">
            <a class="nav-link weight_bold xs_content" href="<?=getUrl('contact')?>">
                문의하기
            </a>
        </li>
        <li class="nav-item py-2 position-relative active">
            <span class="badge badge-danger weight_lighter btn-round position-absolute" style="top:5px; right:10px; padding:2px 5px; font-size:9px;">NEW</span>
            <a class="nav-link weight_bold py-2 xs_content" href="<?=getUrl('contact','replies')?>">
                내 문의 답변
            </a>
        </li>
    </ul>
    <div class="p-2 mt-0 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12 mx-0 px-0 pl-1 mb-2">
                  <table id="question" class="table table-hover col-xs-12 float_none">
                  		<tbody>
                  				<tr>
                  					<th class="col-xs-2 col-sm-1 col-md-2" style="border-top: 3px solid black;">번호</th>
                  					<th class="col-xs-7 col-sm-9 col-md-7" style="border-top: 3px solid black;">제목</th>
                  					<th class="col-xs-4 col-sm-2 col-md-3" style="border-top: 3px solid black;">작성일</th>
                            <th class="col-xs-4 col-sm-2 col-md-3" style="border-top: 3px solid black;">답변여부</th>
                  				</tr>

                            <?foreach ($rows as $key => $val) {?>
                              <tr class="on">
                                <td style="vertical-align:middle;"><?=$key+1?></td>
                                <td style="vertical-align:middle"><?=$val['title']?></td>
                                <td style="vertical-align:middle"><?=substr($val['reg_date'],0,10)?></td>
                                <td style="vertical-align:middle">
                                  <?if(!$val['r_idx']){?>
                                    <spen class="reply_style1">답변대기</spen>
                                  <?}else{?>
                                    <spen class="reply_style2">답변완료</spen>
                                  <?}?>
                                </td>
                              </tr>
                              <div class="" style="display:none">
                                <tr class="a" style="background-color :#F2F2F2;">
                                  <td colspan="4" style="padding:20px;">
                                    <p>
                                      <span class="weight_bold" style="color:#192b5f">[문의내용]</span><br>
                                      <span><?=$val['content']?></span>
                                    </p>
                                    <br>
                                    <p>
                                      <span class="weight_bold" style="color:#192b5f">[답변]</span><br>
                                      <span>
                                        <?if(!$val['reply_content']){?>
                                          등록된 답변이 없습니다.
                                        <?}else{?>
                                          <?=$val['reply_content']?>
                                        <?}?>
                                      </span>
                                    </p>
                                  </td>
                                </tr>
                              </div>

                            <?}?>
                  	</tbody>
                  </table>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
// html dom 이 다 로딩된 후 실행된다.
$(document).ready(function(){
    // menu 클래스 바로 하위에 있는 a 태그를 클릭했을때
    $(".on").click(function(){
        var submenu = $(this).next("tr");

        // submenu 가 화면상에 보일때는 위로 보드랍게 접고 아니면 아래로 보드랍게 펼치기
        if( submenu.is(":visible") ){
            submenu.slideUp();
        }else{
            submenu.slideDown();
        }
    });
});


</script>
<?php
$footer_false = true;

?>
