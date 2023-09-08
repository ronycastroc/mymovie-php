<?php
  require_once("templates/header.php");
?>
<div id="main-container" class="container-fluid">
  <div class="col-md-12">
    <div class="row" id="auth-row">
      <div class="col-md-4" id="login-container">
        <h2>Log In</h2>
        <form action="<?= $BASE_URL ?>/auth_process.php" method="POST">
          <input type="hidden" name="type" value="login">
          <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Type your e-mail">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Type your password">
          </div>
          <input type="submit" class="btn" id="card-btn" value="Log In">
        </form>
      </div>
      <div class="col-md-4" id="register-container">
        <h2>Sign Up</h2>
        <form action="<?= $BASE_URL ?>/auth_process.php" method="POST">
          <input type="hidden" name="type" value="signup">
          <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Type your e-mail">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Type your name">
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Lastname:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Type your lastname">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Type your password">
          </div>
          <div class="mb-3">
            <label for="confirmpassword" class="form-label">Confirm password:</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm your password">
          </div>
          <input type="submit" class="btn" id="card-btn" value="Sign Up">
        </form>
      </div>
    </div>
  </div>
</div>
<?php
  require_once("templates/footer.php");
?>