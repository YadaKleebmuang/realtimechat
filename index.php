<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat Room</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> <!-- เรียกใช้งานไอคอน -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> <!-- เรียกใช้งาน jQuery -->
    <style>
        /* ส่วนของการตั้งค่าทั่วไป */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: white;
        }

        /* ส่วนของกล่องแชทหลัก        */
        .chat-container {
            width: 400px;
            background: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* ส่วนของหัวข้อแชท (Chat Header) */
        .chat-header {
            background: #333;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .chat-header i {
            color: #00bfff;
            /* กำหนดสีของไอคอนในส่วนหัวให้เป็นสีฟ้า */
        }

        /* ส่วนของกล่องแชท (Chat Box) */
        .chat-box {
            height: 300px;
            overflow-y: auto;
            padding: 15px;
            display: flex;
            flex-direction: column;
            background: #2b2b2b;
            border-bottom: 1px solid #444;
            scrollbar-width: thin;
            scrollbar-color: #888 #2b2b2b;
        }

        /* ส่วนของข้อความในแชท */
        .message {
            max-width: 75%;
            margin-bottom: 10px;
            padding: 12px;
            border-radius: 12px;
            font-size: 14px;
            word-wrap: break-word;
            display: inline-block;
        }

        /* ข้อความที่ผู้ใช้ส่ง */
        .message.sent {
            align-self: flex-end;
            background: #007bff;
            color: white;
            text-align: right;
        }

        /* ข้อความที่ได้รับ */
        .message.received {
            align-self: flex-start;
            background: #444;
            color: white;
        }

        /* ส่วนของช่องกรอกข้อความ (Chat Input) */
        .chat-input {
            padding: 12px;
            background: #222;
            border-top: 1px solid #444;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* ส่วนของช่องป้อนข้อความ */
        .chat-input input,
        .chat-input textarea {
            width: 94%;
            padding: 12px;
            border: 1px solid #666;
            border-radius: 8px;
            font-size: 14px;
            background: #333;
            color: white;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        /* เอฟเฟกต์เมื่อโฟกัสที่ช่องป้อนข้อมูล */
        .chat-input input:focus,
        .chat-input textarea:focus {
            border-color: #00bfff;
            box-shadow: 0 0 5px rgba(0, 191, 255, 0.5);
        }

        .chat-input textarea {
            min-height: 100px;
            resize: none;
            overflow-y: hidden;
        }

        /* ปรับปุ่มให้ดูดีขึ้น */
        .chat-input button {
            background: #00bfff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            transition: 0.3s;
        }

        .chat-input button:hover {
            background: rgb(0, 3, 205);
        }
    </style>
</head>

<body>

    <div class="chat-container">
        <div class="chat-header">
            <i class="fa fa-comments"></i> Realtime Chat Room
        </div>
        <div class="chat-box" id="show"></div>
        <div class="chat-input">
            <form id="form">
                <input type="text" id="name" name="name" placeholder="ชื่อของคุณ..." required>
                <textarea id="txt" name="txt" placeholder="พิมพ์ข้อความ..." required></textarea>
                <button id="ok" type="submit">
                    <i class="fa fa-paper-plane"></i> ส่งข้อความ
                </button>
            </form>
        </div>
    </div>

    <script>
        //  JavaScript (jQuery) AJAX
        function loadChat() { // ฟังก์ชันแสดงข้อความในแชท
            $.ajax({ // ส่งคำร้องขอไปยังไฟล์ data.php
                type: "POST", // รูปแบบการส่งคำร้องขอ
                url: "data.php", // ไฟล์ที่จะส่งคำร้องขอไป
                data: {}, // ข้อมูลที่จะส่งไปกับคำร้องขอ
                success: function(data) { // ถ้าสำเร็จให้ทำงานในส่วนนี้
                    $("#show").html(data); // แสดงข้อความในแชท
                    $("#show").scrollTop($("#show")[0].scrollHeight); // ลากแถบเลื่อนลงด้านล่าง
                },
                dataType: "html" // รูปแบบของข้อมูลที่ส่งกลับมา
            });
        }

        loadChat(); // เรียกใช้ฟังก์ชันแสดงข้อความในแชท
        setInterval(loadChat, 2000); // รีเฟรชข้อความในแชททุก 2 วินาที

        $("#form").submit(function(e) { // เมื่อมีการส่งฟอร์ม
            e.preventDefault(); // หยุดการทำงานของฟอร์ม
            var formData = $("#form").serialize(); // ดึงข้อมูลจากฟอร์ม
            $.ajax({
                type: "POST",
                url: "insert.php",
                data: formData, // ส่งข้อมูลไปที่ไฟล์ insert.php
                success: function(response) { // ถ้าสำเร็จให้ทำงานในส่วนนี้
                    if ($.trim(response) == 'success') { // ถ้าสำเร็จ
                        $("#txt").val(""); // ล้างข้อความในช่องป้อนข้อความ
                        loadChat(); // แสดงข้อความใหม่
                    } else {
                        alert("❌ ส่งข้อความไม่สำเร็จ"); // ถ้าไม่สำเร็จให้แจ้งเตือน
                    }
                },
                dataType: "text" // รูปแบบของข้อมูลที่ส่งกลับมา
            });
        });

    </script>

</body>

</html>