<?php
  $row = $output->get('application_row');
  $interview_list = $output->get('interview_list');
?>

<section class="p-3 mt-4 pt-5 bg-white d-lg-none">
    <a onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
    <h4 class="weight_normal">지원자 현황</h4>
</section>

<div class="container pb-md-3" style="position:relative; z-index:1;">
    <h4 class="text-center d-none d-lg-block py-4 mt-5">지원자 현황</h4>
    <div class="content_padding px-0 pb-1 d-md-none">
        <a href="#" class="pull-right btn btn-primary btn-xxs btn-round">더보기 +</a>
        <h5>지원자 관리</h5>
    </div>
    <div class="content_padding px-0 pb-1 d-none d-lg-block">
        <a href="#" class="pull-right btn btn-primary btn-round">더보기 +</a>
        <h4 class="py-2">지원자 관리</h4>
    </div>
    <div class="tech-card-slick">
    <?php if(count($row) == 0){ ?>
      지원자가 없습니다.
    <?php }else{ ?>
      <?php foreach($row as $val){ ?>
          <div class="tech_card bg-white overflow-hidden mx-3 mb-3 shadow">
              <div class="row">
                  <div class="col-5 pt-4 mt-3 pb-0 my-0 pl-4 pr-2">
                      <div class="avatar square mx-md-2 mx-lg-4" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                      </div>
                  </div>
                  <div class="col-7 pl-0 ml-0">
                      <div class="star_rating pull-right p-2 xxs_content">
                        <?if($val['fitness'] == 3){?>
                          <span class="badge-warning btn-round xxs_content">적합도 높음</span>
                          <i class="text-warning xi-star"></i>
                          <i class="text-warning xi-star"></i>
                          <i class="text-warning xi-star"></i>
                          <!-- <i class="text-warning xi-star-o"></i> -->
                        <?}else if($val['fitness'] == 2){?>
                          <span class="badge-warning btn-round xxs_content">적합도 중간</span>
                          <i class="text-warning xi-star"></i>
                          <i class="text-warning xi-star"></i>
                        <?}else{?>
                          <span class="badge-warning btn-round xxs_content">적합도 낮음</span>
                          <i class="text-warning xi-star"></i>
                        <?}?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="pr-2">
                      <h5 class="weight_normal mt-2 mb-0 text-left"><?=$val['m_name']?> <span class="xs_content vertical-align-0">(56세)</span></h5>
                      <p class="m-0 text-left weight_lighter xs_content"><?=$val['a_line_self']?></p>
                      <p class="text-left xs_content px-0 py-0 m-0 mb-1" class="cut1"> <img class="d-inline" src="/oPage/images/imgicons/wrench_bg_red.png" height="14" /> 경력 :
                       <?php
                        if(!$val['duty_name']){
                          echo "신입";
                        }else{
                          echo $val['duty_name'];
                        }
                       ?>
                     </p>
                      </div>
                  </div>
              </div>
              <p class="xxs_content text-right"><i class="xi-clock-o"></i> 지원일자 <?=$val['reg_date']?></p>
              <a href="<?=getUrl('company','application',$val['m_idx'],array(h_idx=>$val['h_idx']))?>" class="btn btn-block btn-warning mt-3 py-md-3 rounded-0">지원자 정보 상세보기</a>
          </div>
          <?php } ?>
    <?php } ?>

    </div>
</div>
<div class="container py-md-5">
        <div class="content_padding px-0 pb-1 d-md-none">
            <h5>추천 기술자</h5>
        </div>
        <div class="content_padding px-0 pb-1 d-none d-lg-block">
            <a href="#" class="pull-right btn btn-primary btn-round">더보기 +</a>
            <h4 class="py-2">추천 기술자</h4>
        </div>
    <div class="flex-card-slick">
        <?php for($i=1; $i<=4; $i++){?>
        <div class="tech_card bg-white overflow-hidden mx-md-3 mb-md-3 shadow">
            <div class="avatar square w-50 mx-auto my-2 my-sm-3 my-md-4" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
            </div>
            <div class="px-2 mb-0">
            <h6 class="weight_normal mb-1 text-center">나상호 (56세)</h6>
            <p class="text-left xs_content px-0 py-0 m-0 mb-1" class="cut1"> <img class="d-inline" src="/oPage/images/imgicons/wrench_bg_red.png" height="14" /> 주요경력 : <?=$val['duty_name']?> 기타기타기타기타</p>
            <p class="text-left xs_content px-0 py-0 m-0 mb-1">  <img class="d-inline" src="/oPage/images/imgicons/location_bg_red.png" height="14" /> 희망지역 : <?=$desired_work_place?></p>
            </div>
            <a href="<?=getUrl('company','application',100)?>" class="btn btn-block btn-warning mt-3 rounded-0">이력서 보기</a>
        </div>
        <?php } ?>
    </div>
</div>
<div class="container py-md-3 py-lg-5">
    <div class="content_padding px-0 pb-1 d-md-none">
        <h5>면접자 현황</h5>
    </div>
    <div class="content_padding px-0 pb-1 d-none d-lg-block">
        <h4 class="py-2">면접자 현황</h4>
    </div>
    <div class="tech-card-slick slick-white-dots d-md-none" style="z-index:2;">
        <?php foreach($interview_list as $val){?>
            <div class="tech_card bg-white overflow-hidden">
                <h6 class="text-center color_primary pt-2 pb-0 my-0 mt-2"><?=$val['h_title']?></h6>
                <hr class="mx-2" />
                <div class="px-3">
                <table class="table table-borderless table-vertical-middle table-sm mx-3" cellspacing="0" cellpadding="0">
                    <colgroup>
                        <col width="10">
                        <col width="70">
                        <col width="10">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">지원자명</th>
                        <td>:</td>
                        <td><?=$val['m_name']?></td>
                    </tr>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">면접요청</th>
                        <td>:</td>
                        <td><?=$val['way']?></td>
                    </tr>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">전화번호</th>
                        <td>:</td>
                        <td><?=$val['m_phone']?></td>
                    </tr>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">요청일시</th>
                        <td>:</td>
                        <td><?=$val['reg_date']?></td>
                    </tr>
                    <? if($val['way'] == "문자"){ ?>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">면접일</th>
                        <td>:</td>
                        <td>19.08.01 12:00</td>
                    </tr>
                    <? } ?>
                </table>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="d-none d-md-block pb-5">
        <table class="table table-light table-bordered mt-4  text-center" width="100%">
            <thead class="bg-light">
            <tr><th>공고제목</th><th>지원자 명</th><th>면접요청발송</th><th>요청일시</th><th>면접일</th></tr>
            </thead>
            <tbody>
            <?php foreach($interview_list as $val){?>
            <tr>
                <td><?=$val['h_title']?></td>
                <td><?=$val['m_name']?></td>
                <td><?=$val['way']?></td>
                <td><?=$val['reg_date']?></td>
                <td><?=($val['way'] == "문자") ? "19.08.01 12:00" : "-"?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <!-- <a class="btn pull-right btn-primary text-white"><i class="xi-file-download"></i> 엑셀 다운로드</a> -->
    </div>
</div>
<div class="bg-primary d-sm-none" style="height:130px; margin-top:-105px; position:relative; z-index:0;"></div>

<?php
$footer_false = true;
?>
