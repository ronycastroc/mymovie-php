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

  $type = filter_input(INPUT_POST, "type");

  $userData = $userDao->verifyToken();

  if($type === "create") {

    $rating = filter_input(INPUT_POST, "rating");
    $review = filter_input(INPUT_POST, "review");
    $movie_id = filter_input(INPUT_POST, "movie_id");
    $user_id = $userData->id;

    $reviewObject = new Review();

    $movieData = $movieDao->findById($movie_id);

    if(!$movieData) {
      $message->setMessage("Invalid data!", "error", "/../index.php");
      return;
    }

    if(empty($rating) || empty($review)) {
      $message->setMessage("You need to add at least: rating and review!", "error", "back");
      return;
    }

    $reviewObject->rating = $rating;
    $reviewObject->review = $review;
    $reviewObject->movie_id = $movie_id;
    $reviewObject->user_id = $user_id;

    $reviewDao->create($reviewObject);

  }

?>