<?php
  $row = $output->get('application_row');
?>

<section class="content_padding mt-4 pt-5 bg-white">
    <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
    <h5 class="weight_normal">지원자 현황</h5>
</section>

<div class="container" style="position:relative; z-index:1;">
    <div class="content_padding px-0 pb-1">
        <a href="#" class="pull-right btn btn-primary btn-xxs btn-round">더보기 +</a>
        <h6>지원자 관리</h6>
    </div>
    <div class="tech-card-slick">
    <?php if(count($row) == 0){ ?>
      지원자가 없습니다.
    <?php }else{ ?>
      <?php foreach($row as $val){ ?>
          <div class="tech_card bg-white overflow-hidden">
              <div class="row">
                  <div class="col-5 pt-4 pb-0 my-0 pl-4">
                      <div class="avatar square" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                      </div>
                  </div>
                  <div class="col-7 pl-0 ml-0">
                      <div class="star_rating pull-right p-2 xxs_content">
                          <span class="badge-warning btn-round xxs_content">적합도 높음</span>
                          <i class="text-warning xi-star"></i>
                          <i class="text-warning xi-star"></i>
                          <i class="text-warning xi-star-o"></i>
                      </div>
                      <div class="clearfix"></div>
                      <p class="m-0 text-left weight_lighter xs_content"><?=$val['a_line_self']?></p>
                      <h6 class="weight_normal my-1 text-left"><?=$val['m_name']?></h6>
                      <p class="text-left xs_content p-0 m-0"><span class="bg-red icon_wrap"><i class="xi-wrench"></i></span> 경력 :
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
              <p class="xxs_content text-right"><i class="xi-clock-o"></i> 지원일자 <?=$val['reg_date']?></p>
              <a href="<?=getUrl('company','application',$val['m_idx'],array(h_idx=>$val['h_idx']))?>" class="btn btn-block btn-warning mt-3 rounded-0">지원자 정보 상세보기</a>
          </div>
          <?php } ?>
    <?php } ?>

    </div>


    <div class="content_padding px-0 pb-1">
        <h6>추천 기술자</h6>
    </div>
    <div class="flex-card-slick">
        <?php for($i=1; $i<=4; $i++){?>
        <div class="tech_card bg-white overflow-hidden">
            <div class="avatar square" style="margin: 10px 25px; background-image:url('/layout/none/assets/images/no_avatar.png');">
            </div>
            <h6 class="weight_normal mb-3">나상호 (56세)</h6>
            <p class="text-left xxs_content"><span class="bg-red icon_wrap"><i class="xi-wrench"></i></span> 주요경력 : 기계 | 연구직</p>
            <p class="text-left xxs_content"><span class="bg-red icon_wrap"><i class="xi-map-marker"></i></span> 희망지역 : 부산</p>
            <a href="<?=getUrl('company','application',100)?>" class="btn btn-block btn-warning mt-3 rounded-0">이력서 보기</a>
        </div>
        <?php } ?>
    </div>


    <div class="content_padding px-0 pb-1">
        <h6>면접자 현황</h6>
    </div>
    <div class="tech-card-slick slick-white-dots">
        <?php for($i=1; $i<=4; $i++){?>
            <div class="tech_card bg-white overflow-hidden">
                <h6 class="color_primary pt-2 pb-0 my-0 mt-2">Co2용접/tig/배관 가능 하신 분 모집</h6>
                <hr class="mx-2" />
                <ul class="text-left ml-3 sm_content">
                    <li class="weight_lighter xs_content">지원자명 : 이학남</li>
                    <li class="weight_lighter xs_content">면접요청 : 문자</li>
                    <li class="weight_lighter xs_content">요청일시 : 19.07.18 19:22</li>
                    <li class="weight_lighter xs_content">면접일 : 19.08.01 12:00</li>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>
<div class="bg-primary" style="height:130px; margin-top:-105px; position:relative; z-index:0;"></div>

<?php
$footer_false = true;
?>
