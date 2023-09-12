<?php 
  require_once(__DIR__ . "/../globals.php");
  require_once(__DIR__ . "/../db.php");
  require_once(__DIR__ . "/../models/Movie.php");
  require_once(__DIR__ . "/../models/Message.php");
  require_once(__DIR__ . "/../dao/UserDAO.php");
  require_once(__DIR__ . "/../dao/MovieDAO.php");

  $message = new Message($BASE_URL);
  $userDao = new UserDAO($conn, $BASE_URL);
  $movieDao = new MovieDAO($conn, $BASE_URL);

  $type = filter_input(INPUT_POST, "type");

  $userData = $userDao->verifyToken();

  if($type === "create") {

    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie();

    if(empty($title) || empty($description) || empty($category)) {
      $message->setMessage("You need to add at least: title, description and category!", "error", "back");
      return;
    }

    $movie->title = $title;
    $movie->description = $description;
    $movie->trailer = $trailer;
    $movie->category = $category;
    $movie->length = $length;
    $movie->user_id = $userData->id;

     //  first enable folder permissions to save files: "chmod 777 ./img/movies/"
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
      $image = $_FILES["image"];
      $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
      $jpgArray = ["image/jpeg", "image/jpg"];
      $pngArray = ["image/png"];

      if(!in_array($image["type"], $imageTypes)) {
        $message->setMessage("Invalid image type, please enter png or jpg!", "error", "back");
        return;
      }
      
      $imageName = $movie->imageGenerateName();

      $target_dir = __DIR__ . "/../img/movies/";
      $target_file = $target_dir . $imageName;

      move_uploaded_file($image["tmp_name"], $target_file);
      
      $movie->image = $imageName;

    }

    $movieDao->create($movie);    

  }


  if($type === "delete") {

     $id = filter_input(INPUT_POST, "id");

     $movie = $movieDao->findById($id);
 
     if(!$movie) {
      $message->setMessage("Invalid data!", "error", "/../index.php");
      return;
     }

    if($movie->user_id !== $userData->id) {
      $message->setMessage("Invalid data!", "error", "/../index.php");
      return;
    }
 
    $movieDao->destroy($movie->id);

  }

  if($type === "update") {

    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    $id = filter_input(INPUT_POST, "id");

    $movieData = $movieDao->findById($id);

    if(!$movieData) {
      $message->setMessage("Invalid data movie!", "error", "/../index.php");
      return;
    }

    if($movieData->user_id !== $userData->id) {
      $message->setMessage("Invalid data id!", "error", "/../index.php");
      return;
    }

    if(empty($title) || empty($description) || empty($category)) {
      $message->setMessage("You need to add at least: title, description and category!", "error", "back");
      return;
    }

    $movieData->title = $title;
    $movieData->description = $description;
    $movieData->trailer = $trailer;
    $movieData->category = $category;
    $movieData->length = $length;

     //  first enable folder permissions to save files: "chmod 777 ./img/movies/"
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
      $image = $_FILES["image"];
      $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
      $jpgArray = ["image/jpeg", "image/jpg"];
      $pngArray = ["image/png"];

      if(!in_array($image["type"], $imageTypes)) {
        $message->setMessage("Invalid image type, please enter png or jpg!", "error", "back");
        return;
      }

      $movie = new Movie();
      
      $imageName = $movie->imageGenerateName();

      $target_dir = __DIR__ . "/../img/movies/";
      $target_file = $target_dir . $imageName;

      move_uploaded_file($image["tmp_name"], $target_file);
      
      $movieData->image = $imageName;

    }

    $movieDao->update($movieData);    
  }

?>