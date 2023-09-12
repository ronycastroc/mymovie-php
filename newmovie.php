<?php
  require_once("templates/header.php");
  require_once("models/User.php");
  require_once("dao/UserDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

?>
  <div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
      <h1 class="page-title">Add Movie</h1>
      <p class="page-description">Add your review!</p>
      <form action="<?= $BASE_URL ?>/processes/movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">
        <div class="mb-3">
          <label for="title" class="form-label">Title:</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Type the title of the movie">
        </div>
        <div class="mb-3 row">
          <label for="image" class="form-label">Image:</label>
          <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <div class="mb-3">
          <label for="length" class="form-label">Length:</label>
          <input type="text" class="form-control" id="length" name="length" placeholder="Type the length of the movie">
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category:</label>
          <select name="category" id="category" class="form-control">
            <option value="">Select</option>
            <option value="Action">Action</option>
            <option value="Drama">Drama</option>
            <option value="Comedy">Comedy</option>
            <option value="Science fiction">Science fiction</option>
            <option value="Romance">Romance</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="trailer" class="form-label">Trailer:</label>
          <input type="url" class="form-control" id="trailer" name="trailer" placeholder="Enter trailer link">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description:</label>
          <textarea name="description" id="description" rows="5" class="form-control" placeholder="Describe the movie..."></textarea>
        </div>
        <input type="submit" class="btn" id="card-btn" value="Add movie">
      </form>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>