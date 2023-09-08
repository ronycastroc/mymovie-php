<?php 
  require_once("globals.php");
  require_once("db.php");
  require_once("models/User.php");
  require_once("models/User.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $type = filter_input(INPUT_POST, "type");

  if($type === "register") {
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    if(!$name || !$lastname || !$email || !$password) {
      $message->setMessage("Please fill in all fields.", "error", "back");
      return;
    }

    if ($password !== $confirmpassword) {
      $message->setMessage("Passwords are not the same", "error", "back");
      return;
    }

  }

  if($type === "login") {}

?>