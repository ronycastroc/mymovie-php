<?php
  require_once("templates/header.php");
  require_once("models/User.php");
  require_once("dao/UserDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $fullName = $user->getFullName($userData);

  if($userData->image == "") {
    $userData->image = "user.png";
  }
  
?>
  <div id="main-container" class="container-fluid edit-profile-page">
    <div class="col-md-12">
      <form action="<?= $BASE_URL ?>/user_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="update">
        <div class="row">
          <div class="col-md-4">
            <h1><?= $fullName ?></h1>
            <p class="page-description">Change your details in the form below:</p>
            <div class="mb-3">
              <label for="name" class="form-label">Name:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Type your name" value="<?= $userData->name ?>">
            </div>
            <div class="mb-3">
              <label for="lastname" class="form-label">Lastname:</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Type your lastname" value="<?= $userData->lastname ?>">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">E-mail:</label>
              <input type="text" readonly class="form-control disabled" id="email" name="email" placeholder="Type your e-mail" value="<?= $userData->email ?>">
            </div>
            <div class="mb-3">
            <input type="submit" class="btn" id="card-btn" value="Update">
            </div>            
          </div>
          <div class="col-md-4">
            <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>/img/users/<?= $userData->image ?>')"></div>
            <div class="mb-3 row">
              <label for="image" class="form-label">Image:</label>
              <input type="file" class="form-control-file" name="image">
            </div>
            <div class="mb-3">
              <label for="bio" class="form-label">About you:</label>
              <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Tell about yourself..."><?= $userData->bio ?></textarea>
            </div>
          </div>
        </div>
      </form>
      <div class="row" id="change-password-container">
        <div class="col-md-4">
          <h2>Change password:</h2>
          <p class="page-description">Type the new password and confirm to change your password:</p>
          <form action="<?= $BASE_URL ?>/user_process.php" method="POST">
            <input type="hidden" name="type" value="changepassword">
            <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Type your new password">
            </div>
            <div class="mb-3">
              <label for="confirmpassword" class="form-label">Confirm password:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm your new passwword">
            </div>
            <input type="submit" class="btn" id="card-btn" value="Update password">
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>