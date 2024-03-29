<style media="screen">
  .no_notice{
    text-align: center;
    margin-top: 65px;
  }
  .bell{
    width: 50px;
    margin-bottom: 30px;
  }
</style>
<div class="container">
    <div class="p-3 px-0">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="pull-right pt-2"><a href="<?=getUrl('member','settingAlert')?>" class="text-dark">설정 <i class="xi-cog"></i></a></h4>
        <h4 class="weight_bold">알림센터</h4>
    </div>
    <div class="col-12 mt-2">
      <?php if(!$output->get("member_notice")){?>
        <div class="no_notice">
          <img src="/oPage/images/notification.png" class="bell" alt="">
          <p>오늘은 알림이 없어요</p>
        </div>
      <?}else{?>
      <?php foreach($output->get("member_notice") as $val){
        if(($val['agree']=='Y'||!$val['agree']) && $val['read']==0){

        $reg_time = $val['reg_date'];

	      $endDate = strtotime($reg_time);

        $today = strtotime(date("Y-m-d H:i:s")); //현재시간

        $diff = $today - $endDate ;

        $day = floor($diff/(3600*24));

        //알림 발생 시간
        $reg_H = date("H", strtotime($reg_time));
        $reg_i = date("i", strtotime($reg_time));

        if($reg_H > 12){
          $reg_H -= 12;
          $reg_hour = "오후";
        }else{
          $reg_hour = "오전";
        }
        $reg_hour .= $reg_H."시".$reg_i."분";
      ?>
          <div class="alert_card shadow-sm rounded-xl">
              <a href="#" class="btn btn-block btn-danger mt-0 rounded-0"> <img src="/oPage/images/imgicons/speaker.png" height="20" style="vertical-align:-3px;" class="mr-1" /> 알림 도착</a>
              <div class="p-3">
                <div>
                    <?if($day > 0){
                      echo "<span class=\"btn btn-danger btn-xxs btn-round\">".$day."일전</span>";
                      }else{
                      echo "<span class=\"btn btn-danger btn-xxs btn-round\">오늘</span>";
                      }
                    ?>

                  <span class="pull-right xxs_content"><i class="xi-clock-o"></i><?=$reg_hour?></span>
                </div>
                <div class="mt-2">
                  <p class="my-0 py-0 sm_content weight_bold"><?=$val['m_name']?> 님</p>
                  <p class="my-0 py-0 sm_content weight_normal"><span class="red">
                    <?if($val['n_idx']==6){ ?><span style="color:black"><?=$val['m_name']?>님을 위한</span> 맞춤
                    <?} if($val['n_idx']==4||$val['n_idx']==1){?>[<?=$val['h_title'];?>]<?}else{?>
                      <?=$val['notice_type']?>
                    <? } ?>

                    <?if($val['n_idx']==5){?>
                      </span>이 완료되었습니다.
                    <?}else if($val['n_idx']==6){?>
                      !</span>
                    <?}else if($val['n_idx']==1){?>
                    </span>공고에 <span class="red"><?=$val['notice_type']?>가 발생</span>했습니다. 확인해보세요!
                    <?}else if($val['n_idx']==4){?>
                      </span>해당 공고가 종료되었습니다.
                    <?}?>
                  </p>
                  </div>
                  <a onclick="See_more(<?=$val['mn_idx'].",".$val['n_idx'].",".$val['num']?>)" class="mt-2 btn btn-block btn-light rounded-xl shadow-sm">자세히 보기</a>
              </div>
          </div>
        <?php } } } ?>
    </div>
</div>

<div class="fixed-bottom pb-2 bg-light content_padding pt-3">
    <span class="btn-round btn btn-warning btn-xxs mb-2">주의사항</span>
    <p class="xs_content content_padding py-0">알림메세지는 7일동안 보관되며 확인 여부와 상관없이 리스트에서 자동으로 삭제됩니다.</p>
</div>
<div style="height:120px;">&nbsp;</div>

<script type="text/javascript">
  function See_more(mn_idx,n_idx,num){
    var params = {};
    params['mn_idx'] = mn_idx;
    params['n_idx'] = n_idx;
    params['num'] = num;

    exec_json("ncenter.see_more",params,function(ret_obj){
      if(ret_obj.error!=0){
        toastr.success(ret_obj.message);
      }else{
        location.href = ret_obj.message;
      }


    });

  }
</script>
