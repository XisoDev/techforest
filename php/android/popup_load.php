<?php
	ob_start();
	include "dbconn.php";
	include "tf_json.php";

	$local = $_REQUEST['local'];
	$city = $_REQUEST['city'];
	$district = $_REQUEST['district'];
	$type = $_REQUEST['type'];
	
	$result_list = array();

 
	//
	$sql = "SELECT seq, type, image, content, local_idx, city_idx, district_idx, start_date, end_date, reg_date, edit_date
			FROM TF_popup_tb
			WHERE start_date < now() AND end_date > now() AND local_idx IN($local, -1, 0) AND city_idx IN($city, -1, 0) AND district_idx IN($district, -1, 0) AND type = '$type'";
	
	$sql .= " ORDER BY CASE WHEN local_idx = -1 THEN 1 ELSE 2 end, seq DESC;";
	
	
	$res = mysql_query($sql);
	if(!$res){//쿼리에러
	 	check_return(false, true,$result_list);
		mysql_close($con);
		exit;
 	}	
	$pop_list	=array();
	while ($row = mysql_fetch_assoc($res)) {
		
		$result = array(
			"seq"				=>		$row['seq'],
			"type"				=>		$row['type'],
			"image"				=>		$row['image'],
			"content"			=>		$row['content'],
			"local_idx"			=>(int) $row['local_idx'],
			"city_idx"			=>(int) $row['city_idx'],
			"district_idx"		=>(int) $row['district_idx'],
			"start_date"		=>		$row['start_date'],
			"end_date"			=>		$row['end_date'],
			"reg_date"			=>		$row['reg_date'],
			"edit_date"			=>		$row['edit_date']
		);
		array_push($pop_list, $result); 
	}

	$result = array("pop_list" => $pop_list);
 	array_push($result_list, $result);	
	check_return(false, false, $result_list); 
	mysql_close($con);
?>