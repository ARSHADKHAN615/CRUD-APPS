<?php

 
$sid=$_POST['sid'];
$username=$_POST['sname'];
$address=$_POST['saddress'];
$class=$_POST['sclass'];
$phone=$_POST['sphone'];


require "connection.php";
$sql="UPDATE students SET `sname`='$username',`saddress`='$address',`sclass`='$class',`sphone`='$phone' WHERE `sid`=$sid";
 
$result=mysqli_query($connection,$sql) OR die("unsuccessful");

header("location:index.php");
mysqli_close($connection);
?>

 