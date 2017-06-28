<?php
		header("Content-Type:text/html; charset='utf-8'");
		include("db_connect.php");
        //echo $_POST['movie_name'] . ", " . $_POST['sit_type'] . ", " . $_POST['sit_array'] . ", " . $_POST['info_str'];
        $sit_array = str_replace("2", "1", $_POST['sit_array']);
        $sql="UPDATE `movies` SET `" . $_POST['sit_type'] . "`='" . $sit_array . "' WHERE `name_c`='" . $_POST['movie_name'] . "'";
        //$sql = "select `" . $post_type . "` from `movies` where `name_c` = '" . $_POST['select_movie'] . "'";
        $result=mysql_query($sql);
		//$rs = mysql_fetch_row($data);
?>