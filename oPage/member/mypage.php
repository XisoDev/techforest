<?php
$common_back_button = true; //하단부 뒤로가기 버튼을 자동으로 생성해줌.

$act = $output->get('act');

switch($act){
    case "index" : include _XISO_PATH_ . "/oPage/member/mypage/index.php"; break;
    case "myprofile" : include _XISO_PATH_ . "/oPage/member/mypage/myprofile.php"; break;
    case "updateIdpw" : include _XISO_PATH_ . "/oPage/member/mypage/update_id_pw.php"; break;
    case "settingAlert" : include _XISO_PATH_ . "/oPage/member/mypage/setting_alert.php"; break;
    default : include _XISO_PATH_ . "/oPage/member/mypage/index.php"; break;
}


//아래는 멤버필드 참고하려고;
//Array
//(
//    [m_idx] =&gt;
//    [m_id] =&gt; a
//    [m_pw] =&gt; a
//    [m_name] =&gt; 변요한
//    [m_human] =&gt; M
//    [m_birthday] =&gt; 1984-10-23 00:00:00
//    [m_phone] =&gt; 010-1111-2222
//    [m_email] =&gt; oo11@hanmail.net
//    [m_address] =&gt; 서울 강서구 허준로 9 (가양동, 공중화장실)
//    [m_address2] =&gt; 999
//    [m_local_idx] =&gt; 9
//    [m_city_idx] =&gt; 155
//    [m_district_idx] =&gt; -1
//    [is_admin] =&gt; N
//    [is_commerce] =&gt; N
//    [is_device] =&gt; W
//    [is_external] =&gt; A
//    [is_out] =&gt; N
//    [reg_date] =&gt;
//    [edit_date] =&gt;
//    [m_picture] =&gt; 9245_20190506201015.jpg
//    [c_idx] =&gt;
//    [c_name] =&gt;
//    [c_introduction] =&gt;
//    [registration] =&gt;
//    [select1] =&gt;
//    [select2] =&gt;
//    [select3] =&gt;
//    [select4] =&gt;
//    [phonenumber] =&gt;
//    [address] =&gt;
//    [address2] =&gt;
//    [o_idx] =&gt;
//    [select5] =&gt;
//    [select6] =&gt;
//    [select7] =&gt;
//    [homepage] =&gt;
//    [image] =&gt;
//    [is_grade] =&gt;
//)

?>