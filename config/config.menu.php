<?php
//index에서 정의하지만 별도로도 동작할 수 있으므로 한번더 정의
$module = "page";
if(isset($_GET['mid'])) $module = $_GET['mid'];
$act = "index";
if(isset($_GET['act'])) $act = $_GET['act'];
//set Menu
//메뉴의 조건
//array(
//    "title" => "",
//    "link" => "",
//    "icon" => "xi-icon 참조",
//    "active_mid" => "",
//    "active_act" => "",
//    "new_window" => "",
//    "is_logged" => "", //Y는 로그인 필요 N은 필요없음 F는 반드시 없어야만 출력
//);

$oMenu = new stdClass();
//공용메뉴
$oMenu->common = new stdClass();
$oMenu->common->list = array();
$oMenu->common->list[] = array(
    "title" => "내 정보 관리",
    "link" => getUrl('member'),
    "active_mid" => "member",
    "active_act" => "index",
    "new_window" => "N",
    "is_logged" => "Y",
);
$oMenu->common->list[] = array(
    "title" => "로그아웃",
    "link" => "/proc.php?act=member.procLogout",
    "active_mid" => "member",
    "active_act" => time(),
    "new_window" => "N",
    "is_logged" => "Y",
);
$oMenu->common->list[] = array(
    "title" => "로그인",
    "link" => getUrl('member','login',false,array('cur' => $current_url)),
    "active_mid" => "member",
    "active_act" => "login",
    "new_window" => "N",
    "is_logged" => "F",
);
$oMenu->common->list[] = array(
    "title" => "회원가입",
    "link" => getUrl('member','signUp'),
    "active_mid" => "member",
    "active_act" => "signUp",
    "new_window" => "N",
    "is_logged" => "F",
);

//하단메뉴
$oMenu->footer = new stdClass();
$oMenu->footer->list = array();
$oMenu->footer->list[] = array(
    "title" => "이용약관",
    "link" => "#",
    "active_mid" => "page",
    "active_act" => time(),
    "new_window" => "N",
    "is_logged" => "N",
);
$oMenu->footer->list[] = array(
    "title" => "문의하기",
    "link" => getUrl('contact'),
    "active_mid" => "page",
    "active_act" => time(),
    "new_window" => "N",
    "is_logged" => "N",
);
// $oMenu->footer->list[] = array(
//     "title" => "회원탈퇴",
//     "link" => getUrl('member','withdrawMember'),
//     "active_mid" => "page",
//     "active_act" => time(),
//     "new_window" => "N",
//     "is_logged" => "Y",
// );

//기업메뉴
$oMenu->company = new stdClass();
$oMenu->company->list = array();
  if($m_idx > 0){
    $oMenu->company->list[] = array(
        "title" => "공고등록",
        "link" => getUrl('company','job_register'),
        "imgicon" => "write_underline",
        "active_mid" => "company",
        "active_act" => "job_register",
        "new_window" => "N",
        "is_logged" => "N",
    );
    $oMenu->company->list[] = array(
        "title" => "공고・지원자관리",
        "link" => getUrl('company','job'),
        "imgicon" => "clipboard",
        "active_mid" => "company",
        "active_act" => "job",
        "new_window" => "N",
        "is_logged" => "N",
    );

  }else{
    $oMenu->company->list[] = array(
        "title" => "공고등록",
        "link" => getUrl('member','login',false,array('cur' => $current_url)),
        "imgicon" => "write_underline",
        "active_mid" => "company",
        "active_act" => "job_register",
        "new_window" => "N",
        "is_logged" => "N",
    );
    $oMenu->company->list[] = array(
        "title" => "공고・지원자관리",
        "link" => getUrl('member','login',false,array('cur' => $current_url)),
        "imgicon" => "clipboard",
        "active_mid" => "company",
        "active_act" => "job",
        "new_window" => "N",
        "is_logged" => "N",
    );
  }

$oMenu->company->list[] = array(
    "title" => "기술자숲 소개",
    "link" => getUrl('contact','TechnicianForest'),
    "active_mid" => "company",
    "imgicon" => "users",
    "active_act" => time(),
    "new_window" => "N",
    "is_logged" => "N",
    "submenu" => array(
        array(
            "title" => "기업소개",
            "link" => getUrl('contact','TechnicianForest'),
            "active_mid" => "company",
            "active_act" => time(),
            "new_window" => "N",
            "is_logged" => "N"),
    //     array(
    //         "title" => "서비스 소개",
    //         "link" => "#",
    //         "active_mid" => "company",
    //         "active_act" => time(),
    //         "new_window" => "N",
    //         "is_logged" => "N"),
     )
);

if($m_idx > 0){
  $oMenu->company->list[] = array(
      "title" => "서비스이용현황",
      "link" => getUrl('company','serviceHistory'),
      "imgicon" => "donutchart",
      "active_mid" => "company",
      "active_act" => "service",
      "new_window" => "N",
      "is_logged" => "N",
      "submenu" => array(
          array(
              "title" => "유료서비스 안내",
              "link" => getUrl('company','service'),
              "active_mid" => "company",
              "active_act" => "service",
              "new_window" => "N",
              "is_logged" => "N"),
          array(
              "title" => "서비스 이용 및 결제내역",
              "link" => getUrl('company','serviceHistory'),
              "active_mid" => "company",
              "active_act" => 'serviceHistory',
              "new_window" => "N",
              "is_logged" => "N"),
      )
  );
}else{
  $oMenu->company->list[] = array(
      "title" => "서비스이용현황",
      "link" => getUrl('member','login',false,array('cur' => $current_url)),
      "imgicon" => "donutchart",
      "active_mid" => "company",
      "active_act" => "service",
      "new_window" => "N",
      "is_logged" => "N",
      "submenu" => array(
          array(
              "title" => "유료서비스 안내",
              "link" => getUrl('member','login',false,array('cur' => $current_url)),
              "active_mid" => "company",
              "active_act" => "service",
              "new_window" => "N",
              "is_logged" => "N"),
          array(
              "title" => "서비스 이용 및 결제내역",
              "link" => getUrl('member','login',false,array('cur' => $current_url)),
              "active_mid" => "company",
              "active_act" => 'serviceHistory',
              "new_window" => "N",
              "is_logged" => "N"),
      )
  );
}

$oMenu->company->list[] = array(
    "title" => "문의",
    "link" => getUrl('contact'),
    "imgicon" => "headset",
    "active_mid" => "contact",
    "active_act" => "index",
    "new_window" => "N",
    "is_logged" => "N",
    "submenu" => array(
        array(
            "title" => "1:1 문의",
            "link" => getUrl('contact'),
            "active_mid" => "contact",
            "active_act" => "index",
            "new_window" => "N",
            "is_logged" => "N"),
        array(
            "title" => "자주묻는 질문",
            "link" => getUrl('contact','FAQ'),
            "active_mid" => "contact",
            "active_act" => "FAQ",
            "new_window" => "N",
            "is_logged" => "N"),
    )
);
//기술자메뉴
$oMenu->technician = new stdClass();
$oMenu->technician->list = array();
$oMenu->technician->list[] = array(
    "title" => "이력서등록",
    "link" => getUrl('technician','resume'),
    "icon" => "xi-library-books-o",
    "active_mid" => "technician",
    "active_act" => "resume",
    "new_window" => "N",
    "is_logged" => "N",
);
$oMenu->technician->list[] = array(
    "title" => "일자리찾기",
    "link" => getUrl('technician','findJob'),
    "icon" => "xi-zoom-in",
    "active_mid" => "technician",
    "active_act" => "findJob",
    "new_window" => "N",
    "is_logged" => "N",
);
$oMenu->technician->list[] = array(
    "title" => "서비스이용현황",
    "link" => getUrl('technician','serviceHistory'),
    "icon" => "xi-list-number",
    "active_mid" => "technician",
    "active_act" => "serviceHistory",
    "new_window" => "N",
    "is_logged" => "N",
    "submenu" => array(
        array(
            "title" => "유료서비스 안내",
            "link" => getUrl('technician','service'),
            "active_mid" => "company",
            "active_act" => "service",
            "new_window" => "N",
            "is_logged" => "N"),
    //     array(
    //         "title" => "서비스 이용 및 결제내역",
    //         "link" => getUrl('technician','serviceHistory'),
    //         "active_mid" => "company",
    //         "active_act" => 'serviceHistory',
    //         "new_window" => "N",
    //         "is_logged" => "N"),
      )
);
$oMenu->technician->list[] = array(
    "title" => "취업정보",
    "link" => getUrl('technician','magazine'),
    "icon" => "xi-calendar-check",
    "active_mid" => "technician",
    "active_act" => 'magazine',
    "new_window" => "N",
    "is_logged" => "N",
);
$oMenu->technician->list[] = array(
    "title" => "기술자숲 소개",
    "link" => getUrl('contact','TechnicianForest'),
    "active_mid" => "technician",
    "imgicon" => "users",
    "active_act" => time(),
    "new_window" => "N",
    "is_logged" => "N",
    "submenu" => array(
        array(
            "title" => "기업소개",
            "link" => getUrl('contact','TechnicianForest'),
            "active_mid" => "technician",
            "active_act" => time(),
            "new_window" => "N",
            "is_logged" => "N"),
    //     array(
    //         "title" => "서비스 소개",
    //         "link" => "#",
    //         "active_mid" => "technician",
    //         "active_act" => time(),
    //         "new_window" => "N",
    //         "is_logged" => "N"),
     )
);
$oMenu->technician->list[] = array(
    "title" => "문의",
    "link" => getUrl('contact'),
    "icon" => "xi-mail-o",
    "active_mid" => "contact",
    "active_act" => "index",
    "new_window" => "N",
    "is_logged" => "N",
    "submenu" => array(
        array(
            "title" => "1:1 문의",
            "link" => getUrl('contact'),
            "active_mid" => "contact",
            "active_act" => "index",
            "new_window" => "N",
            "is_logged" => "N"),
        array(
            "title" => "자주묻는 질문",
            "link" => getUrl('contact','FAQ'),
            "active_mid" => "contact",
            "active_act" => "faq",
            "new_window" => "N",
            "is_logged" => "N"),
    )
);

function arrangeMenuItem($menu_item){
    global $module;
    global $act;
    global $logged_info;
    //로그인이 필요한메뉴는 미리 삭제
    if($menu_item["is_logged"] == "Y" && !$logged_info){
        return false;
    }
    //로그인이 안되어있을때만 출력하는 메뉴도 미리 삭제
    if($menu_item["is_logged"] == "F" && $logged_info){
        return false;
    }
    //active 여부 확인
    if($menu_item["active_mid"] == $module && $menu_item["active_act"] == $act){
        $menu_item["active"] = "active";
    }else{
        $menu_item["active"] = "";
    }
    //새창 코드넣기
    if($menu_item["new_window"] == "Y") $menu_item["new_window"] = "target=\"_blank\"";
    return $menu_item;
}

foreach($oMenu as $menu_name => $menu){
    foreach($menu->list as $key => $menu_item){
        $menu_item = arrangeMenuItem($menu_item);
        if(!$menu_item){
            unset($oMenu->{$menu_name}->list[$key]);
            continue;
        }

        //2차메뉴도 정리
        if(is_array($menu_item["submenu"])){
            foreach($menu_item["submenu"] as $sub_key => $sub_item){
                $sub_item = arrangeMenuItem($sub_item);
                if(!$sub_item){
                    unset($oMenu->{$menu_name}->list[$key]["submenu"][$sub_key]);
                    continue;
                }
                $oMenu->{$menu_name}->list[$key]["submenu"][$sub_key] = $sub_item;
            }
        }

        $oMenu->{$menu_name}->list[$key] = $menu_item;
    }
}
