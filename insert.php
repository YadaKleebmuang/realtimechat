<?php
include('connect.php'); // เรียกใช้ไฟล์ connect.php

$sql = "INSERT INTO chat(c_name,c_txt,c_time)VALUES('" . $_REQUEST['name'] . "','" . $_REQUEST['txt'] . "','" . date("Y-m-d H:i:s") . "')"; // คำสั่ง sql เพิ่มข้อมูลลงในตาราง chat
$res = mysqli_query($conn, $sql); // สั่งให้ php ทำงานคำสั่ง sql
if ($res) { // ถ้าสำเร็จ
    echo "success"; // ส่งข้อความกลับไป
} else { // ถ้าไม่สำเร็จ
    echo "error"; // ส่งข้อความกลับไป
}
