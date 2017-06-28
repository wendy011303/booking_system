<?php
		header("Content-Type:text/html; charset='utf-8'");
		include("db_connect.php");
        $select = explode("/", $_POST['select']);
        $select_type = array("digital", "digital3D", "digital5D");
        $sql = "select `" . $select_type[$select[1]] . "` from movies WHERE `no` = '" . $select[0] ."'";
        $data = mysql_query($sql);
		$rs = mysql_fetch_row($data);
        echo $rs[0] . "";
?>