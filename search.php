<?php
  require_once("templates/header.php");

  require_once("dao/MovieDAO.php");

  $movieDao = new MovieDAO($conn, $BASE_URL);

  $q = filter_input(INPUT_GET, "q");

  $movies = $movieDao->findByTitle($q);

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title" id="search-title">You are searching for: <span id="search-result"><?= $q ?></span></h2>
    <p class="section-description">Search results returned based on your search.</p>
    <div class="movies-container">
      <?php foreach($movies as $movie): ?>
        <?php require("templates/movie_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($movies) === 0): ?>
        <p class="empty-list">There are no movies for this search. <a href="<?= $BASE_URL ?>" class="back-link">Back</a>.</p>
      <?php endif; ?>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>