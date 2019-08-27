
<div class="container pt-lg-5">
    <div class="content_padding px-0 d-lg-none">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">알림설정</h5>
    </div>
    <div class="pt-lg-5 pt-lg-3 position-relative mx-auto col-sm-10 col-md-9 col-lg-8">
        <h4 class="d-none d-lg-block mb-4"><i class="xi-bell-o text-secondary"></i> 알림설정</h4>
    </div>
    <?if(count($output->get("notice_setting")) > 0){
      $checked = array(); // 빈 배열인 경우
      $val = $output->get("notice_setting");
        for($i=0;$i<5;$i++){
          if($val[$i][agree]=='N'){

          }else{
            $checked[$i] = 'checked="checked"';
          }
        }
      }else{
        for($i=0;$i<5;$i++){
          $checked[$i] = 'checked="checked"';
        }
      } ?>

    <div class="mx-auto col-sm-10 col-md-9 col-lg-8 rounded border p-4 p-md-5 ">
    <form class="tf_underline_form">
      <?if($logged_info['is_commerce'] == 'Y'){?>
        <div class="form-group">
            <label class="just_label">실시간 입사지원자 알림</label>
            <input id='c_check_1' type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" <?=$checked[0]?> data-size="sm" />
        </div>
        <div class="form-group">
            <label class="just_label">쿠폰 및 할인권 알림</label>
            <input id='c_check_2' type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" <?=$checked[1]?> data-size="sm" />
        </div>
        <div class="form-group">
            <label class="just_label">유료서비스 마감 알림</label>
            <input id='c_check_3' type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" <?=$checked[2]?> data-size="sm" />
        </div>
        <div class="form-group">
            <label class="just_label">진행중 공고 마감 알림</label>
            <input id='c_check_4' type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" <?=$checked[3]?> data-size="sm" />
        </div>
      <?}else {?>
        <div class="form-group">
            <label class="just_label">사진이력서 등록 알림</label>
            <input id='m_check_1' type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" <?=$checked[0]?> data-size="sm" />
        </div>
        <div class="form-group">
            <label class="just_label">일자리 추천 알림</label>
            <input id='m_check_2' type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" <?=$checked[1]?> data-size="sm" />
        </div>
        <div class="form-group">
            <label class="just_label">선면접 제안 알림</label>
            <input id='m_check_3' type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" <?=$checked[2]?> data-size="sm" />
        </div>
        <div class="form-group">
            <label class="just_label">지원 제안 알림</label>
            <input id='m_check_4' type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" <?=$checked[3]?> data-size="sm" />
        </div>
        <div class="form-group">
            <label class="just_label">지원/관심 공고 마감 알림</label>
            <input id='m_check_5' type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" <?=$checked[4]?> data-size="sm" />
        </div>
      <? } ?>
        <!-- <div class="form-group">
            <label class="just_label">야간수신 동의</label>
            <input type="checkbox" data-toggle="toggle" data-style="tech_forest" data-onstyle="danger" checked="checked" data-size="sm" />
        </div> -->
        <h6 class="weight_lighter"><i class="xi-clock-o"></i> 알림 수신시간 : 09:00 - 21:00</h6>
    </form>
        <div class="row mt-4 col-md-7 col-lg-6 mx-auto">
            <div class="col-6 mx-0 px-0 pr-1">
                <a href="#" onclick="history.back();" class="btn btn-block btn-round border-primary">취소</a>
            </div>
            <div class="col-6 mx-0 px-0 pl-1">
                <a id='echo_check' class="btn btn-block btn-round btn-primary">수정완료</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  <?if($logged_info['is_commerce'] == 'Y'){?>
      var m_or_c =  'c';
  <? }else{ ?>
      var m_or_c =  'm';
  <? } ?>

  $('#echo_check').click(function(){
    var array_check = [];
    if(m_or_c == 'm'){
      // console.log('m');
      for(var i =0; i<5;i++){
        if($("input:checkbox[id='m_check_"+(i+1)+"']").is(":checked") == true){
          array_check[i] = i+1;
        }else{
          array_check[i] = 0;
        }
      }
    }else{
      // console.log('c');
      for(var i =0; i<4;i++){
        if($("input:checkbox[id='c_check_"+(i+1)+"']").is(":checked") == true){
          array_check[i] = i+1;
        }else{
          array_check[i] = 0;
        }
      }
    }

    var params = {};
    params['count'] = array_check.length ;
    for(var i =0; i <array_check.length;i++){
      params['check_'+i+''] = array_check[i];
    }

    exec_json("member.notice_set",params,function(ret_obj){
        toastr.success(ret_obj.message);
        setTimeout(location.reload.bind(location), 500);
    });

  });
</script>
