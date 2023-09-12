<?php
  require_once("templates/header.php");

  require_once("models/Movie.php");
  require_once("dao/MovieDAO.php");

  $id = filter_input(INPUT_GET, "id");

  $movie;
  $movieDao = new MovieDAO($conn, $BASE_URL);
  $reviewDao = new ReviewDAO($conn, $BASE_URL);

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

  $userOwnsMovie = false;

  if (!empty($userData)) {

    if ($userData->id === $movie->user_id) {
      $userOwnsMovie = true;
    }

    $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);
  }

  $movieReviews = $reviewDao->getMoviesReview($movie->id);

?>
  <div id="main-container" class="container-fluid">
    <div class="row">
      <div class="offset-md-1 col-md-6 movie-container">
        <h1 class="page-title"><?= $movie->title ?></h1>
        <p class="movie-details">
          <span>Length: <?= $movie->length ?></span>
          <span class="pipe"></span>
          <span><?= $movie->category ?></span>
          <span class="pipe"></span>
          <span><i class="fas fa-star"></i> <?= $movie->rating ?></span>
        </p>
        <iframe src="<?= $movie->trailer ?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p><?= $movie->description ?></p>
      </div>
      <div class="col-md-4">
        <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>/img/movies/<?= $movie->image ?>')"></div>
      </div>
      <div class="offset-md-1 col-md-10" id="reviews-container">
        <h3 id="reviews-title">Rating:</h3>
        <?php if(!empty($userData) && !$userOwnsMovie && !$alreadyReviewed): ?>      
          <div class="col-md-12" id="review-form-container">
            <h4>Submit your review:</h4>
            <p class="page-description">Fill in the form with your rating and comment about the film</p>
            <form action="<?= $BASE_URL ?>/processes/review_process.php" id="review-form" method="POST">
              <input type="hidden" name="type" value="create">
              <input type="hidden" name="movie_id" value="<?= $movie->id ?>">
              <div class="mb-3">
                <label for="rating" class="form-label">Rating movie:</label>
                <select name="rating" id="rating" class="form-control">
                  <option value="">Select</option>
                  <option value="10">10</option>
                  <option value="9">9</option>
                  <option value="8">8</option>
                  <option value="7">7</option>
                  <option value="6">6</option>
                  <option value="5">5</option>
                  <option value="4">4</option>
                  <option value="3">3</option>
                  <option value="2">2</option>
                  <option value="1">1</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="review" class="form-label">Your review:</label>
                <textarea name="review" id="review" rows="3" class="form-control" placeholder="What did you think of the movie??"></textarea>
              </div>
              <input type="submit" class="btn" id="card-btn-sm" value="Send review">
            </form>
          </div>
        <?php endif; ?>
        <?php foreach($movieReviews as $review): ?>
          <?php require("templates/user_review.php"); ?>
        <?php endforeach; ?>
        <?php if(count($movieReviews) === 0): ?>
          <p class="empty-list">There are no reviews for this movie yet...</p>
        <?php endif; ?>
      </div>
    </div>
  </div>     
<?php
  require_once("templates/footer.php");
?>