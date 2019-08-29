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

      $m_idx = $_SESSION['LOGGED_INFO'];

      $columns = "mn_idx, mn.m_idx, mn.n_idx, mn.num, n.notice_type, n.division, n.used, ns.agree, mn.reg_date, m_name, mn.read";

      $oDB->where("mn.m_idx",$m_idx);

      $oDB->join("TF_notice AS n", "n.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_notice_setting AS ns", "ns.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_member_tb AS m", "mn.m_idx = m.m_idx", "LEFT");

      $oDB->orderby("n_idx","ASC");

      $row = $oDB->get("TF_member_notice AS mn",null,$columns);

      return $row;

    }
}
