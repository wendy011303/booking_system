<?php
		//header("Content-Type:text/html; charset='utf-8'");
		include("db_connect.php");
        $data = mysql_query("select `name_c` from `movies` ");
		$row_n = mysql_num_rows($data);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <link rel="stylesheet" href="css/main_view.css">
        <link rel="stylesheet" href="css/booking_view.css">
        <script type="text/javascript" src="js/jquery-latest.min.js"></script>
        <script type="text/javascript" src="js/jquery-timers.min.js"></script>
        <script src="js/main_view.js"></script>
        <title>光之影城 - 線上訂票</title>
        <script type="text/javascript">
            $(window).load(function(){
                var $select = $('.content .booking_select select');
                $('#select1').change(function() {
                    if($select[0].selectedIndex && $select[1].selectedIndex){
                        var select_no = $select[0].selectedIndex,
                            select_type = $select[1].selectedIndex - 1;
                        $.ajax({
                            url: "booking_select.php",
                            data: "&select=" + select_no + "/" + select_type,
                            type:"POST",
                            dataType:'text',
                            success: function(msg){
                                var get_msg = msg.split("/");
                                console.log(get_msg.length);
                                $('#select3').empty();
                                $('#select3').append('<option value="">請選擇電影時間</option>');
                                for(var i = 0; i <　get_msg.length; i++){
                                    $('#select3').append("<option value='" + get_msg[i] + "'>" + get_msg[i] + "</option>");
                                }
                            },
                             error:function(xhr, ajaxOptions, thrownError){ 
                                alert(xhr.status); 
                                alert(thrownError); 
                            }
                        });
                    }else if(!($select[0].selectedIndex && $select[1].selectedIndex)){
                        $('#select3').empty();
                        $('#select3').append('<option value="">請選擇電影時間</option>');
                    }
                });
                $('#select2').change(function() {
                    if($select[0].selectedIndex && $select[1].selectedIndex){
                        var select_no = $select[0].selectedIndex,
                            select_type = $select[1].selectedIndex - 1;
                        $.ajax({
                            url: "booking_select.php",
                            data: "&select=" + select_no + "/" + select_type,
                            type:"POST",
                            dataType:'text',
                            success: function(msg){
                                var get_msg = msg.split("/");
                                console.log(get_msg.length);
                                $('#select3').empty();
                                $('#select3').append('<option value="">請選擇電影時間</option>');
                                for(var i = 0; i <　get_msg.length; i++){
                                    $('#select3').append("<option value='" + get_msg[i] + "'>" + get_msg[i] + "</option>");
                                }
                            },
                             error:function(xhr, ajaxOptions, thrownError){ 
                                alert(xhr.status); 
                                alert(thrownError); 
                            }
                        });
                    }else if(!($select[0].selectedIndex && $select[1].selectedIndex)){
                        $('#select3').empty();
                        $('#select3').append('<option value="">請選擇電影時間</option>');
                    }
                });
                $select.change(function() {
                    if($select[0].selectedIndex && $select[1].selectedIndex && $select[2].selectedIndex){
                        $('#button_ok').attr('disabled', false);
                        $('#button_ok').css('background-color', '#FFFFFF');
                        $('#button_ok').css('cursor', 'pointer');
                    }else{
                        $('#button_ok').attr('disabled', true);
                        $('#button_ok').css('background-color', '#000000');
                        $('#button_ok').css('cursor', 'auto');
                    }
                });

            });
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
            <div class="booking_title">
                <h2>訂票系統<h2>
                <h3>
                    請選擇影城、電影、日期及場次時間。
                    <br>
                    歡迎選購光之影城最新音效設備5DX極限體驗影廳，
                    <br>
                    場面特效及時感受，讓你體驗與4DX不同的極致享受。
                </h3>
                <img src="image/5DX.jpg" alt="5DX" title="5DX"/>
            </div>
            <div class="booking_select">
                <h3>請選擇電影名稱</h3>
                <form action="booking_sit.php" method="POST">
                    <select name="select_movie" id="select1">
                        <option value="">請選擇電影名稱</option>
                        <?php 
                            for($i = 1; $i <= $row_n; $i++){
                                $rs = mysql_fetch_row($data);
                                echo '<option value="' . $rs[0] . '">' . $rs[0] . '</option>';
                            }
                        ?>
                    </select>
                    <h3>請選擇電影類別</h3>
                    <select name="select_type" id="select2">
                        <option value="">請選擇電影類別</option>
                        <option value="數位">數位</option>
                        <option value="數位3D">數位3D</option>
                        <option value="數位5D">數位5D</option>
                    </select>
                    <h3>請選擇電影時間</h3>
                    <select name="select_time" id="select3">
                        <option value="">請選擇電影時間</option>
                    </select>
                    <button type="submit" disabled="disabled" id="button_ok">訂票，前往劃位</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            Copyright © 2017 Light Cinemas. All Rights Reserved. For Websit-Designing homework, not real cinemas website. By Yuntech students.
        </div>
        <!-- <div align="center" class="banner" > -->
                <!-- <div class="silder1"> -->
                    <!-- <div align="center"><img 	src="image/slider_area1.png" name="silder1" width="1276" height="367" /> -->
                <!-- </div> -->
                <!-- <div class="silder2"> -->
                    <!-- <div align="center"><img src="image/silder2.png" name="silder2" width="1276" height="173"/> -->
                <!-- </div> -->
        <!-- </div> -->
    </body>
</html>
