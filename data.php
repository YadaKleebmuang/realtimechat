<?php
include('connect.php');
$sql="SELECT * FROM chat ORDER BY c_time ASC";
$res=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($res)){
echo "(".$row['c_name'].") ".$row['c_txt']."<br>";
}
?>