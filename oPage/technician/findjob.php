<?php
  $m_idx = $_SESSION['LOGGED_INFO'];
  $interest_rows = $output->get('interest_rows');
?>

<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">일자리 찾기</h4>
    </div>
</section>
<div class="container pt-lg-5">
    <div class="px-0 pb-1 pt-3 pt-lg-0">
        <a href="<?=getUrl('technician','findJobList')?>" class="pull-right btn py-2 px-3 btn-primary btn-xxs btn-round">더보기 +</a>
        <h6>일자리 정보</h6>
    </div>

    <div class="flex-card-slick">
        <?php for($i=1; $i<=6; $i++){ ?>
            <div class="tech_card bg-white shadow">
                <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                    <span class="overlay">
                    <a href="#" class="btn-xxs btn btn-round border-white text-white py-1 px-2 mr-lg-3 position-absolute" style="right:10px; top:10px;">
                        관심공고
                        <?php if($i % 2 == 0) { ?>
                        <i class="xi-heart" style="font-size:14px; vertical-align:-2px;"></i>
                        <?php }else{ ?>
                        <i class="xi-heart red" style="font-size:14px; vertical-align:-2px;"></i>
                        <?php } ?>
                    </a>
                    </span>
                </div>
                <div class="p-2 text-left pb-1">
                    <h6>(주)일진</h6>
                    <h6 class="red">CATIA 프로그램 경력자 모집</h6>
                    <p class="weight_lighter xxs_content mx-0 px-0">
                        <span class="badge badge-danger weight_lighter">위치</span>
                        경남 김해시
                        <span class="badge badge-danger weight_lighter">시</span>
                        <b>7,350 원</b>
                    </p>
                    <p class="text-secondary xxs_content mx-0 px-0 pb-2">
                    <span class="bg-red icon_wrap"><i class="xi-wrench"></i></span>경력 최소 10년
                    </p>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-6 mx-0 px-0">
                        <a href="#" class="btn btn-light btn-block rounded-0">상세보기</a>
                    </div>
                    <div class="col-6 mx-0 px-0">
                        <button class="btn btn-light btn-block rounded-0 red">지원하기</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="py-md-4 my-md-5">
    <div class="container">
    <div class="content_padding px-0 pb-1 pt-4 ">
        <a href="#" class="pull-right btn btn-primary btn-xxs py-2 px-3 btn-round">더보기 +</a>
        <h6>입사지원현황</h6>
    </div>
    <div class="row px-2">
    <?php for($i=1; $i<=2; $i++) { ?>
        <div class="col-12 col-md-6 px-md-4">
        <div class="magazine tech_card mb-3 bg-white text-left shadow">
            <div class="row px-0 mx-0">
                <div class="col-5 col-md-12 px-0 mx-0" style="background-color:#EEE;">
                    <div class="thumbnail d-block" style="height:100%;" onmouseover="jQuery(this).find('div.overlay').removeClass('d-none');" onmouseout="jQuery(this).find('div.overlay').addClass('d-none');">
                    <div class="overlay d-none">
                        <div class="overlay-content" style="width:100%; text-align:center;">
                            <a href="#" class="btn-round btn border-white text-white btn-xs">이력서 열람</a>
                            <p class="xxs_content">2019.07.01<br />16:18:59</p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-7 col-md-12 pl-0 pl-md-3">
                    <div class="p-2">
                        <h6 class="weight_normal pb-0 mb-0">그림자숲</h6>
                        <h6 class="red pt-0 mt-0">가공팀(조/반장)</h6>
                        <hr class="py-1 px-0 m-0" />
                        <p class="weight_lighter xxs_content mx-0 px-0">
                            <span class="badge badge-danger weight_lighter">위치</span>
                            경남 김해시
                            <span class="badge badge-danger weight_lighter">시</span>
                            <b>7,350 원</b>
                        </p>
                        <p class="text-secondary xxs_content mx-0 px-0 pt-1">
                            <span class="bg-red icon_wrap"><i class="xi-wrench"></i></span>경력 최소 10년
                        </p>
                    </div>

                    <div class="row m-0 p-0 pt-0 mt-0">
                        <div class="col-6 mx-0 px-0">
                            <a href="#" class="btn btn-light btn-block btn-xs px-0 py-3 rounded-0 text-secondary">상세보기</a>
                        </div>
                        <div class="col-6 mx-0 px-0">
                            <button class="btn btn-light btn-block btn-xs px-0 py-3 rounded-0 red">지원완료</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>
    </div>
    </div>
</div>
<div class="container pb-md-5">
    <div class="content_padding px-0 pb-1">
        <a href="<?=getUrl('technician','findJobList')?>" class="pull-right btn btn-primary btn-xxs btn-round">더보기 +</a>
        <h6>관심공고</h6>
    </div>

    <div class="flex-card-slick">
      <input type="hidden" id="hidden_m_idx" value="<?=$m_idx?>">
        <?php if(count($interest_rows) != 0){ ?>
          <?php foreach($interest_rows as $val){ ?>
            <div class="tech_card bg-white shadow">
                <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                    <span class="overlay">
                      <?
                        if($m_idx > 0) {
                          if(count($interest_rows) == 0) {
                            $interest_html = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_add('. $val['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart" id="no_interest"></i></a>';
                          } else {
                            if(count($interest_rows) > 0) {
                              $interest_html = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_remove('. $val['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart red" id="yes_interest"></i></a>';
                            } else {
                              $interest_html = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_add('. $val['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart" id="no_interest"></i></a>';
                            }
                          }
                        }else {

                      }
                    ?>
                    <?= $interest_html ?>
                    </span>
                </div>
                <? if ($val['city_name'] == "전체") { $val['city_name'] = "";} ?>
                <? if ($val['district_name'] == "전체") { $val['district_name'] = ""; }?>
                <? if ($val['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                <div class="content_padding text-left pb-1">
                    <h6 class="cut1"><?=$val['c_name']?></h6>
                    <h6 class="red cut1"><?=$val['h_title']?></h6>
                    <p class="weight_lighter xxs_content mx-0 px-0">
                    <span class="badge badge-danger weight_lighter">위치</span>
                      <?= $val['local_name'] . " " . $val['city_name'].$val['district_name']?>
                    <span class="badge badge-danger weight_lighter">
                      <?if($val['salary_idx'] == "1"){
                          echo "연봉";
                        }else if($val['salary_idx'] == "2"){
                          echo "월급";
                        }else if($val['salary_idx'] == "3"){
                          echo "일급";
                        }else{
                          echo "시급";
                        }?>
                    </span>
                      <b><?= number_format($val['job_salary']) . $hire_salary_text?></b>
                    </p>
                    <p class="text-secondary xxs_content mx-0 px-0 pb-2">
                        <span class="bg-red icon_wrap"><i class="xi-wrench"></i></span><?=$val['job_is_career']?>
                    </p>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-6 mx-0 px-0">
                        <a href="#" class="btn btn-light btn-block rounded-0">상세보기</a>
                    </div>
                    <div class="col-6 mx-0 px-0">
                        <button class="btn btn-light btn-block rounded-0 red">지원하기</button>
                    </div>
                </div>
            </div>
        <?php
            }
          }else{ ?>
            등록된 관심공고가 없습니다.
       <? } ?>
    </div>
</div>


<script type="text/javascript">

</script>
<?php
$footer_false = true;
?>
