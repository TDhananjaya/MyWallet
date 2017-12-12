<?php
  session_start();
  include '../database.php';

  $userId=$_SESSION['userId'];

  $sql="SELECT userName FROM user WHERE userId='$userId'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $userName=$raw['userName'];

  date_default_timezone_set("Asia/Colombo");

  $home=$_POST['home'];
  $friend=$_POST['friend'];
  $bank=$_POST['bank'];
  $job=$_POST['job'];
  $other=$_POST['other'];
  $dsum=$home+$friend+$bank+$job+$other;
  $date=date('Y-m-d');

  $sql="SELECT amount FROM wallet WHERE userId='$userId'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $lastAmount=$raw['amount'];

  $amount=$lastAmount+$dsum;

  $sql="INSERT INTO ".$userName."_deposit(home,friend,bank,job,other,dsum) VALUES('$home','$friend','$bank','$job','$other','$dsum')";
  $result=$conn->query($sql);

  $sql="UPDATE wallet SET amount='$amount', dateposted='$date' WHERE userId='$userId'";
  $result=$conn->query($sql);

  $sql="INSERT INTO ".$userName."_graph (deposit,dateposted) VALUES('$dsum','$date')";
  $result=$conn->query($sql);

  //echo $sql;
  header("Location: ../payment.php");
