<?php
class memberController{

    function getMemberInfoByMemberSrl($m_idx = 0){

        global $oDB;

        $oDB->where("m.m_idx",$m_idx);
        $oDB->join("TF_member_commerce_tb mc","m.m_idx = mc.m_idx","LEFT");
        $row = $oDB->getOne("TF_member_tb m");
        //
        // $member_info = new stdClass();
        // $member_info->member_srl = 1;
        // $member_info->user_id = "xiso";
        // $member_info->email_address = "xiso@amuz.co.kr";
        // $member_info->user_name = "이우진";
        // $member_info->nick_name = "(주)아뮤즈";
        // $member_info->company = $member_info->nick_name;
        // $member_info->mobile = onlynumber("01057595999");
        // $member_info->mobile_format = mobile_format("01057595999");
        // $member_info->birthday = onlynumber('19900229');
        // $member_info->is_luna = "Y";
        // $member_info->last_login = onlynumber("2019-07-14 10:35:12");
        // $member_info->sex = "M";

        return $row;
    }

    function procMemberLogin($args){
        global $oDB;

        $oDB->where("m_id",$args->user_id);
        $row = $oDB->getOne("TF_member_tb");

        if(!$row['m_id']) return new Object(-1, "존재하지 않는 아이디 입니다.");
        if($args->password != $row['m_pw']) return new Object(-1, "비밀번호가 잘못 되었습니다.");

        //비밀번호 일치하면 세션생성 후 로그인 기록 변경
        $_SESSION['LOGGED_INFO'] = $row['m_idx'];

        $output = new Object(0, "로그인 되었습니다.");
        $output->add('member_info',$this->getMemberInfoByMemberSrl($_SESSION['LOGGED_INFO']));

        if($row['is_commerce'] == 'Y'){
          $output->success_return_url = getUrl('company');
        }else{
          $output->success_return_url = getUrl('technician');
        }
        //if($args->cur) $output->success_return_url = $args->cur;
        return $output;
    }
    
    function procNaverLogin($args,$args2){
      global $oDB;

      $now_date = date(YmdHis);

      if($args2['gender']=='M'){
        $m_human = 'M';
      }else if($args2['gender'] == "F" || $args2['gender'] == "W") {
				$m_human = "F";
      } else {
        $m_human = "T";
      }

      $data = array(
        "m_id" => $args2['id'],
        "m_pw" => $args2['id'],
        "m_birthday" => $args2['birthday'],
        "m_human" => $m_human,
        "m_email" => $args2['email'],
        "m_name" => $args2['name'],
        "is_commerce" => $args2['is_commerce'],
        "reg_date" => $now_date,
        "is_out" => 'N'
      );

      $updateColumns = array("is_out");
      $lastInsertId = "is_out";
      $oDB->onDuplicate($updateColumns,$lastInsertId);
      $res = $oDB->insert("TF_member_tb",$data);

      $oDB->where("m_id",$args2['id']);
      $row = $oDB->getOne("TF_member_tb");

      $_SESSION['LOGGED_INFO'] = $row['m_idx'];

      $output = new Object(0, "로그인 되었습니다.");
      $output->add('member_info',$this->getMemberInfoByMemberSrl($_SESSION['LOGGED_INFO']));

      if($row['is_commerce'] == 'Y'){
        $output->success_return_url = getUrl('company');
      }else{
        $output->success_return_url = getUrl('technician');
      }
      //if($args->cur) $output->success_return_url = $args->cur;
      return $output;
    }

    // function procMemberNiceAuth($args){
    //
    //     $args->receive_sex = 1;
    //
    //     $_SESSION['nice_auth'] = array();
    //     $_SESSION['nice_auth']["CI"] = "asdklzxASDFMCMcvjnrek433#@CBKMDFalkl";
    //     $_SESSION['nice_auth']["DI"] = "AJKDJEKMCLXE";
    //     $_SESSION['nice_auth']["user_name"] = "이우진";
    //     $_SESSION['nice_auth']["birthday"] = "19900325";
    //     $_SESSION['nice_auth']["gender"] = ($args->receive_sex == 1) ? "M" : "F";
    //
    //     //핸드폰일때만 들어오는것
    //     $_SESSION['nice_auth']["agent"] = "SKT";
    //     $_SESSION['nice_auth']["mobile"] = "01057595999";
    //
    //     return new Object(0,sprintf("%s님의 본인인증에 성공하였습니다.",$_SESSION['nice_auth']["user_name"]));
    // }

    function procLogout(){
        //객체를 먼저생성하고
        $output = new Object();
        //리다이렉트 주소를 붙인다음
        if($_SESSION["USER_TYPE"] == "company"){
            $output->success_return_url = getUrl('company');
        }else{
            $output->success_return_url = getUrl('technician');
        }
        unset($_SESSION['LOGGED_INFO']);
        //생성된 객체를 리턴
        return $output;
    }

    function procMemberCheckHasID($args){

        $id = $args->m_id;

        global $oDB;
        $oDB->where("m_id","$id");
        $row = $oDB->getOne("TF_member_tb",null,"m_id");

        if($row){
          return new Object(-1,"중복된 아이디가 있습니다.");
        }else{
          return new Object(0,"사용가능한 아이디 입니다.");
        }
    }
    function procMemberSignupTechnician($args){
//        $output = new Object(-1,"실패함");
//        $output->add('abcd',"이런게있을때만");
//        return $output;
        global $oDB;

        $now_date = date(YmdHis);

        if($args->m_email == "@"){
          $args->m_email = "";
        }

        //insert
        $data = array(
          "m_id" => $args->m_id,
          "m_pw" => $args->m_pw1,
          "m_name" => $args->m_name,
          "m_human" => "M",
          "m_birthday" => $args->birth_year."0101",
          "m_phone" => $args->m_phone,
          "m_email" => $args->m_email,
          "is_commerce" => "N",
          "is_device" => "W",
          "is_external" => "A",
          "reg_date" => $now_date,
          "edit_date" => $now_date
        );
        $row = $oDB->insert("TF_member_tb", $data);

        if($row){
            $m_id = $args->m_id;
            //회원가입 후 바로 로그인
            $oDB->where("m_id",$m_id);
            $m_row = $oDB->getOne("TF_member_tb",null,"m_idx");
            $_SESSION['LOGGED_INFO'] = $m_row['m_idx'];
            return new Object(0,"가입에 성공하였습니다.");

        }else{
            return new Object(0,"네트워크 오류가 발생했습니다.");
        }
    }

    function edit_phone($args){

      date_default_timezone_set('Asia/Seoul');
      $now_date = date(YmdHis);

      $m_phone = $args->m_phone;
      $m_idx = $_SESSION['LOGGED_INFO'];

      $data = array(
        "m_phone" => $m_phone,
        "edit_date" => $now_date
      );
      global $oDB;
      $oDB->where("m_idx",$m_idx);
      $row = $oDB->update("TF_member_tb",$data);

      if($row){
        return new Object(0,"휴대폰번호가 변경되었습니다.");
      }else{
        return new Object(-1,"네트워크 오류가 발생했습니다.");
      }

    }

    function edit_email($args){
      date_default_timezone_set('Asia/Seoul');
      $now_date = date(YmdHis);

      $m_email = $args->m_email;
      $m_idx = $_SESSION['LOGGED_INFO'];

      $data = array(
        "m_email" => $m_email,
        "edit_date" => $now_date
      );
      global $oDB;
      $oDB->where("m_idx",$m_idx);
      $row = $oDB->update("TF_member_tb",$data);

      if($row){
        return new Object(0,"이메일 주소가 변경되었습니다.");
      }else{
        return new Object(-1,"네트워크 오류가 발생했습니다.");
      }

    }

    function edit_pass($args){
      date_default_timezone_set('Asia/Seoul');
      $now_date = date(YmdHis);

      $m_pw = $args->new_pass;
      $m_idx = $_SESSION['LOGGED_INFO'];

      $data = array(
        "m_pw" => $m_pw,
        "edit_date" => $now_date
      );
      global $oDB;
      $oDB->where("m_idx",$m_idx);
      $row = $oDB->update("TF_member_tb",$data);

      if($row){
        return new Object(0,"비밀번호가 변경되었습니다.");
      }else{
        return new Object(-1,"네트워크 오류가 발생했습니다.");
      }
    }

    function edit_InCharge_name($args){
      date_default_timezone_set('Asia/Seoul');
      $now_date = date(YmdHis);

      $select7 = $args->InCharge_name;
      $m_idx = $_SESSION['LOGGED_INFO'];

      $data = array(
        "select7" => $select7,
        "edit_date" => $now_date
      );
      global $oDB;
      $oDB->where("m_idx",$m_idx);
      $row = $oDB->update("TF_member_commerce_tb",$data);

      if($row){
        return new Object(0,"채용담당자 정보가 변경되었습니다.");
      }else{
        return new Object(-1,"네트워크 오류가 발생했습니다.");
      }
    }

    function edit_id($args){
      global $oDB;

      $m_id = $args->m_id;
      $m_idx = $_SESSION['LOGGED_INFO'];

      $oDB->where("m_id",$m_id);
      $id_row = $oDB->getOne("TF_member_tb",null,"m_id");
      if(!$id_row){

      }else{
        return new Object(-1,"중복되는 아이디가 있습니다.");
      }


      date_default_timezone_set('Asia/Seoul');
      $now_date = date(YmdHis);

      $data = array(
        "m_id" => $m_id,
        "edit_date" => $now_date
      );

      $oDB->where("m_idx",$m_idx);
      $row = $oDB->update("TF_member_tb",$data);

      if($row){
        return new Object(0,"아이디가 전환되었습니다.");
      }else{
        return new Object(-1,"네트워크 오류가 발생했습니다.");
      }
    }

    function notice_set($args){
      global $oDB;
      $count = $args->count;
      $check = array();
      $check[1] = $args->check_0;
      $check[2] = $args->check_1;
      $check[3] = $args->check_2;
      $check[4] = $args->check_3;
      if($count>4){
        $check[5] = $args->check_0;
        $check[6] = $args->check_1;
        $check[7] = $args->check_2;
        $check[8] = $args->check_3;
        $check[9] = $args->check_4;
        $check[10] = $args->check_5;
      }

      $m_idx = $_SESSION['LOGGED_INFO'];
      if($count>4){
          $iset=5;
      }else{
        $iset=1;
      }
      for($i=$iset;$i<($iset+$count);$i++){
        if($check[$i] == 0){
          $data = Array ("m_idx" => $m_idx,
                 "n_idx" => $i,
                 "agree" => 'N'
                  );
        }else{
          $data = Array ("m_idx" => $m_idx,
                 "n_idx" => $i,
                 "agree" => 'Y'
                  );
        }

        $updateColumns = Array ("agree");
        $lastInsertId = 'm_idx';
        $oDB->onDuplicate($updateColumns, $lastInsertId);
        $row = $oDB->insert ('TF_notice_setting', $data);
      }

      if($row){
        return new Object(0,"알림이 설정되었습니다.");
      }else{
        return new Object(-1,"네트워크 오류가 발생했습니다.");
      }
    }

    function my_picture_upload($args){
      global $oDB;
      $now_date = date(YmdHis);

      $data = array (
        "m_idx" => $args->m_idx,
        "m_picture" => $args->formData,
        "edit_date" => $now_date
      );

      $oDB->where("m_idx",$args->m_idx);
      $row = $oDB->insert ('TF_member_tb', $data);

      if($row){
        return new Object(0,"증명사진이 수정되었습니다.");
      }else{
        return new Object(-1,"네트워크 오류가 발생했습니다.");
      }
    }

    function procFileUpload(){
      global $oDB;
      $m_idx = $_SESSION['LOGGED_INFO'];
      $date	= date(YmdHis);
      $image_name = $m_idx . "_" . $date . ".jpg";

      $file_real_name = $_FILES["userfile"]["name"];

      $target_path = "./m_picture/";

      if($_FILES["userfile"]["tmp_name"]){
        $oDB->where("m_idx",$m_idx);
        $row = $oDB->get("TF_member_tb",null,"m_picture");

        $db_img = $row['m_picture'];
        if($db_img) {
          unlink("./m_picture/" . $db_img);
        }

        if(!$row){
          return new Object(-1,"네트워크 오류입니다.(-1)");
        }
        // 파일저장
      if(move_uploaded_file($_FILES['userfile']['tmp_name'], "./m_picture/" . $image_name)){

        $data = array(
          "m_picture" => $image_name,
          "edit_date" => $date
        );
        $oDB->where("m_idx",$m_idx);
        $insert_row = $oDB->update("TF_member_tb",$data);

        if(!$insert_row) {
          return new Object(-1,"네트워크 오류입니다.(-2)");
        } else {
          return new Object(0,"증명사진이 등록/수정되었습니다.");
        }

      } else {
        return new Object(-1,"네트워크 오류입니다.(-3)");
      }
    }

    }
}
