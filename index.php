<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แชทออนไลน์</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(19, 18, 18); /* พื้นหลังดำ */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .chat-container {
            width: 400px;
            background: #1e1e1e; /* พื้นหลังเทาเข้ม */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            overflow: hidden;
            color: white;
        }

        .chat-header {
            background: #333; /* สีหัวข้อเทาเข้ม */
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .chat-box {
            height: 300px;
            overflow-y: auto;
            padding: 10px;
            display: flex;
            flex-direction: column;
            background: #2b2b2b; /* กล่องแชทสีเทาเข้ม */
            border-bottom: 1px solid #444;
        }

        .message {
            max-width: 70%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
        }

        .message.sent {
            align-self: flex-end;
            background: #007bff;
            color: white;
        }

        .message.received {
            align-self: flex-start;
            background: #444; /* ข้อความที่ได้รับเป็นสีเทา */
            color: white;
        }

        .chat-input {
    display: flex;
    flex-direction: column; /* จัดเรียง input และปุ่มให้อยู่ในแนวตั้ง */
    align-items: center;
    padding: 10px;
    background: #222;
    border-top: 1px solid #444;
    gap: 10px; /* เพิ่มระยะห่างระหว่าง input และ textarea */
}

.chat-input input,
.chat-input textarea {
    width: 90%; /* กำหนดให้กว้าง 90% ของ container */
    min-height: 40px;
    padding: 10px;
    border: 1px solid #555;
    border-radius: 5px;
    font-size: 14px;
    resize: none;
    background: #333;
    color: white;
}

.chat-input button {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    margin-left: auto; /* ดันปุ่มไปทางขวาสุด */
    margin-right: 5%; /* เหลือขอบข้างขวาให้สมดุล */
}

.chat-input button:hover {
    background: #0056b3;
}

    </style>
</head>
<body>

<div class="chat-container">
    <div class="chat-header">💬 Realtime Chat Room</div>
    <div class="chat-box" id="show"></div>
    <div class="chat-input">
        <form id="form">
            <input type="text" id="name" name="name" placeholder="ชื่อ">
            <textarea id="txt" name="txt" placeholder="พิมพ์ข้อความ..."></textarea>
            <button id="ok" type="submit"><i class="fa fa-paper-plane"></i></button>
        </form>
    </div>
</div>

<script>
    function loadChat() {
        $.ajax({
            type: "POST",
            url: "data.php",
            data: {},
            success: function(data) {
                $("#show").html(data);
            },
            dataType: "html"
        });
    }
    
    loadChat();
    setInterval(loadChat, 5000);

    $("#form").submit(function(e){
        e.preventDefault();
        var formData = $("#form").serialize();
        $.ajax({
            type: "POST",
            url: "insert.php",
            data: formData,
            success: function(response){
                if($.trim(response) == 'success') {
                    $("#txt").val(""); 
                    loadChat();
                } else {
                    alert("❌ ส่งข้อความไม่สำเร็จ");
                }
            },
            dataType: "text"
        });
    });
</script>

</body>
</html>
