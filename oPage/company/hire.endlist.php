<?php
//두가지유형 다적어드림.
//endrow는 변수에 넣어서 밑에서 쓰고 row는 밑에서 바로씀. 상황에따라 사용하시면됨. 굳이 루프한번쓰려고 변수에 따로 저장할필요는 없음
// $end_row = $output->get('end_row');
$row = $output->get('row');
?>

<section class="p-3 mt-4 pt-5 pb-3 bg-white d-lg-none">
    <i class="xi-arrow-left xi-2x" onclick="history.back();"></i>
    <h5 class="weight_normal">마감된 공고</h5>
</section>


<div class="container-fluid py-3 bg-light">
    <div class="container pb-3 mb-3">
        <div class="p-2 px-0 d-lg-none">
            <h6>마감된공고를 확인해보세요.</h6>
        </div>

        <h4 class="d-none d-lg-block mt-5 py-3">마감된 공고</h4>
        <div class="row">
    <?php foreach($output->get('end_row') as $val){ ?>
            <div class=" col-12 col-sm-6 col-lg-4">
        <div class="tech_card bg-white mb-4 shadow" id="end_list">
            <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                <div class="overlay"><span class="overlay-content"><?=$logged_info['c_name']?></span></div>
            </div>
            <div class="text-left py-1 px-3">
              <h6 class="red mb-0"><?=$val['h_title']?></h6>
              <p class="weight_lighter xs_content mb-0 mx-0 px-0">
                <? if ($val['city_name'] == "전체") { $val['city_name'] = "";} ?>
                <? if ($val['district_name'] == "전체") { $val['district_name'] = ""; }?>
                <? if($val['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                  <img class="d-inline" src="/oPage/images/imgicons/location_bg_red.png" height="14" />
                  <?php echo $val['local_name'] . " " . $val['city_name'].$val['district_name'];?>
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
                  <b><?php echo number_format($val['job_salary']) . $hire_salary_text?></b>
              </p>
                <p class="weight_lighter xs_content mb-0 mx-0 px-0">
                    <img class="d-inline" src="/oPage/images/imgicons/wrench_bg_red.png" height="14" />
                    경력 : <?=$val['job_is_career']?>
                </p>
            </div>
            <div class="row mt-1 mx-0 px-0">
                <div class="col-12 mx-0 px-0">
                    <a href="<?=getUrl('company','job',$val['h_idx']);?>" class="btn btn-secondary btn-block rounded-0">지원자 보기(<?=$val['applicant']?>)</a>
                </div>
            </div>
        </div>
            </div>
    <?php } ?>
        </div>
    </div>
</div>

<?php $footer_false = true; ?>
