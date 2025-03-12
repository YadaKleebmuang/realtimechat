<html>
    <head>
        <meta charset="utf-8">
        <title>แชท</title>
    </head>
<body style="text-align: center;">
    <br>
    <form action="" id="form">
        <input type="text" id="name" name="name" placeholder="ชื่อ"><br>
        <textarea name="txt"  id="txt" placeholder="ข้อความ" cols="30" rows="10"></textarea><br>
        <button id="ok" type="submit">ส่งข้อความ</button>
    </form>

    <div id="show">
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  cat='-';
  function load(){
    $.ajax({
  type: "POST",
  url: "data.php",
  data: {dd:''},
  success: function(data){
 
$("#show").html(data)
cat=data;
  },
  dataType: "html"
});  
  }
 load();
    setInterval(function(){
    $.ajax({
  type: "POST",
  url: "data.php",
  data: {dd:''},
  success: function(data2){
if(data2!=cat){
    cat=data2;
$("#show").html(data2)
}
$("#show").html(data2)
  },
  dataType: "html"
});
    },5000);

    $("#form").submit(function(e){
var form=$("#form").serialize(); 

console.log(form);
$.ajax({
  type: "POST",
  url: "insert.php",
  data: form,
  success: function(datainsert){
 if($.trim(datainsert)!='success'){
alert('ส่งข้อความผิดพลลาด');
 }else{
    load();
 }

  },
  dataType: "text"
});  

e.preventDefault();
    });
</script>
</body>
</html>