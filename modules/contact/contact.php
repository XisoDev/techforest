<?php

class contactView{

    function index($args)
    {
        if(!$_SESSION['LOGGED_INFO']){
            return goLogin();
        }

        global $site_info;
        $site_info->layout = $_SESSION["USER_TYPE"];
        global $add_body_class;
        $add_body_class[] = "shrink";
        $add_body_class[] = "no_mobile_header";

        setSEO("문의하기","기술자숲에 궁금한것이 있다면 무엇이든 문의 해 보세요!");

        global $set_template_file;
        $set_template_file = "contact/write.php";

        $output = new Object();
        $output->add('member_notice',$this->member_notice());
        return $output;
    }

    function member_notice(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      $columns = "mn_idx, mn.m_idx, mn.n_idx, mn.num, n.notice_type, n.division, n.used, ns.agree, mn.reg_date, m_name, mn.read";

      $oDB->where("mn.m_idx",$m_idx);
      $oDB->where("mn.read",0);

      $oDB->join("TF_notice AS n", "n.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_notice_setting AS ns", "ns.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_member_tb AS m", "mn.m_idx = m.m_idx", "LEFT");

      $oDB->orderby("n_idx","ASC");

      $row = $oDB->get("TF_member_notice AS mn",null,$columns);

      return $row;

    }

    function replies(){
      global $oDB;
      global $site_info;
      $site_info->layout = $_SESSION["USER_TYPE"];
      global $add_body_class;
      $add_body_class[] = "shrink";
      $add_body_class[] = "no_mobile_header";

      setSEO("내문의답변","기술자숲에 궁금한것이 있다면 무엇이든 문의 해 보세요!");

      global $set_template_file;
      $set_template_file = "contact/replies.php";

      $m_idx = $_SESSION['LOGGED_INFO'];

      $oDB->where("q.m_idx",$m_idx);
      $oDB->join("TF_qna_reply_tb qr","q.q_idx = qr.q_idx","LEFT");
      $row = $oDB->get("TF_qna_tb q",null,"r_idx,qr.content as reply_content,q.m_idx,title,q.content,q.reg_date,qr.reg_date as reply_date");

      $output = new Object();
      $output->add('member_notice',$this->member_notice());
      $output->add('row',$row);
      return $output;
    }


    function FAQ(){
      global $oDB;
      global $site_info;
      $site_info->layout = $_SESSION["USER_TYPE"];
      global $add_body_class;
      $add_body_class[] = "shrink";
      $add_body_class[] = "no_mobile_header";

      setSEO("자주묻는질문","");

      global $set_template_file;
      $set_template_file = "contact/FAQ.php";

      $output = new Object();
      return $output;
    }

    function TechnicianForest(){
      global $oDB;
      global $site_info;
      $site_info->layout = $_SESSION["USER_TYPE"];
      global $add_body_class;
      $add_body_class[] = "shrink";
      $add_body_class[] = "no_mobile_header";

      setSEO("기술자숲 소개","");

      global $set_template_file;
      $set_template_file = "contact/TechnicianForest.php";

      $output = new Object();
      return $output;
    }

}
