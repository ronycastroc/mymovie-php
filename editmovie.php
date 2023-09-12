<?php
  require_once("templates/header.php");

  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $movieDao = new MovieDAO($conn, $BASE_URL);

  $id = filter_input(INPUT_GET, "id");

  if (empty($id)) {
    $message->setMessage("The movie was not found!", "error", "/index.php");
    return;
  }

  $movie = $movieDao->findById($id);


  if (!$movie) {
    $message->setMessage("The movie was not found!", "error", "/index.php");
    return;
  }

  if (empty($movie->image)) {
    $movie->image = "movie_cover.jpg";
  }

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 offset-md-1">
          <h1><?= $movie->title ?></h1>
          <p class="page-description">Change the movie data in the form below:</p>
          <form action="<?= $BASE_URL ?>/processes/movie_process.php" id="edit-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="mb-3">
              <label for="title" class="form-label">Title:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Type the title of the movie" value="<?= $movie->title ?>">
            </div>
            <div class="mb-3 row">
              <label for="image" class="form-label">Image:</label>
              <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="mb-3">
              <label for="length" class="form-label">Length:</label>
              <input type="text" class="form-control" id="length" name="length" placeholder="Type the length of the movie" value="<?= $movie->length ?>">
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Category:</label>
              <select name="category" id="category" class="form-control">
                <option value="">Select</option>
                <option value="Action" <?= $movie->category === "Action" ? "selected" : "" ?>>Action</option>
                <option value="Drama" <?= $movie->category === "Drama" ? "selected" : "" ?>>Drama</option>
                <option value="Comedy" <?= $movie->category === "Comedy" ? "selected" : "" ?>>Comedy</option>
                <option value="Science fiction" <?= $movie->category === "Science fiction" ? "selected" : "" ?>>Science fiction</option>
                <option value="Romance" <?= $movie->category === "Romance" ? "selected" : "" ?>>Romance</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="trailer" class="form-label">Trailer:</label>
              <input type="url" class="form-control" id="trailer" name="trailer" placeholder="Enter trailer link" value="<?= $movie->trailer ?>">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description:</label>
              <textarea name="description" id="description" rows="5" class="form-control" placeholder="Describe the movie..."><?= $movie->description ?></textarea>
            </div>
            <input type="submit" class="btn" id="card-btn-sm" value="Edit movie">
          </form>
        </div>
        <div class="col-md-3">
          <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>/img/movies/<?= $movie->image ?>')"></div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>