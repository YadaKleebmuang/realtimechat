<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat Room</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
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

        .chat-container {
            width: 400px;
            background: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

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
        }

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

        .message {
            max-width: 75%;
            margin-bottom: 10px;
            padding: 12px;
            border-radius: 12px;
            font-size: 14px;
            word-wrap: break-word;
            display: inline-block;
        }

        .message.sent {
            align-self: flex-end;
            background: #007bff;
            color: white;
            text-align: right;
        }

        .message.received {
            align-self: flex-start;
            background: #444;
            color: white;
        }

        .chat-input {
            padding: 12px;
            background: #222;
            border-top: 1px solid #444;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

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
            background:rgb(0, 3, 205);
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
        function loadChat() {
            $.ajax({
                type: "POST",
                url: "data.php",
                data: {},
                success: function(data) {
                    $("#show").html(data);
                    $("#show").scrollTop($("#show")[0].scrollHeight);
                },
                dataType: "html"
            });
        }

        loadChat();
        setInterval(loadChat, 5000);

        $("#form").submit(function(e) {
            e.preventDefault();
            var formData = $("#form").serialize();
            $.ajax({
                type: "POST",
                url: "insert.php",
                data: formData,
                success: function(response) {
                    if ($.trim(response) == 'success') {
                        $("#txt").val("");
                        loadChat();
                    } else {
                        alert("❌ ส่งข้อความไม่สำเร็จ");
                    }
                },
                dataType: "text"
            });
        });

        $("#txt").on("input", function() {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        });
    </script>

</body>

</html>