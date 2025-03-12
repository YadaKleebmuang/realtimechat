<?php
include('connect.php');

$sql="INSERT INTO chat(c_name,c_txt,c_time)VALUES('".$_REQUEST['name']."','".$_REQUEST['txt']."','".date("Y-m-d H:i:s")."')";
$res=mysqli_query($conn,$sql);
if($res){
echo"success";
}else{
echo"error";
}
?>