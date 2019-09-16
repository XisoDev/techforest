<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class ncenterView
{

    function index($args)
    {
        global $set_template_file;

        $output = new Object();

        $output->add('member_notice',$this->member_notice());

        $set_template_file = "ncenter/list.php";

        return $output;
    }

    function member_notice(){
      global $oDB;

      $date = date("Y-m-d H:i:s", strtotime("-7 day")); // 어제

      $m_idx = $_SESSION['LOGGED_INFO'];

      $columns = "DISTINCT h_title, mn_idx, mn.m_idx, mn.n_idx, mn.num, n.notice_type, n.division, n.used, ns.agree, mn.reg_date, m_name, mn.read";

      $oDB->where("mn.m_idx",$m_idx);
      $oDB->where("ns.m_idx",$m_idx);
      $oDB->where("mn.read",0);
      $oDB->where("ns.agree",'Y');
      $oDB->where("mn.reg_date",$date,">=");

      $oDB->join("TF_notice AS n", "n.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_notice_setting AS ns", "ns.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_hire_tb AS h", "h.h_idx = mn.num", "LEFT");
      $oDB->join("TF_member_tb AS m", "mn.m_idx = m.m_idx", "LEFT");

      $oDB->orderby("mn.reg_date","DESC");

      $row = $oDB->get("TF_member_notice AS mn",null,$columns);

      return $row;

    }
}
