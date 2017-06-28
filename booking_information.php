<?php
		header("Content-Type:text/html; charset='utf-8'");
		include("db_connect.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <link rel="stylesheet" href="css/main_view.css">
        <link rel="stylesheet" href="css/booking_information.css">
        <script type="text/javascript" src="js/jquery-latest.min.js"></script>
        <script type="text/javascript" src="js/jquery-timers.min.js"></script>
        <script src="js/main_view.js"></script>
        <title>光之影城 - 線上訂票</title>
        <script type="text/javascript">
            $(window).load(function(){
                $('#button_ok').click(function(){
                    var info_str = "";
                    for(var i = 0; i < <?php echo $_POST['sit_no'] ?>; i++){
                        if($('input[name = "name' + i + '"]').val() == "" || 
                            $('input[name = "email' + i + '"]').val() == "" || 
                            $('input[name = "phone' + i + '"]').val() == ""){
                            alert("請填完資料再送出，謝謝");
                            info_str = "";
                            return false;
                        }
                        info_str += $('input[name = "name' + i + '"]').val() + "/" + 
                                    $('input[name = "email' + i + '"]').val() + "/" + 
                                    $('input[name = "phone' + i + '"]').val() + "/";
                        console.log(info_str);
                    }
                    info_str += <?php echo $_POST['sit_no'] ?>;
                    console.log(info_str);
                    var movie_name = <?php echo '"' . $_POST['movie_name'] . '"' ?>,
                        sit_type   = <?php echo '"' . $_POST['sit_type'] . '"' ?>,
                        sit_array  = <?php echo '"' . $_POST['sit_array'] . '"' ?>;
                        //console.log(movie_name + sit_type + sit_array);
                    
                    $.ajax({
                        url: "booking_final.php",
                        data: "&movie_name=" + movie_name +
                              "&sit_type=" + sit_type + 
                              "&sit_array=" + sit_array + 
                              "&info_str=" + info_str,
                        type:"POST",
                        dataType:'text',
                        success: function(msg){
                            alert("送出成功" + msg);
                            window.location.href="index.php";
                        },
                         error:function(xhr, ajaxOptions, thrownError){ 
                            alert(xhr.status); 
                            alert(thrownError); 
                        }
                    });
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
                <?php 
                    for($i = 0; $i < $_POST['sit_no']; $i++){
                        echo '<div>';
                        echo '<h3>請輸入姓名</h3>';
                        echo '<input id="name' . $i . ' type="text" name="name' . $i . '" value="">';
                        echo '<h3>請輸入e-mail</h3>';
                        echo '<input id="email' . $i . ' type="text" name="email' . $i . '" value="">';
                        echo '<h3>請輸入聯絡電話</h3>';
                        echo '<input id="phone' . $i . ' type="text" name="phone' . $i . '" value="">';
                        echo '</div>';
                    }
                ?>
                <button type="button" id="button_ok">確認送出</button>
        </div>
        <div class="copyright">
            Copyright © 2017 Light Cinemas. All Rights Reserved. For Websit-Designing homework, not real cinemas website. By Yuntech students.
        </div>
    </body>
</html>
