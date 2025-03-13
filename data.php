<?php
include('connect.php'); // เรียกใช้ไฟล์ connect.php
$sql = "SELECT * FROM chat ORDER BY c_time ASC"; // คำสั่ง sql เลือกข้อมูลจากตาราง chat จัดเรียงตามเวลาที่เพิ่มข้อมูล
$res = mysqli_query($conn, $sql); // สั่งให้ php ทำงานคำสั่ง sql
while ($row = mysqli_fetch_array($res)) { // วนลูปแสดงข้อมูลที่ได้จากคำสั่ง sql
    echo "(" . $row['c_name'] . ") " . $row['c_txt'] . "<br>"; // แสดงข้อมูล
}
