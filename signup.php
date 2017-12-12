<?php
  include 'header.php';
 ?>
    <?php
    $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(strpos($url,'error=username')){
      echo "<div class='error1'>username already exists!!!</div>" ;
    }
    //echo $url;
      if(isset($_SESSION['userId'])){
        echo "You are already logged in";
        header("Location: home.php");
        exit();
      } else{
        echo "<div class='panel'><div class='today'>Signup today!!!</div>
          <form class='signup' action='includes/signup.include.php' method='post'><br>
          <input type='text' name='firstName' placeholder='First Name' required><br>
          <input type='text' name='lastName' placeholder='Last Name'><br>
          <input type='text' name='userName' placeholder='User Name' required><br>
          <input type='password' name='password' placeholder='Password' required><br>
          <button type='submit' name='submit'>Sign Up!</button>
        </form></div>";
      }
    ?>

  </body>
</html>
