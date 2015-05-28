<?php  
  session_start();
  require_once '../check_session/connect_mysql.php';
  require_once '../check_session/needAuth.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="My_PhpMyAdmin" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<link rel="stylesheet" media="screen" type="text/css" title="style1" href="css/style.css">
    <script type="text/javascript" src="js/functions.js"></script>
	<title>My_PhpMyAdmin</title>
</head>
<body>
  <a href="deconnexion.php">Se deconnecter</a><br>
  <?php
    if (isset($connect))
    {
      $query = "show databases";
      $result = mysqli_query($connect, $query);
      if (!$result)
      {
        echo "ERROR";
      }
      while ($data = mysqli_fetch_row($result))
      {
        echo "<a href='affiche_database.php?db=" . $data[0] . "'>" . $data[0] . "<br>";
      }  
    }
  ?>

</body>
<footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
</footer>