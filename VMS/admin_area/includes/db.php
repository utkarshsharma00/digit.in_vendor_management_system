<?php 
// After uploading to online server, change this connection accordingly

$con = mysqli_connect("localhost","id6577969_vms","123456789","id6577969_vms");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


?>