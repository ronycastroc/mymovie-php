<?php 
  require_once(__DIR__ . "/../globals.php");
  require_once(__DIR__ . "/../db.php");
  require_once(__DIR__ . "/../models/Movie.php");
  require_once(__DIR__ . "/../models/Message.php");
  require_once(__DIR__ . "/../models/Review.php");
  require_once(__DIR__ . "/../dao/UserDAO.php");
  require_once(__DIR__ . "/../dao/MovieDAO.php");
  require_once(__DIR__ . "/../dao/ReviewDAO.php");
  
  $message = new Message($BASE_URL);
  $userDao = new UserDAO($conn, $BASE_URL);
  $movieDao = new MovieDAO($conn, $BASE_URL);
  $reviewDao = new ReviewDAO($conn, $BASE_URL);

  if($type === "create") {}

?>