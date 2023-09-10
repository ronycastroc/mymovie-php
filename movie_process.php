<?php 
  require_once("globals.php");
  require_once("db.php");
  require_once("models/Movie.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

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
    $movie->users_id = $userData->id;

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

      $target_dir = "./img/movies/";
      $target_file = $target_dir . $imageName;

      move_uploaded_file($image["tmp_name"], $target_file);
      
      $movie->image = $imageName;

    }

    $movieDao->create($movie);    

  }


?>