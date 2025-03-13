<?php
date_default_timezone_set("Asia/Bangkok"); // ตั้งค่าเวลาใน php
$conn = mysqli_connect('db', 'root', 'root', 'realtimechat'); // กำหนดค่าเชื่อมต่อฐานข้อมูล

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // ถ้าเชื่อมต่อไม่ได้ให้แสดงข้อความ
}
