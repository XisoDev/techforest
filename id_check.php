<?php
require_once "./common.php";
global $oDB;

$id = $_REQUEST['m_id'];
$_SESSION['id_check'] = 0;

if(!$id){ // 아이디 값이 없는경우
  echo json_encode(array("result" => 0, "message" => "아이디를 입력해 주세요."));
  return;
}

if(mb_strlen($id, "UTF-8") < 2 || mb_strlen($id, "UTF-8") > 16) {
  echo json_encode(array("result" => 0, "message" => "아이디는 2 ~ 16자 내로 입력해주세요."));
  return;
}

$oDB->where("m_id","$id");
$row = $oDB->getOne("TF_member_tb",null,"m_id");

if($row){ // 중복된 아이디
  echo json_encode(array("result" => 0, "message" => "중복된 아이디가 있습니다."));
  return;
}else{ // 사용가능한 아이디
  echo json_encode(array("result" => 1, "message" => "사용가능한 아이디 입니다."));
  $_SESSION['id_check'] = 1;
  return;
}

