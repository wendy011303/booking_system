<?php
		header("Content-Type:text/html; charset='utf-8'");
		include("db_connect.php");
        $select_type = array("digital", "digital3D", "digital5D");
        $post_type = str_replace("數位", "digital", $_POST['select_type']);
        //echo $_POST['select_movie'] . ", " . $_POST['select_type'] . ", " . $_POST['select_time'];
        $sql = "select `" . $post_type . "` from `movies` where `name_c` = '" . $_POST['select_movie'] . "'";
        $data = mysql_query($sql);
		$rs = mysql_fetch_row($data);
        $all_time = explode("/", $rs[0]);
        $tmie_no = 0;
        for($tmie_no = 0; $tmie_no < count($all_time); $tmie_no++){
            if($_POST['select_time'] == $all_time[$tmie_no]) break;
        }
        $tmie_no += 1;
        $sit_type = str_replace("digital", "sit", $post_type) . $tmie_no;
        $sql = "select `" . $sit_type . "` from `movies` where `name_c` = '" . $_POST['select_movie'] . "'";
        $data = mysql_query($sql);
        $rs = mysql_fetch_row($data);
        $sit_array = explode("/", $rs[0]);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <link rel="stylesheet" href="css/main_view.css">
        <link rel="stylesheet" href="css/booking_sit.css">
        <script type="text/javascript" src="js/jquery-latest.min.js"></script>
        <script type="text/javascript" src="js/jquery-timers.min.js"></script>
        <script src="js/main_view.js"></script>
        <title>光之影城 - 線上訂票</title>
        <script type="text/javascript">
            var sit_array = [];
            var sit_no = 0;
            $(window).load(function(){
                sit_array.lenght = 48;
                sit_array = <?php echo json_encode($sit_array);?>;
            });
            
            function onbuttonsitclick(id){
                var $button_sit = $('#sit' + id);
                if(sit_array[id] == "0"){
                    if(sit_no >= 4){
                        alert("不好意思，一次不能超過四個定位，謝謝。");
                        return false;
                    }
                    $button_sit.css("background-color", "#00FF00");
                    $button_sit.css("border-color", "#00FF00");
                    sit_array[id] = "2";
                    sit_no += 1;
                }else if(sit_array[id] == "2"){
                    $button_sit.css("background-color", "#FFFFFF");
                    $button_sit.css("border-color", "#FFFFFF");
                    sit_array[id] = "0";
                    sit_no += -1;
                }
                if(sit_no > 0){ 
                    $('#button_ok').attr('disabled', false);
                    $('#button_ok').css('background-color', '#FFFFFF');
                    $('#button_ok').css('cursor', 'pointer');
                }
                else {
                    console.log(1);
                    $('#button_ok').attr('disabled', true);
                    $('#button_ok').css('background-color', '#000000');
                    $('#button_ok').css('cursor', 'auto');
                }
                var sit_array_str = sit_array.join("/");
                $('#sit_array').val(sit_array_str);
                $('#sit_no').val(sit_no);
            }
        </script>
    </head>
    <body>
        <div class="header">
            <div class="top_area">
                <a class="logo_intent" href="index.php">
                    <img src="image/logo_main.png" alt="光之影城 - LIGHT CIMEMAS" title="光之影城 - LIGHT CIMEMAS"/>
                </a>
                <div class="menu">
                    <ul>
                        <li><a href="theater.php">影城介紹</a></li>
                        <li><a href="film.php">電影介紹</a></li>
                        <li><a href="booking.php">線上訂票</a></li>
                        <li><a href="membership.php">會員專區</a></li>
                    </ul>
                </div>
                <div class="tool">
                    <ul>
                        <li><a href="#">聯絡light</a></li>
                        <li><a href="#">常見問題</a></li>
                        <li><a href="https://www.facebook.com/">
                            <img  src="image/tool_icon_facebook.png" alt="facebook" title="facebook"/>
                        </a></li>
                        <li><a href="https://line.me/zh-hant/">
                            <img src="image/tool_icon_line.png" alt="line" title="line"/>
                        </a></li>
                        <li><a href="https://www.youtube.com/">
                            <img src="image/tool_icon_youtube.png" alt="youtube" title="youtube"/>
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="label">
                <img src="image/sit_lab.png"  title="sit_lab"/>
            </div>
            <div class="sit">
                <table border="0" align="center">
                    <tbody align="center">
                        <?php
                            $row = 0;
                            $column = 0;
                            $i = 0;
                            $sit_mask[0] = array(0, 0, 0, 1, 1, 1, 1, 0, 0, 0);
                            $sit_mask[1] = array(0, 1, 1, 1, 1, 1, 1, 1, 1, 0);
                            $sit_mask[2] = array(0, 1, 1, 1, 1, 1, 1, 1, 1, 0);
                            $sit_mask[3] = array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
                            $sit_mask[4] = array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
                            $sit_mask[5] = array(1, 1, 1, 1, 0, 0, 1, 1, 1, 1);
                            $sit_column = array("A", "B", "C", "D", "E", "F");
                            echo '<tr align="center">';
                            echo '<td></td>';
                            for($i = 1; $i < 11; $i++){
                                echo '<td>' . $i . '</td>';
                            }
                            echo '</tr>';
                            $i = 0;
                            for($column = 0; $column < 6; $column++){
                                echo '<tr align="center">';
                                echo '<td>' . $sit_column[$column] . '</td>';   
                                for($row = 0; $row < 10; $row++){
                                    if($sit_mask[$column][$row]){    
                                        if($sit_array[$i] == "0"){
                                            echo '<td>';
                                            echo '<button type="button" id="sit' . $i . '"';
                                            echo 'style="background-color: #FFFFFF; border-color: #FFFFFF; cursor:pointer;"';
                                            echo 'onclick="onbuttonsitclick('. $i . ')"></button>';
                                            echo '</td>';
                                        }else{
                                            echo '<td>';
                                            echo '<button type="button" id="sit' . $i . '"'; 
                                            echo 'style="background-color: #BF0411; border-color: #BF0411;"';
                                            echo 'disabled="disabled"></button>';
                                            echo '</td>';
                                        }
                                        $i += 1;
                                    }else{
                                        echo '<td></td>';
                                    }
                                }
                                echo '<td>' . $sit_column[$column] . '</td>';   
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <form action="booking_information.php" method="POST">
                    <input id="movie_name" type="hidden" name="movie_name" value="<?php echo $_POST['select_movie'] ?>">
                    <input id="sit_array" type="hidden" name="sit_array" value="">
                    <input id="sit_no" type="hidden" name="sit_no" value="">
                    <input id="sir_type" type="hidden" name="sit_type" value="<?php echo $sit_type ?>">
                    <button type="submit" disabled="disabled" id="button_ok">下一步，請填寫聯絡人資料</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            Copyright © 2017 Light Cinemas. All Rights Reserved. For Websit-Designing homework, not real cinemas website. By Yuntech students.
        </div>
    </body>
</html>
