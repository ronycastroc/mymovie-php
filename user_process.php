<?php 
  require_once("globals.php");
  require_once("db.php");
  require_once("models/User.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $userDao = new UserDAO($conn, $BASE_URL);

  $type = filter_input(INPUT_POST, "type");

  if($type === "update") {   
    $userData = $userDao->verifyToken();
    
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");
    
    $user = new User();
    
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    //  first enable folder permissions to save files: "chmod 777 ./img/users/"
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {      
      $image = $_FILES["image"];
      $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
      $jpgArray = ["image/jpeg", "image/jpg"];
      $pngArray = ["image/png"];
      
      if(!in_array($image["type"], $imageTypes)) {
        $message->setMessage("Invalid image type, please enter png or jpg!", "error", "back");
        return;
      }

      $imageName = $user->imageGenerateName();

      $target_dir = "./img/users/";
      $target_file = $target_dir . $imageName;

      move_uploaded_file($image["tmp_name"], $target_file);

      if(!move_uploaded_file($image["tmp_name"], $target_file)) {
        $message->setMessage("An error occurred while uploading the file!", "error", "back");        
      }
      
      $userData->image = $imageName;
    }   

    $userDao->update($userData);

  }

  if($type === "changepassword") {}

?>