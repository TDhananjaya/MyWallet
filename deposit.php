<?php
  include 'header.php';
 ?>

 <?php

   if(isset($_SESSION['userId'])){
     echo "<div class='deposit' id='deposit'>
     <h1>Deposits in to wallet</h1>
     <br>
     <form action='includes/enterdeposit.include.php' method='post'>
       <table>
         <tr>
           <th>From</th>
           <th>Amount</th>
         </tr>
         <tr>
           <td>Home</td>
           <td><input type='number' name='home'></td>
         </tr>
         <tr>
           <td>Friend</td>
           <td><input type='number' name='friend'></td>
         </tr>
         <tr>
           <td>Bank</td>
           <td><input type='number' name='bank'></td>
         </tr>
         <tr>
           <td>Job</td>
           <td><input type='number' name='job'></td>
         </tr>
         <tr>
           <td>Other</td>
           <td><input type='number' name='other'></td>
         </tr>
       </table>
       <button class='b1' type='submit' name='button'>Next</button>
     </form>
     </div>";

   } else{
     echo "<button action='signup.php' type='button' name='button'>SignUp</button>";
   }
 ?>

  </body>
</html>
