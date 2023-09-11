<?php 
  require_once("templates/header.php");

  require_once("models/Movie.php");
  require_once("dao/MovieDAO.php");

  $id = filter_input(INPUT_GET, "id");

  $movie;

  $movieDao = new MovieDAO($conn, $BASE_URL);

  if(empty($id)) {
    $message->setMessage("The movie was not found!", "error", "/index.php");
    return;
  } 

  $movie = $movieDao->findById($id);
  
  if(!$movie) {
    $message->setMessage("The movie was not found!", "error", "/index.php");    
    return; 
  }
  
  if(empty($movie->image)) {
    $movie->image = "movie_cover.jpg";
  }

  $userOwnsMovie = false;

  if(!empty($userData)) {

    if($userData->id === $movie->user_id) {
      $userOwnsMovie = true;
    }
    
    // reviews movie   
 
  }

?>