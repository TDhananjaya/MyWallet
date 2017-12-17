<?php
  ob_start();
  session_start();
  include '../database.php';

  $userId=$_SESSION['userId'];

  $sql="SELECT userName FROM user WHERE userId='$userId'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $userName=$raw['userName'];

  $breakfast=$_POST['breakfast'];
  $lunch=$_POST['lunch'];
  $dinner=$_POST['dinner'];
  $drinks=$_POST['drinks'];
  $otherf=$_POST['otherf'];
  $transport=$_POST['transport'];
  $stationary=$_POST['stationary'];
  $funds=$_POST['funds'];
  $other=$_POST['other'];
  $psum=$breakfast+$lunch+$dinner+$drinks+$otherf+$transport+$stationary+$funds+$other;
  date_default_timezone_set("Asia/Colombo");
  $date=date('Y-m-d');

  $sql="SELECT amount FROM wallet WHERE userId='$userId'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $lastAmount=$raw['amount'];

  $amount=$lastAmount-$psum;

  $sql="INSERT INTO ".$userName."_payment(breakfast,lunch,dinner,drinks,otherf,transport,stationary,funds,other,psum)
        VALUES('$breakfast','$lunch','$dinner','$drinks','$otherf','$transport','$stationary','$funds','$other','$psum')";
  $result=$conn->query($sql);

  $sql="UPDATE wallet SET amount='$amount', dateposted='$date' WHERE userId='$userId'";
  $result=$conn->query($sql);

  $sql="UPDATE ".$userName."_graph SET payment='$psum', amount='$amount' WHERE dateposted='$date'";
  $result=$conn->query($sql);

  //$sql="UPDATE wallet SET dateposted='$date'  WHERE userId='$userId'";
  //$result=$conn->query($sql);


  //echo $sql;
  header("Location: ../home.php");
  ob_end_flush();
