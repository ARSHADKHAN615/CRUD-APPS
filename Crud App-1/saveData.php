<?php
$username=$_POST['sName'];
$address=$_POST['sAddress'];
$class=$_POST['class'];
$phone=$_POST['sPhone'];


require "connection.php";
$sql= "insert into `students` (`sname`, `saddress`, `sclass`,`sphone`) values ('$username', '$address', '$class', '$phone')";

$result=mysqli_query($connection,$sql) OR die("unsuccessful");

header("location:index.php");
mysqli_close($connection);
?>