<?php
//두가지유형 다적어드림.
//endrow는 변수에 넣어서 밑에서 쓰고 row는 밑에서 바로씀. 상황에따라 사용하시면됨. 굳이 루프한번쓰려고 변수에 따로 저장할필요는 없음
// $end_row = $output->get('end_row');
$row = $output->get('row');
$end_row = $output->get('end_row');
?>

<section class="p-3 mt-4 pt-5 pb-3 bg-white d-lg-none">
    <i class="xi-arrow-left xi-2x" onclick="history.back();"></i>
    <h5 class="weight_normal">공고 ・ 지원자관리</h5>
</section>
<div class="container pb-5">
    <div class="p-2 px-0 d-lg-none">
        <h6><span class="red">진행중</span>인 공고를 확인해보세요.</h6>
    </div>

    <a href="<?=getUrl('company','hireList')?>" class="d-none d-lg-inline-block btn btn-primary pull-right btn-round mt-3">더보기 <i class="xi-plus"></i></a>
    <h4 class="d-none d-lg-block mt-5 py-3">진행중인 공고</h4>
    <div class="row">
      <? $hire = (count($row) > 3) ? 3 : count($row); ?>
      <?php for($i=0; $i < $hire; $i++){ ?>
        <div class=" col-12 col-sm-6 col-lg-4">
        <div class="tech_card bg-white mb-4 shadow">
            <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                <div class="overlay"><span class="overlay-content"><?=$row[$i]['c_name']?></span></div>
            </div>
            <div class="row m-0 p-0">
                <div class="col-6 mx-0 px-0">
                    <a href="<?=getUrl('company','jobDetail',$row[$i]['h_idx']);?>" class="btn btn-danger btn-block rounded-0">상세보기</a>
                </div>
                <div class="col-6 mx-0 px-0">
                    <button class="btn btn-light btn-block rounded-0" onclick="close_job(<?=$row[$i]['h_idx']?>)">공고마감하기</button>
                </div>
            </div>
            <div class="py-1 px-3 text-left">
                <h6 class="red mb-0"><?=$row[$i]['h_title']?></h6>
                <p class="weight_lighter xs_content mb-0 mx-0 px-0">
                  <? if ($row[$i]['city_name'] == "전체") { $row[$i]['city_name'] = "";} ?>
                  <? if ($row[$i]['district_name'] == "전체") { $row[$i]['district_name'] = ""; }?>
                  <? if($row[$i]['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                    <img class="d-inline" src="/oPage/images/imgicons/location_bg_red.png" height="14" />
                    <?php echo $row[$i]['local_name'] . " " . $row[$i]['city_name'].$row[$i]['district_name'];?>
                    <span class="badge badge-danger weight_lighter">
                      <?if($row[$i]['salary_idx'] == "1"){
                        echo "연봉";
                      }else if($row[$i]['salary_idx'] == "2"){
                        echo "월급";
                      }else if($row[$i]['salary_idx'] == "3"){
                        echo "일급";
                      }else{
                        echo "시급";
                      }?>
                    </span>
                    <b><?php echo number_format($row[$i]['job_salary']) . $hire_salary_text?></b>
                </p>
                <p class="weight_lighter xs_content mb-0 mx-0 px-0">
                    <img class="d-inline" src="/oPage/images/imgicons/wrench_bg_red.png" height="14" />
                    경력 : <?=$row[$i]['job_is_career']?>
                </p>
            </div>
            <div class="row mt-1 mx-0 px-0">
                <div class="col-6 mx-0 px-0">
                    <a  href="<?=getUrl('company','job_appRegister',$row[$i]['h_idx']);?>" class="btn btn-light btn-block rounded-0">수정</a>
                </div>
                <div class="col-6 mx-0 px-0">
                    <a href="<?=getUrl('company','job',$row[$i]['h_idx']);?>" class="btn btn-light btn-block rounded-0 red">지원자 (<?=$row[$i]['applicant']?>)</a>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>
    </div>
    <a href="<?=getUrl('company','hireList');?>" class="btn btn-block btn-primary d-lg-none">공고 더보기</a>
</div>

<div class="container-fluid py-3 bg-light">
    <div class="container pb-3 mb-3">
        <div class="p-2 px-0 d-lg-none">
            <h6>마감된공고를 확인해보세요.</h6>
        </div>

        <a href="<?=getUrl('company','hireEndList')?>" class="d-none d-lg-inline-block btn btn-primary pull-right btn-round mt-3">더보기 <i class="xi-plus"></i></a>
        <h4 class="d-none d-lg-block mt-5 py-3">마감된 공고</h4>
        <div class="row">
          <? $end_hire = (count($end_row) > 3) ? 3 : count($end_row); ?>
          <?php for($i=0; $i < $end_hire; $i++){ ?>
            <div class=" col-12 col-sm-6 col-lg-4">
            <div class="tech_card bg-white mb-4 shadow" id="end_list">
            <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                <div class="overlay"><span class="overlay-content"><?=$end_row[$i]['c_name']?></span></div>
            </div>
            <div class="text-left py-1 px-3">
              <h6 class="red mb-0"><?=$end_row[$i]['h_title']?></h6>
              <p class="weight_lighter xs_content mb-0 mx-0 px-0">
                <? if ($end_row[$i]['city_name'] == "전체") { $end_row[$i]['city_name'] = "";} ?>
                <? if ($end_row[$i]['district_name'] == "전체") { $end_row[$i]['district_name'] = ""; }?>
                <? if($end_row[$i]['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                  <img class="d-inline" src="/oPage/images/imgicons/location_bg_red.png" height="14" />
                  <?php echo $end_row[$i]['local_name'] . " " . $end_row[$i]['city_name'].$end_row[$i]['district_name'];?>
                  <span class="badge badge-danger weight_lighter">
                    <?if($end_row[$i]['salary_idx'] == "1"){
                      echo "연봉";
                    }else if($end_row[$i]['salary_idx'] == "2"){
                      echo "월급";
                    }else if($end_row[$i]['salary_idx'] == "3"){
                      echo "일급";
                    }else{
                      echo "시급";
                    }?>
                  </span>
                  <b><?php echo number_format($end_row[$i]['job_salary']) . $hire_salary_text?></b>
              </p>
                <p class="weight_lighter xs_content mb-0 mx-0 px-0">
                    <img class="d-inline" src="/oPage/images/imgicons/wrench_bg_red.png" height="14" />
                    경력 : <?=$end_row[$i]['job_is_career']?>
                </p>
            </div>
            <div class="row mt-1 mx-0 px-0">
                <div class="col-12 mx-0 px-0">
                    <a href="<?=getUrl('company','job',$end_row[$i]['h_idx']);?>" class="btn btn-secondary btn-block rounded-0">지원자 보기(<?=$end_row[$i]['applicant']?>)</a>
                </div>
            </div>
        </div>
            </div>
    <?php } ?>
        </div>
    <a href="<?=getUrl('company','hireEndList')?>" class="btn btn-block btn-primary d-lg-none">마감된 공고 더보기</a>
    </div>
</div>
<?php $footer_false = true; ?>
<script type="text/javascript">
  function close_job(h_idx){
    var close = confirm("정말 공고를 마감하시겠습니까?");
    if(close){
      var params = {};
      params["h_idx"] = h_idx;
      exec_json("company.close_hire",params,function(ret_obj){
          toastr.success(ret_obj.message);
          location.reload();
      });
    }
  }


</script>
