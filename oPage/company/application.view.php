<?php
  $info_row = $output->get('app_info_row');
  $check_voucher = $output->get('check_voucher');
?>
<section class="content_padding mt-4 pt-5 bg-white">
    <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
    <h5 class="weight_normal">지원자정보 상세보기</h5>
</section>

<div class="container" style="position:relative; z-index:1;">
    <div class="content_padding px-0 pb-1">
        <h6>기본정보</h6>
        <div class="row">
            <div class="col-5 pt-4 pb-0 my-0 pl-4 mx-auto">
                <div class="avatar square" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                </div>
            </div>
        </div>
    </div>


    <div class="tech_card bg-white overflow-hidden pt-0 my-3">
        <span class="btn btn-block btn-warning mt-0 rounded-0 mb-3">책임감있는 열정적인 10년차 용접사!</span>
        <ul class="xs_content text-left">
            <li>이름 : <?=$info_row[0]['m_name']?>
              <?php
                if($info_row[0]["m_human"] == "M") {
                  echo "[남자]";
                } else if($info_row[0]["m_human"] == "F") {
                  echo "[여자]";
                } else {
                  echo "";
                }
              ?>
            </li>
            <li>생년월일 : <?= date("Y-m-d", strtotime($info_row[0]["m_birthday"])); ?></li>
            <li>주소 : <?=$info_row[0]['m_address']?> <?=$info_row[0]['m_address2']?></li>
            <?
              if(!empty($info_row[0]["desired_salary"]) || $info_row[0]["salary_idx"] == 0){
                if($info_row[0]["salary_name"] == "연봉" || $info_row[0]["salary_name"] == "월급"){
                  echo "<li>희망급여 : " .$info_row[0]['salary_name']." ".number_format($info_row[0]['desired_salary']). " 만원 이상</li>";
                }
                else if($info_row[0]["salary_name"] == "일급" || $info_row[0]["salary_name"] == "시급"){
                  echo "<li>희망급여 : " .$info_row[0]['salary_name']." ".number_format($info_row[0]['desired_salary']). " 원 이상</li>";
                }
                else if($info_row[0]["salary_idx"] == 0){
                  echo "<li>희망급여 : 회사내규에 따름</li>";
                }
              }
              ?>
            <li>희망직종 : 건설/조선</li>
        </ul>
    </div>


    <div class="tech_card bg-white overflow-hidden pt-0 my-3">
        <span class="btn btn-block btn-light mt-0 rounded-0 mb-3">경력간단요약</span>
        <p>성실한 10년차 용접사</p>
    </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3">
        <span class="btn btn-block btn-light mt-0 rounded-0 mb-3">학력</span>
        <ul class="xs_content text-left my-3">
            <li>학교 : ABCD 학교</li>
            <li>졸업연도 : 1999.02</li>
            <li>전공 : 금형,기계제조</li>
            <li>학점 : 4.21/4.5</li>
        </ul>
    </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3">
        <span class="btn btn-block btn-light mt-0 rounded-0 mb-3">경력</span>
        <ul class="xs_content text-left my-3">
            <li>학교 : ABCD 학교</li>
            <li>졸업연도 : 1999.02</li>
            <li>전공 : 금형,기계제조</li>
            <li>학점 : 4.21/4.5</li>
        </ul>
    </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3">
        <span class="btn btn-block btn-light mt-0 rounded-0 mb-3">자격증</span>
        <ul class="xs_content text-left my-3">
            <li>학교 : ABCD 학교</li>
            <li>졸업연도 : 1999.02</li>
        </ul>
        <hr class="mx-4" />
        <ul class="xs_content text-left my-3">
            <li>전공 : 금형,기계제조</li>
            <li>학점 : 4.21/4.5</li>
        </ul>
    </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3">
        <span class="btn btn-block btn-light mt-0 rounded-0 mb-3">어학</span>
        <ul class="xs_content text-left my-3">
            <li>학교 : ABCD 학교</li>
            <li>졸업연도 : 1999.02</li>
        </ul>
        <hr class="mx-4" />
        <ul class="xs_content text-left my-3">
            <li>전공 : 금형,기계제조</li>
            <li>학점 : 4.21/4.5</li>
        </ul>
    </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3">
        <span class="btn btn-block btn-light mt-0 rounded-0 mb-3">관련서류보기</span>
        <ul class="xs_content text-left my-3">
            <li>
<!--                다운로드 링크-->
                <a href="#">
                <span class="pull-right mr-3"><i class="xi-download" style="font-size:16px;"></i></span>
                [이력서] ic_laucher_1024.png
                </a>
            </li>
            <li>
<!--                다운로드 링크-->
                <a href="#">
                <span class="pull-right mr-3"><i class="xi-download" style="font-size:16px;"></i></span>
                [이력서] ic_laucher_1024.png
                </a>
            </li>
            <li>
<!--                다운로드 링크-->
                <a href="#">
                <span class="pull-right mr-3"><i class="xi-download" style="font-size:16px;"></i></span>
                [이력서] ic_laucher_1024.png
                </a>
            </li>
        </ul>
    </div>

    <a href="#" class="btn btn-block btn-primary">이력서 전체보기</a>

</div>

<?php if(!$check_voucher){?>
  <button data-toggle="modal" data-target="#buy_voucher" class="btn btn-block btn-warning btn-lg rounded-0 fixed-bottom">면접 제안하기</button>
<?php }else{?>
  <button data-toggle="modal" data-target="#interview_suggestion" class="btn btn-block btn-warning btn-lg rounded-0 fixed-bottom">면접 제안하기</button>
<?php } ?>

<div class="modal fade" id="suggestion_way" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#suggestion_way').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding">
                <h5 class="weight_lighter"><span class="red">면접 요청방법</span>을<br />선택 해 주세요.</h5>
                <div class="px-3">
                  <button onclick="prepare()" class="btn btn-block btn-danger btn-round mt-3">문자메세지 발송</button>

                  <!-- <button onclick="jQuery('#suggestion_way').modal('hide');jQuery('#interview_sms').modal('show');" class="btn btn-block btn-danger btn-round mt-3">문자메세지 발송</button> -->
<!--                    이렇게 쓰시면 미리 내용을 채워서 공고등록자 휴대전화로 바로 문자전송가능-->
<!--                <a class="btn btn-block btn-danger btn-round mt-3" href="sms:+821057595999&amp;body=%EA%B8%B0%EC%88%A0%EC%9E%90%EC%88%B2%20%EC%A7%80%EC%9B%90%EC%9E%90%EB%8B%98%EA%BB%98%20%EB%A9%B4%EC%A0%91%EC%9A%94%EC%B2%AD%20%EB%93%9C%EB%A6%BD%EB%8B%88%EB%8B%A4.">문자메세지 발송</a>-->
                <?if($isMobile == true){?>
                  <a class="btn btn-block border-danger text-danger btn-round mt-3" href="tel:+821057595999">지원자에게 직접 전화</a>
                <?}else{?>
                  <button onclick="jQuery('#suggestion_way').modal('hide');jQuery('#application_phone').modal('show');" class="btn btn-block border-danger text-danger btn-round mt-3">지원자에게 직접 전화</button>
                <?}?>
                </div>
            </div>
            <button class="mt-2 btn btn-block btn-light" onclick="jQuery('#suggestion_way').modal('hide');" style="border-radius:10px;">닫기</button>
        </div>
    </div>
</div>

<div class="modal fade" id="application_phone" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#application_phone').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding">
                <p>
                  <span class="red">
                    지원자 : <?=$info_row[0]['m_name']?><br>
                    ☎ <?=$info_row[0]['m_phone']?><br>
                  </span>
                  <span>
                    *면접정보 외 다른 목적으로<br>
                    개인정보를 이용할 수 없습니다.
                  </span>
                </p>
                <div class="px-3">
                <button class="btn btn-block border-danger text-danger btn-round mt-3" onclick="jQuery('#application_phone').modal('hide');">닫기</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="buy_voucher" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#buy_voucher').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding">
                <p>
                  면접제안권 구매 후 해당 지원자에게<br>
                  <b>면접 요청</b>을 하실 수 있습니다.<br>
                </p>
                <h5 class="weight_lighter"><span class="red">면접제안권을 구매</span>하시겠습니까?</h5>
                <div class="px-3">
                <button onclick="jQuery('#buy_voucher').modal('hide');document.location.href='<?=getUrl('company','service',10)?>'" class="btn btn-block btn-danger btn-round mt-3">구매하기</button>
                <button class="btn btn-block border-danger text-danger btn-round mt-3" onclick="jQuery('#buy_voucher').modal('hide');">아니오</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="interview_suggestion" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#interview_suggestion').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding">
                <p>
                  잔여 면접제안권 <span class="red"><?=$check_voucher[0]['remain_count']?>회</span><br>
                  <b>해당 지원자에게 면접제안을 하시겠어요?</b>
                </p>
                <div class="px-3">
                <button onclick="jQuery('#interview_suggestion').modal('hide');jQuery('#suggestion_way').modal('show');suggestion_yes();" class="btn btn-block btn-danger btn-round mt-3">네</button>
                <button class="btn btn-block border-danger text-danger btn-round mt-3" onclick="jQuery('#interview_suggestion').modal('hide');">아니오</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <div class="modal fade" id="interview_sms" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center" style="border-radius:10px;">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#interview_sms').modal('hide');jQuery('#suggestion_way').modal('show');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding" style="overflow-y: scroll; max-height:450px;">
                <h4 class="weight_lighter red">면접 제안하기</h4>
                <form method="post" action="/proc.php?act=" class="text-left">

                    <label class="mt-3">공고명</label>
                    <input type="text" class="form-control" value="PCL 및 로봇제어 기술자분 모집" />

                    <label class="mt-3">면접일시</label>
                    <input type="text" class="form-control xiso_date mb-1" />
                    <div class="row">
                        <div class="col-6 pr-1">
                            <select class="form-control"><option value="">오전 08시</option></select>
                        </div>
                        <div class="col-6 pl-1">
                            <select class="form-control"><option value="">30분</option></select>
                        </div>
                    </div>

                    <label class="mt-3">면접장소</label>
                    <div class="input-group mb-1">
                        <input type="text" class="form-control" />
                        <button class="btn btn-danger rounded-0">검색</button>
                    </div>
                    <input type="text" class="form-control" value="상세주소 입력" />

                    <label class="mt-3">면접시 지참 서류</label>
                    <div class="input-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="none">
                            <label class="custom-control-label" for="none">없음</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="none">
                            <label class="custom-control-label" for="none">신분증</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="none">
                            <label class="custom-control-label" for="none">이력서</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="none">
                            <label class="custom-control-label" for="none">기타</label>
                        </div>
                    </div>
                    <input type="text" class="form-control" placeholder="기타서류를 입력 해 주세요"/>

                    <label class="mt-3">발신번호</label>
                    <input type="text" class="form-control" placeholder="- 없이 숫자만 입력" />

                    <label class="mt-3">발신번호 인증</label>
                    <div class="input-group mb-1">
                        <input type="text" class="form-control" />
                        <button class="btn btn-danger rounded-0">인증</button>
                    </div>

                    <button class="btn btn-block btn-danger btn-round mt-3">문자메세지 발송</button>
                </form>
            </div>
            <button class="mt-2 btn btn-block btn-light" onclick="jQuery('#interview_sms').modal('hide');jQuery('#suggestion_way').modal('show');" style="border-radius:10px;">취소</button>
        </div>
    </div>
</div> -->

<script type="text/javascript">
  function prepare(){
    alert("죄송합니다. 서비스 준비중입니다.");
  }

  function suggestion_yes(){
    var params = {};
    params["m_idx"] = m_idx;
    params["ps_idx"] = <?=$row['ps_idx']?>;
    params['merchant_uid'] = 'merchant_' + new Date().getTime();
    params["amount"] = price;
    params["discount"] = discount;

    exec_json("company.service_order_success",params,function(ret_obj){
        alert("결제성공!!!");
    });
  }
</script>
<?php
//$footer_false = true;
?>
