<?php

  require_once("globals.php");
  require_once("db.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $flassMessage = $message->getMessage();

  if(!empty($flassMessage["msg"])) {
    $message->clearMessage();
  }

  $userDao = new UserDAO($conn, $BASE_URL);

  $userData = $userDao->verifyToken(false);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyMovie</title>
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.css" integrity="sha512-azoUtNAvw/SpLTPr7Z7M+5BPWGOxXOqn3/pMnCxyDqOiQd4wLVEp0+AqV8HcoUaH02Lt+9/vyDxwxHojJOsYNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <header>
    <nav id="main-navbar" class="navbar navbar-expand-lg">
      <a href="<?= $BASE_URL ?>" class="navbar-brand">
        <img src="<?= $BASE_URL ?>/img/logo.svg" alt="MovieStar" id="logo">
        <span id="moviestar-title">MyMovie</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <form action="<?= $BASE_URL ?>/search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
        <div class="input-wrapper">
          <input type="text" name="q" id="search" class="form-control" type="search" placeholder="Search Movies" aria-label="Search">
          <button class="btn my-2 my-sm-0" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav">
        <?php if($userData): ?>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>/newmovie.php" class="nav-link">
                <i class="far fa-plus-square"></i> Add Movie
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>/dashboard.php" class="nav-link">My Movies</a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>/editprofile.php" class="nav-link bold">
                <?= $userData->name ?>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>/logout.php" class="nav-link">Log Out</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
            <a href="<?= $BASE_URL ?>/auth.php" class="nav-link">Log In / Sign Up</a>
            </li>
          <?php endif; ?>          
        </ul>
      </div>
    </nav>
  </header>
  <?php if(!empty($flassMessage["msg"])): ?>
    <div class="msg-container">
      <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
    </div>
  <?php endif; ?>