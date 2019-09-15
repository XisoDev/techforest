<?php
class contactController{

  function question($args){
    global $oDB;

    $now_date = date(YmdHis);

    $data = array(
      'm_idx' => $args->m_idx,
      'title' => $args->title,
      'content' => $args->content,
      'reg_date' => $now_date,
      'edit_date' => $now_date,
    );
    $row = $oDB->insert("TF_qna_tb",$data);

    if($row){
      return new Object(0,"문의가 전달되었습니다.");
    }else{
      return new Object(-1,"네트워크 오류가 발생했습니다.");
    }
  }
}
