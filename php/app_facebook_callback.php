<?
	include "./init.php";
	include "./session.php";

	$name		=	$_REQUEST["name"];
	$email		=	$_REQUEST["email"];
	$gender		=	$_REQUEST["gender"];
	$id			=	$_REQUEST["id"];
	$type		=	$_REQUEST["type"];

	if($type == 1) {
		$is_commerce	= "N";
	} else if($type == 2) {
		$is_commerce	= "Y";
	}

	$id = "f" . $is_commerce . "_" . $id;
	$birthday = "00000000";

	$sql = "SELECT COUNT(*) FROM TF_member_tb WHERE m_id = '$id';";
	$res = mysql_query($sql);
	$count = mysql_result($res, 0, 0);

	if($gender == "male") {
		$gender = "M";
	} else {
		$gender = "F";
	}
	$date = date("Y-m-d H:i:s", time());


	if($count > 0) {
		$sql = "SELECT
					m_idx, m_id, is_commerce, m_local_idx, m_city_idx, m_district_idx
				FROM TF_member_tb
				WHERE m_id = '$id' AND is_out = 'N';";
		$res = mysql_query($sql);


		while ($row = mysql_fetch_assoc($res)) {
			$m_idx			= $row['m_idx'];
			$m_id			= $row['m_id'];
			$is_commerce	= $row['is_commerce'];
			$m_local_idx	= $row['m_local_idx'];
			$m_city_idx		= $row['m_city_idx'];
			$m_district_idx	= $row['m_district_idx'];
		}

		if($is_commerce == "N") {
			if($m_idx) {
				$_SESSION['m_id']				= $m_id;
				$_SESSION['m_idx']				= $m_idx;
				$_SESSION['is_commerce']		= $is_commerce;
				$_SESSION['auto_login']			= $auto_login;
				$_SESSION['type']				= 0;
				$_SESSION['m_local_idx']		= $m_local_idx;
				$_SESSION['m_city_idx']			= $m_city_idx;
				$_SESSION['m_district_idx']		= $m_district_idx;

				echo json_encode(array("result" => 1, "message" => "로그인 되었습니다", "face_id" => $m_id, "json_type" => 1));
				return;

			} else {
				echo json_encode(array("result" => -1, "message" => "등록되지 않은 회원입니다(-1)"));
				return;
			}
		} else if($is_commerce == "Y") {
			if($m_idx) {
				$_SESSION['m_id']				= $m_id;
				$_SESSION['m_idx']				= $m_idx;
				$_SESSION['is_commerce']		= $is_commerce;
				$_SESSION['auto_login']			= $auto_login;
				$_SESSION['type']				= 1;
				$_SESSION['m_local_idx']		= $m_local_idx;
				$_SESSION['m_city_idx']			= $m_city_idx;
				$_SESSION['m_district_idx']		= $m_district_idx;

				$sql = "SELECT c_idx FROM TF_member_commerce_tb WHERE m_idx = $m_idx;";
				$res = mysql_query($sql);

				while ($row = mysql_fetch_assoc($res)) {
					$c_idx			= $row['c_idx'];
				}

				if($c_idx) {
					$_SESSION['session_c_idx']		= $c_idx;
				}



				echo json_encode(array("result" => 1, "message" => "로그인 되었습니다", "face_id" => $m_id, "json_type" => 1));
				return;
			} else {
				echo json_encode(array("result" => -2, "message" => "등록되지 않은 회원입니다(-2)"));
				return;
			}
		} else {
			echo json_encode(array("result" => -3, "message" => "등록되지 않은 회원입니다(-3)"));
			return;
		}





	} else {



		$sql = "INSERT INTO TF_member_tb(m_id, m_pw, m_name, m_human, m_birthday, m_phone, is_commerce, reg_date, edit_date, m_email) VALUES('$id', '$id', '$name', '$gender', '$birthday', '000-000-0000', '$is_commerce', '$date', '$date', '$email');";
		$res = mysql_query($sql);
		if (!$res) {
			echo json_encode(array("result" => -4, "message" => "잘못된 접속입니다(-4)"));
			return;
		}

		$sql = "SELECT
					m_idx, m_id, is_commerce, m_local_idx, m_city_idx, m_district_idx
				FROM TF_member_tb
				WHERE m_id = '$id' AND is_out = 'N';";
		$res = mysql_query($sql);


		while ($row = mysql_fetch_assoc($res)) {
			$m_idx			= $row['m_idx'];
			$m_id			= $row['m_id'];
			$is_commerce	= $row['is_commerce'];
			$m_local_idx	= $row['m_local_idx'];
			$m_city_idx		= $row['m_city_idx'];
			$m_district_idx	= $row['m_district_idx'];
		}

		if($is_commerce == "N") {
			if($m_idx) {
				$_SESSION['m_id']				= $m_id;
				$_SESSION['m_idx']				= $m_idx;
				$_SESSION['is_commerce']		= $is_commerce;
				$_SESSION['auto_login']			= $auto_login;
				$_SESSION['type']				= 0;
				$_SESSION['m_local_idx']		= $m_local_idx;
				$_SESSION['m_city_idx']			= $m_city_idx;
				$_SESSION['m_district_idx']		= $m_district_idx;

				echo json_encode(array("result" => 1, "message" => "로그인 되었습니다", "face_id" => $m_id, "json_type" => 1));
				return;

			} else {
				echo json_encode(array("result" => -5, "message" => "등록되지 않은 회원입니다(-5)"));
				return;
			}
		} else if($is_commerce == "Y") {
			if($m_idx) {
				$_SESSION['m_id']				= $m_id;
				$_SESSION['m_idx']				= $m_idx;
				$_SESSION['is_commerce']		= $is_commerce;
				$_SESSION['auto_login']			= $auto_login;
				$_SESSION['type']				= 1;
				$_SESSION['m_local_idx']		= $m_local_idx;
				$_SESSION['m_city_idx']			= $m_city_idx;
				$_SESSION['m_district_idx']		= $m_district_idx;

				$sql = "SELECT c_idx FROM TF_member_commerce_tb WHERE m_idx = $m_idx;";
				$res = mysql_query($sql);

				while ($row = mysql_fetch_assoc($res)) {
					$c_idx			= $row['c_idx'];
				}

				if($c_idx) {
					$_SESSION['session_c_idx']		= $c_idx;
				}



				echo json_encode(array("result" => 1, "message" => "로그인 되었습니다", "face_id" => $m_id, "json_type" => 1));
				return;
			} else {
				echo json_encode(array("result" => -6, "message" => "등록되지 않은 회원입니다(-6)"));
				return;
			}
		} else {
			echo json_encode(array("result" => -7, "message" => "등록되지 않은 회원입니다(-7)"));
			return;
		}






	}





?>
