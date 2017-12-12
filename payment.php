<?php
  include 'header.php';
 ?>

 <?php

   if(isset($_SESSION['userId'])){
     echo "
     <div class='payment' id='payment'>
     <h1>Payments</h1>
     <br>
     <form action='includes/enterpayment.include.php' method='post'>
       <table>
         <tr>
           <th>To</th>
           <th>Amount</th>
         </tr>
         <tr>
           <td>Breakfast</td>
           <td><input type='number' name='breakfast' value=''></td>
         </tr>
         <tr>
           <td>Lunch</td>
           <td><input type='number' name='lunch' value=''></td>
         </tr>
         <tr>
           <td>Dinner</td>
           <td><input type='number' name='dinner' value=''></td>
         </tr>
         <tr>
           <td>Drinks</td>
           <td><input type='number' name='drinks' value=''></td>
         </tr>
         <tr>
           <td>Other food</td>
           <td><input type='number' name='otherf' value=''></td>
         </tr>
         <tr>
           <td>Transport</td>
           <td><input type='number' name='transport' value=''></td>
         </tr>
         <tr>
           <td>Stationary</td>
           <td><input type='number' name='stationary' value=''></td>
         </tr>
         <tr>
           <td>Funds</td>
           <td><input type='number' name='funds' value=''></td>
         </tr>
         <tr>
           <td>Other</td>
           <td><input type='number' name='other' value=''></td>
         </tr>
       </table>
       <button class='b1' type='submit' name='button'>Submit</button>
     </form></div>";

   } else{
     echo "<button action='signup.php' type='submit' name='button'>SignUp</button>";
   }
 ?>

  </body>
</html>
