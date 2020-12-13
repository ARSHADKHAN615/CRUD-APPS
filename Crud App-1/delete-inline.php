<?php


$sid = $_GET['id'];
$sid2 = $_POST['sid'];
require "connection.php";

if (isset($_POST['sid'])) {
    $sql = "DELETE FROM students WHERE sid='$sid2'";
} elseif (isset($_GET['id'])) {
    $sql = "DELETE FROM students WHERE sid='$sid'";
}
$result = mysqli_query($connection, $sql) or die("unsuccessful");
header("location:index.php");
mysqli_close($connection);
