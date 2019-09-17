<?
	include "./init.php";

	$id = $_REQUEST["id"];
	$gcm = $_REQUEST["gcm"];

	echo "KJW1<br />";
	// 아이디 값이 없을 경우, m_idx 값을 수정하지 않는다.
	if(!$id) {
		$sql = "INSERT INTO TF_gcm_tb(m_idx, gcm_id, reg_date, edit_date, is_os) VALUES(-1, '$gcm', NOW(), NOW(), 'A')
						ON DUPLICATE KEY UPDATE edit_date = NOW(), is_os = 'A'";
		$res = mysql_query($sql);
		if(!$res) {
			echo json_encode(array("result" => -1, "message" => "등록 실패"));
			return;
		}
	} else {
		// 아이디 값이 있을 경우, m_idx 값을 수정한다.
		$sql = "SELECT m_idx FROM TF_member_tb WHERE m_id = '$id' AND is_out = 'N' ORDER BY m_idx ASC;";
		$res = mysql_query($sql);
		if(!$res) {
			echo json_encode(array("result" => -4, "message" => "등록 실패"));
			return;
		}
		$m_idx = mysql_result($res, 0, 0);

		$sql = "INSERT INTO TF_gcm_tb(m_idx, gcm_id, reg_date, edit_date, is_os) VALUES($m_idx, '$gcm', NOW(), NOW(), 'A')
						ON DUPLICATE KEY UPDATE m_idx = $m_idx, edit_date = NOW(), is_os = 'A'";
		$res = mysql_query($sql);
		if(!$res) {
			echo json_encode(array("result" => -2, "message" => "등록 실패"));
			return;
		}
	}

	echo json_encode(array("result" => 1, "message" => "등록성공"));
	return;

?>
