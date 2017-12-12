<?php
  session_start();
  include '../database.php';

  date_default_timezone_set("Asia/Colombo");
  $userId=$_SESSION['userId'];
  $amount=$_POST['amount'];
  $date=date('Y-m-d');

  $sql="SELECT userName FROM user WHERE userId='$userId'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $userName=$raw['userName'];

  $sql="UPDATE wallet SET amount='$amount' WHERE userId='$userId'";
  $result=$conn->query($sql);

  $sql="UPDATE wallet SET dateposted='$date'  WHERE userId='$userId'";
  $result=$conn->query($sql);

  $sql="INSERT INTO ".$userName."_graph (amount,dateposted) VALUES('$amount','$date')";
  $result=$conn->query($sql);
  //echo $sql;
  header("Location: ../welcome.php");
