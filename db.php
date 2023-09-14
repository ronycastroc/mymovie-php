<?php 

  $db = "mymovie";
  $host = "db"; //localhost
  $user = "root";
  $pass = "";
  
  try {
    $conn = new PDO ("mysql:dbname=$db;host=$host", $user, $pass);
  
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
  } catch(PDOException $e) {
    $error = $e->getMessage();
    echo "Erro: $error";
  }
  
?>
