<?php
	ob_start();

	include "dbconn.php";
	include 'tf_json.php';

	$result_list = array();


	$sql = "SELECT seq, android_version, city_info_version FROM TF_service";
	$res = mysql_query($sql);

	if (!$res) { //쿼리 에러
		check_return(false, true, $result_list);
		return;
	}
	$row = mysql_fetch_row($res);
	$intro_list = array();
	$result = array(
					"seq" => (int)$row[0],
					"version_code" => (int)$row[1],
					"city_info_version" => (int)$row[2]
				);
	array_push($intro_list, $result);


	$result = array("intro_list" => $intro_list);
	array_push($result_list, $result);
	check_return(false, false, $result_list);

	mysql_close($con);
?>
