<?php

return $conn = mysqli_connect('localhost','root','','MyWallet');

if (!$conn) {
  die("Connection Failed : " . mysqli_connect_error());
}
