<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

if(!$conn )
{
  die('Could not connect: ' . mysqli_connect_error());
}
echo 'Connected successfully <br/>';


$sql = 'CREATE Database IF NOT EXISTS tripmates';
if(mysqli_query( $conn,$sql)){
  echo "Database created successfully.";
}
else{
echo "Sorry, database creation failed ".mysqli_error($conn);
}

mysqli_close($conn);
?>
