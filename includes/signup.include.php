<?php
  session_start();
  include '../database.php';

  date_default_timezone_set("Asia/Colombo");

  $firstName=$_POST['firstName'];
  $lastName=$_POST['lastName'];
  $userName=$_POST['userName'];
  $password=$_POST['password'];

  $sql="SELECT userName FROM user WHERE userName='$userName'";
  $result=$conn->query($sql);
  $userNameCheck=mysqli_num_rows($result);

  if($userNameCheck>0){
    header("Location: ../signup.php?error=username");
    exit();
  }
  else{
  $sql="INSERT INTO user(firstName,lastName,userName,password)
        VALUES('$firstName','$lastName','$userName','$password')";
  $result=$conn->query($sql);

  $sql="SELECT userId FROM user WHERE userName='$userName' AND password='$password'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $userId=$raw['userId'];

  $sql="INSERT INTO wallet(userId) VALUES('$userId')";
  $result=$conn->query($sql);

  $sql="CREATE TABLE ".$userName."_deposit (depositId INT AUTO_INCREMENT PRIMARY KEY, home DECIMAL(19,2),
        friend DECIMAL(19,2),bank DECIMAL(19,2),job DECIMAL(19,2),other DECIMAL(19,2),dsum DECIMAL(19,2))";
  $result=$conn->query($sql);

  $sql="CREATE TABLE ".$userName."_payment (paymentId INT AUTO_INCREMENT PRIMARY KEY, breakfast DECIMAL(19,2),
        lunch DECIMAL(19,2),dinner DECIMAL(19,2),drinks DECIMAL(19,2),otherf DECIMAL(19,2),transport DECIMAL(19,2),
        stationary DECIMAL(19,2),funds DECIMAL(19,2),other DECIMAL(19,2),psum DECIMAL(19,2))";
  $result=$conn->query($sql);

  $sql="CREATE TABLE ".$userName."_graph (amountId INT AUTO_INCREMENT PRIMARY KEY, amount DECIMAL(19,2),
        deposit DECIMAL(19,2),payment DECIMAL(19,2),dateposted DATE)";
  $result=$conn->query($sql);


  /*$sql="INSERT INTO payments(userId) VALUES('$userId')";
  $result=$conn->query($sql);

  $sql="INSERT INTO deposit(userId) VALUES('$userId')";
  $result=$conn->query($sql);*/

  header("Location: ../welcome.php");
  }
