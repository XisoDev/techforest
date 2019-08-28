<?php

$my_info1 = $output->get('my_info1');
$my_info2 = $output->get('my_info2');
$my_info3 = $output->get('my_info3');
$my_info4 = $output->get('my_info4');
$my_info5 = $output->get('my_info5');
$my_info6 = $output->get('my_info6');
$my_info7 = $output->get('my_info7');
$my_info8 = $output->get('my_info8');
$my_info9 = $output->get('my_info9');
$my_info10 = $output->get('my_info10');

if($my_info1[0]["m_human"] == "M") {
	$m_human = "남자";
} else if($my_info1[0]["m_human"] == "F") {
	$m_human = "여자";
} else {
	$m_human = "";
}

$html_order = "";
if(!empty($my_info7[0]["desired_salary"]) || $my_info7[0]["salary_idx"] == 0) {
	if($my_info7[0]["salary_name"] == "월급" || $my_info7[0]["salary_name"] == "연봉") {
		$html_order = $my_info7[0]["salary_name"]. " " .number_format($my_info7[0]["desired_salary"]). " 만원 이상";
	}
	else if($my_info7[0]["salary_name"] == "일급" || $my_info7[0]["salary_name"] == "시급") {
		$html_order = $my_info7[0]["salary_name"]. " " .number_format($my_info7[0]["desired_salary"]). " 원 이상";
	}
	else if($my_info7[0]["salary_idx"] == 0) {
		$html_order = "회사내규에 따름";
	}
}

$member_birthday = date("Y-m-d", strtotime($my_info1[0]["m_birthday"]));
$self_introduction = str_replace("\n", "<br />", $my_info2[0]["self_introduction"]);

?>

<div class="bg-dark py-2 text-right fixed-top px-3 text-white"><a href="#" class="text-white" onclick="window.close();"><i class="xi-close"></i> 닫기</a></div>
<section class="bg-white container" style="margin-bottom: 100px;">

    <h2 class="weight_bold px-0 mx-0 mt-5">나의 이력서 전체보기</h2>

    <div class="content_padding">
    <div class="row rounded overflow-hidden">
        <div class="py-2 col-sm-4 col-md-3 col-lg-2 bg-primary text-white text-center">한줄자기소개</div>
        <div class="py-2 col-sm-8 col-md-9 col-lg-10 bg-light"><?=$my_info10[0]['a_line_self']?></div>
    </div>
    </div>

    <div class="row my-4 pt-4">
        <div class="col-4 mx-sm-0 mx-auto col-sm-4 col-md-3 col-lg-2">
            <div class="avatar square" style="background-image:url('/layout/none/assets/images/no_avatar.png');"></div>
        </div>
        <div class="col-sm-8 col-md-9 col-lg-10 ">
            <h3 class="px-2"><?=$my_info1[0]['m_name']?> <span class="sm_content">| <?=$m_human?></span></h3>
            <table class="table table-borderless">
                <cols>
                    <col width="120" />
                    <col width="*" />
                </cols>
                <tr><th>생년월일</th><td><?=$member_birthday?> (40세)</td></tr>
                <tr><th>연 락 처</th><td><?=$my_info1[0]['m_phone']?></td></tr>
                <tr><th>이 메 일</th><td><?=$my_info1[0]['m_email']?></td></tr>
                <tr><th>주&nbsp;&nbsp;&nbsp;&nbsp;소</th><td><?=$my_info1[0]['m_address']?> <?=$my_info1[0]['m_address2']?></td></tr>
            </table>
        </div>
    </div>

    <h4>희망근무조건</h4>
    <div class="row border-top border-bottom text-center">
        <div class="col-4 px-0">
            <div class="border-right py-3 my-2">
            <h6 class="text-secondary">희망급여</h6>
                <p><br /><?=$html_order?></p>
            </div>
        </div>
        <div class="col-4 px-0">
            <div class="border-right py-3 my-2">
                <h6 class="text-secondary">희망직종</h6>
                <p><br /><?=$my_info8[0]['o_name']?></p>
            </div>
        </div>
        <div class="col-4 px-0">
            <div class=" py-3 my-2">
                <h6 class="text-secondary">희망직무</h6>
                <p><br /><?=$my_info9[0]['duty_name']?></p>
            </div>
        </div>
    </div>

    <h5 class="bg-light px-2 py-3 mt-5"><span class="red">*</span>경력 간단요약 및 자기소개</h5>
    <p><?=$self_introduction?></p>

    <? if(count($my_info3) > 0){?>
        <h5 class="bg-light px-2 py-3 mt-5">학력</h5>
        <table class="table table-borderless">
            <cols>
                <col width="120" />
                <col width="*" />
            </cols>
        <?foreach ($my_info3 as $val) {?>
            <tr><th><?=substr($val['school_graduated'], 0, 7)?></th><td><?=$val['school_name']?> | <?=$val['school_major']?></td></tr>
        </table>
      <? } ?>
    <? } ?>

    <? if(count($my_info4) > 0){?>
        <h5 class="bg-light px-2 py-3 mt-5">경력</h5>
        <table class="table table-borderless">
          <cols>
              <col width="120" />
              <col width="*" />
          </cols>
          <?foreach ($my_info4 as $val) {?>
            <?$career_date = substr($val["c_start_date"], 0, 7) . "~" . substr($val["c_end_date"], 0, 7);?>
            <tr><th style="width: 23%;"><?=$career_date?></th><td><?=$val['c_name']?> | <?=$val['c_position']?></td></tr>
            <tr><th style="width: 23%;"></th><td style="padding-top:0;"><?=$val['c_content']?></td></tr>
          <? } ?>
        </table>
    <? } ?>

    <? if(count($my_info5) > 0){?>
        <h5 class="bg-light px-2 py-3 mt-5">자격증</h5>
        <table class="table table-borderless">
            <cols>
                <col width="120" />
                <col width="*" />
            </cols>
        <?foreach ($my_info5 as $val) {?>
            <tr><th><?=substr($val['certificate_date'], 0, 7)?></th><td><?=$val['certificate_name']?></td></tr>
        </table>
      <? } ?>
    <? } ?>

    <? if(count($my_info6) > 0){?>
        <h5 class="bg-light px-2 py-3 mt-5">어학</h5>
        <table class="table table-borderless">
            <cols>
                <col width="120" />
                <col width="*" />
            </cols>
        <?foreach ($my_info6 as $val) {?>
            <tr><th><?=substr($val['language_date'], 0, 7)?></th><td><?=$val['lc_d_idx']?> | <?=$val['score']?></td></tr>
        </table>
      <? } ?>
    <? } ?>

</section>
