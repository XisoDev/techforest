<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class pageView{

    function index($args){

        global $set_template_file;
        global $add_body_class;
        global $add_html_header;
        global $oDB;

        $add_body_class[] = "splash_screen";
        $add_body_class[] = "no_pc_header";
        $add_body_class[] = "no_pc_footer";
        $output = new Object();

        $add_html_header[] = "<link rel=\"stylesheet\" href=\"/oPage/css/splash.css\">";

        $set_template_file = "splash.php";

        $oDB->where("m_id","TF_%","NOT LIKE");
        $oDB->where("m_id","1358%","NOT LIKE");
        $m_count = $oDB->get("TF_member_tb",null,"count(m_idx) as m_count");

        $output->add('m_count',$m_count);

      return $output;
    }

    function selectType($args){

        global $set_template_file;

        global $add_body_class;
        $add_body_class[] = "no_pc_header";
        $add_body_class[] = "no_pc_footer";

        $output = new Object();

        $set_template_file = "home.php";

        return $output;

    }

}
