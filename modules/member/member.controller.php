<?php


class memberController{
    function getMemberInfoByMemberSrl($m_idx = 0){

        global $oDB;

        $oDB->where("m_idx",$m_idx);
        $row = $oDB->getOne("TF_member_tb");
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
        unset($_SESSION['LOGGED_INFO']);
        return new Object();
    }

    function procMemberSignupTechnician($args){
//
//        $output = new Object(-1,"실패함");
//        $output->add('abcd',"이런게있을때만");
//        return $output;
//
//
        //

        global $oDB;
        $row = 0;

        //쿼리
        if(count($row)) return new Object(-1, "이미 존재하는 계정입니다.");

        //비밀번호 일치하는지 확인


        //insert

        if($row){
            //로그인
            $_SESSION['LOGGED_INFO'] = $row['m_idx'];

            return new Object(0,"가입에 성공하였습니다.");
        }else{
            return new Object(0,"실패함");
        }
    }

}
