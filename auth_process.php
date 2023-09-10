<?php 
  require_once("globals.php");
  require_once("db.php");
  require_once("models/User.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $userDao = new UserDAO($conn, $BASE_URL);

  $type = filter_input(INPUT_POST, "type");

  if($type === "signup") {
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

    if($userDao->findByEmail($email) !== false) {
      $message->setMessage("User already registered, try another email.", "error", "back");
      return;
    }

    $user = new User();
    
    $userToken = $user->generateToken();
    $finalPassword = $user->generatePassword($password);

    $user->name = $name;
    $user->lastname = $lastname;
    $user->email = $email;
    $user->password = $finalPassword;
    $user->token = $userToken;

    $auth = true;

    $userDao->create($user, $auth);


  }

  if($type === "login") {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    if(!$userDao->authenticateUser($email, $password)) {
      $message->setMessage("Incorrect username and/or password.", "error", "back");
      return;
    }

    $message->setMessage("Welcome!", "success", "/editprofile.php");

  }

?>