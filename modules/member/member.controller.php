<?php


class memberController{
    function getMemberInfoByMemberSrl($member_srl = 0){

        $member_info = new stdClass();
        $member_info->member_srl = 1;
        $member_info->user_id = "xiso";
        $member_info->email_address = "xiso@amuz.co.kr";
        $member_info->user_name = "이우진";
        $member_info->nick_name = "(주)아뮤즈";
        $member_info->company = $member_info->nick_name;
        $member_info->mobile = onlynumber("01057595999");
        $member_info->mobile_format = mobile_format("01057595999");
        $member_info->birthday = onlynumber('19900229');
        $member_info->is_luna = "Y";
        $member_info->last_login = onlynumber("2019-07-14 10:35:12");
        $member_info->sex = "M";

        return $member_info;
    }

    function procMemberLogin($args){
        if($args->user_id != 'xiso') return new Object(-1, "존재하지 않는 아이디 입니다.");
        if($args->password != 'test') return new Object(-1, "비밀번호가 잘못 되었습니다.");

        //비밀번호 일치하면 세션생성 후 로그인 기록 변경
        $_SESSION['LOGGED_INFO'] = 1;

        $output = new Object(0, "로그인 되었습니다.");
        $output->add('member_info',$this->getMemberInfoByMemberSrl($_SESSION['LOGGED_INFO']));
        if($args->cur) $output->success_return_url = $args->cur;
        return $output;
    }

    function procLogout(){
        unset($_SESSION['LOGGED_INFO']);
        return new Object();
    }

}
