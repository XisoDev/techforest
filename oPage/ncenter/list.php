<div class="container">
    <div class="content_padding px-0">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="pull-right pt-2"><a href="<?=getUrl('member','settingAlert')?>">설정 <i class="xi-cog"></i></a></h5>
        <h5 class="weight_normal">알림센터</h5>
    </div>
    <div class="col-12 mt-2">
        <?php foreach($output->get("member_notice") as $val){

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
          <div class="alert_card">
              <a href="#" class="btn btn-block btn-danger mt-0 rounded-0"><i class="xi-volume-mute"></i> 알림 도착</a>
              <div class="content_padding pt-2 pb-2">
                  <div>
                      <span class="btn btn-danger btn-xxs btn-round">
                        <?
                        if($day > 0){
                          echo $day."일전";
                        }else{
                          echo "오늘";
                        }
                        ?>
                      </span>
                      <span class="pull-right xxs_content"><i class="xi-clock-o"></i><?=$reg_hour?></span>
                  </div>
                  <div class="mt-2">
                  <p class="my-0 py-0 xs_content weight_bold"><?=$val['m_name']?> 님</p>
                  <p class="my-0 py-0 xs_content"><span class="red">

                  <?if($val['n_idx']==6){ ?><span style="color:black"><?=$val['m_name']?>님을 위한</span> 맞춤
                  <?}else if($val['n_idx']==4){?>[<?}?>
                    <?=$val['notice_type']?>
                    <?if($val['n_idx']==5){?>
                    </span>이 완료되었습니다.
                    <?}else if($val['n_idx']==6){?>
                    !</span>
                    <?}else if($val['n_idx']==1){?>
                    가 발생</span>했습니다. 확인해보세요!
                    <?}else if($val['n_idx']==4){?>
                      ]</span>해당 공고가 종료되었습니다.
                    <?}?>
                  </p>
                  </div>
                  <a href="#" class="mt-2 btn btn-block btn-light">자세히 보기</a>
              </div>
          </div>
        <?php } ?>
    </div>
</div>

<div class="fixed-bottom pb-2 bg-light content_padding pt-3">
    <span class="btn-round btn btn-warning btn-xxs mb-2">주의사항</span>
    <p class="xs_content content_padding py-0">알림메세지는 7일동안 보관되며 확인 여부와 상관없이 리스트엣 자동으로 삭제됩니다.</p>
</div>
<div style="height:120px;">&nbsp;</div>
