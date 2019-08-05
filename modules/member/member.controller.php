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

    function procMemberNiceAuth($args){

        $args->receive_sex = 1;

        $_SESSION['nice_auth'] = array();
        $_SESSION['nice_auth']["CI"] = "asdklzxASDFMCMcvjnrek433#@CBKMDFalkl";
        $_SESSION['nice_auth']["DI"] = "AJKDJEKMCLXE";
        $_SESSION['nice_auth']["user_name"] = "이우진";
        $_SESSION['nice_auth']["birthday"] = "19900325";
        $_SESSION['nice_auth']["gender"] = ($args->receive_sex == 1) ? "M" : "F";

        //핸드폰일때만 들어오는것
        $_SESSION['nice_auth']["agent"] = "SKT";
        $_SESSION['nice_auth']["mobile"] = "01057595999";

        return new Object(0,sprintf("%s님의 본인인증에 성공하였습니다.",$_SESSION['nice_auth']["user_name"]));
    }

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

        if(!$id){
          return new Object(-1,"아이디를 입력해 주세요.");
        }

        if(mb_strlen($id, "UTF-8") < 2 || mb_strlen($id, "UTF-8") > 16){
          return new Object(-1, "아이디는 2 ~ 16자 내로 입력해주세요.");
        }

        global $oDB;
        $oDB->where("m_id","$id");
        $row = $oDB->getOne("TF_member_tb",null,"m_id");

        if($row){
          return new Object(-1,"중복된 아이디가 있습니다.");

        }else{
          $_SESSION['id_check'] = 1;
          return new Object(0,"사용가능한 아이디 입니다.");
        }
    }
    function procMemberSignupTechnician($args){
//        $output = new Object(-1,"실패함");
//        $output->add('abcd',"이런게있을때만");
//        return $output;
        global $oDB;
        //$row = 0;

        //쿼리
        //if(count($row)) return new Object(-1, "이미 존재하는 계정입니다.");
        $_SESSION['signup'] = array();
        $_SESSION['signup']['m_id'] = $args->m_id;
        $_SESSION['signup']['m_pw1'] = $args->m_pw1;
        $_SESSION['signup']['m_pw2'] = $args->m_pw2;
        $_SESSION['signup']['select7'] = $args->select7;
        $_SESSION['signup']['m_email1'] = $args->m_email1;
        $_SESSION['signup']['m_email2'] = $args->m_email2;

        //비밀번호 일치하는지 확인
        if($args->m_pw1 && $args->m_pw1 != $args->m_pw2){
          return new Object(-1,"비밀번호를 확인해주세요.");
        }
        if($_SESSION['id_check'] != 1){
          return new Object(-1,"아이디 중복확인을 해주세요.");
        }
        if(!$args->m_id){
          return new Object(-1,"아이디를 입력해주세요.");
        }
        if(!$args->m_pw1){
          return new Object(-1,"비밀번호를 입력해주세요.");
        }
        if(!$args->m_pw2){
          return new Object(-1,"비밀번호를 확인해주세요.");
        }
        if(mb_strlen($args->m_pw1, "UTF-8") < 6){
          return new Object(-1,"비밀번호는 6자리 이상으로 지정해주세요.");
        }

        date_default_timezone_set('Asia/Seoul');
        $now_date = date(YmdHis);
        $m_email = $args->m_email1."@".$args->m_email2;

        //insert
        $data = array(
          "m_id" => $args->m_id,
          "m_pw" => $args->m_pw1,
          "m_name" => "김다현",
          "m_human" => "F",
          "m_birthday" => "19930712",
          "m_phone" => "010-2292-7916",
          "m_email" => $m_email,
          "select7" => $args->$select7,
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
            $oDB->where("m_id","$m_id");
            $m_row = $oDB->getOne("TF_member_tb",null,"m_idx");
            $_SESSION['LOGGED_INFO'] = $m_row['m_idx'];
            unset($_SESSION['signup']);
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
}
