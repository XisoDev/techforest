<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class technicianView{

    function index($args){
        global $set_template_file;
        global $site_info;
        $site_info->layout = "technician";

        $output = new Object();

        $set_template_file = "technician/index.php";

        return $output;
    }

}