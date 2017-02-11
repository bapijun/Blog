<?php
  require_once('connectvars.php');
  $user_id = "15";
  $user_name = "bapijun";
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>

<!DOCTYPE html>
  <head>
    <meta charset="utf8">
   </head>
<?php 
 
  $query = "SELECT type_name FROM article_type WHERE user_id = 15 ";
  $data = mysqli_query($dbc, $query);
  while($row = mysqli_fetch_array($data))
  {
  	echo $row['type_name'];
  	echo "<br />";
  }
?>
</html>