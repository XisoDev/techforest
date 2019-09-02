<?php
class ncenterController{

  function see_more($args){
    global $oDB;

    $mn_idx = $args->mn_idx;
    $n_idx = $args->n_idx;
    $num = $args->num;

    $data = Array (
      "read"=>1
            );

    $oDB->where ('mn_idx', $mn_idx);
    $row = $oDB->update ('TF_member_notice', $data);

    switch ($n_idx) {
      case 1:
        $url = getUrl('company','job',$num);
        break;

      case 2:

        break;

      case 3:

        break;

      case 4:
        $url = getUrl('company','job');
        break;
      case 5: //사진이력서 등록
        $url = getUrl('technician','resumeWrite',$num);
        break;
      case 6: //맞춤 일자리 추천
        $url = getUrl('technician','findJobList');
        break;

      case 7:

        break;

      case 8:

        break;

      case 9:

        break;

      case 10:

        break;
    }


    if($row){
      return new Object(0,$url);
    }else{
      return new Object(-1,"네트워크 오류가 발생했습니다.");
    }
  }

}
