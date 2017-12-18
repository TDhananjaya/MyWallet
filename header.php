<?php
  session_start();
  include 'database.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MyWallet</title>
    <link rel="stylesheet" type="text/css" href="css/styleheader.css">
    <link rel="stylesheet" type="text/css" href="css/stylehome.css">
    <link rel="stylesheet" type="text/css" href="css/depositandpayment.css">

    <script src="chart/Chart.bundle.js"></script>
    <script src="chart/samples/utils.js"></script>
    <style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>

  </head>
  <body>
        <?php
            if(isset($_SESSION['userId'])){
              echo "<div class='head'>My Wallet<form class='logout' action='includes/logout.include.php'>
                <button type='submit'>Logout</button>
              </form></div>";
            } else{
              echo "<div class='head'>My Wallet<form class='login' action='includes/login.include.php' method='post'>
                <input type='text' name='userName' placeholder='Type Username' required>
                <input type='password' name='password' placeholder='Type Password' required>
                <button type='submit' name='login'>Login</button>
              </form></div>";
              }
        ?>
