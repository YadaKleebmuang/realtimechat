<?php
date_default_timezone_set("Asia/Bangkok");
$conn = mysqli_connect('db', 'root', 'root', 'realtimechat');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>