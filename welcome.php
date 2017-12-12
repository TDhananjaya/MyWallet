<?php
  session_start();
  include 'database.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MyWallet</title>
    <script src="js/welcome.js"></script>
    <link rel="stylesheet" type="text/css" href="css/stylewelcome.css">

  </head>
  <body>
    <h3>Welcome to My Wallet!!!</h3>

     <?php
       if(isset($_SESSION['userId'])){
              date_default_timezone_set("Asia/Colombo");
              
              $userId=$_SESSION['userId'];
              $sql="SELECT amount FROM wallet WHERE userId=$userId";
              $res=$conn->query($sql);
              $raw=$res->fetch_assoc();
              $amount=$raw['amount'];

              $sql="SELECT firstName FROM user WHERE userId='$userId'";
              $result=$conn->query($sql);
              $raw=$result->fetch_assoc();
              $firstName=$raw['firstName'];

              if ($amount>0) {
                echo "<br><script>hide();</script>
                      <div class='smile'>:)</div><br>
                      <div class='end'>It's ok <br> After some exchanges come back</div> <br>
                      <form action='includes/logout.include.php'>
                        <button type='submit'>Logout</button>
                      </form>";
              }else {
                echo "<div id='getstart'><div class='hi'>Hi ".$firstName."...<br> happy to see you!<br> Manage your wallet more efficiently
                     with<br>My Wallet...</div><br><button type='button' onclick='show()' name='login'>Get Started!</button></div>";
              }

       } else{
         echo "<div class='loginlabel'>Please log in to my wallet using your user name and password</div><br>
            <form class='loginform' action='includes/newuserlogin.include.php' method='post'>
            <input class='textbox' type='text' name='userName' placeholder='Type Username' required><br>
            <input class='textbox' type='password' name='password' placeholder='Type Password' required><br>
            <button type='submit' name='login'>Login</button>
            </form>";
       }
     ?>

      <br>

    <div id="fillit" style="visibility:hidden">
      <div class="howmuch">Look into your wallet,<br>
      How much money in your wallet now?</div>
      <form action="includes/enterfirst.include.php" method="POST">
        <input class="amounttextbox" type="number" name="amount" placeholder="Enter amount"><br>
        <button type="submit" name="button" onclick="show()">Next</button>
      </form>
    </div>

  </body>
</html>
