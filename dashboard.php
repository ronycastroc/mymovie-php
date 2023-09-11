<?php
  require_once("templates/header.php");
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);
  $movieDao = new MovieDAO($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $userMovies = $movieDao->getMoviesByUserId($userData->id);

?>
<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Add or update information for movies you've uploaded</p>
    <div class="col-md-12" id="add-movie-container">
      <a href="<?= $BASE_URL ?>/newmovie.php" class="btn w-25 mb-3" id="card-btn">
        <i class="fas fa-plus"></i> Add Movie
      </a>
    </div>
    <div class="col-md-12" id="movies-dashboard">
      <table class="table-dark w-100">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Rating</th>
            <th scope="col" class="actions-column">Actions</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php foreach($userMovies as $movie): ?>
          <tr>
            <td scope="row"><?= $movie->id ?></td>
            <td><a href="<?= $BASE_URL ?>/movie.php?id=<?= $movie->id ?>" class="table-movie-title"><?= $movie->title ?></a></td>
            <td><i class="fas fa-star"></i> 9</td>
            <td class="actions-column">
              <a href="<?= $BASE_URL ?>/editmovie.php?id=<?= $movie->id ?>" class="edit-btn">
                <i class="far fa-edit"></i> Edit
              </a>
              <form action="<?= $BASE_URL ?>/movie_process.php" method="POST">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $movie->id ?>">
                <button type="submit" id="delete-btn">
                  <i class="fas fa-times"></i> Delete
                </button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>