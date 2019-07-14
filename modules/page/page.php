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
        global $oDB;
        global $category;

        $output = new Object();

        $set_template_file = "home.php";

        return $output;
    }

}