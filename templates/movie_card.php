<?php 
  if(empty($movie->image)) {
    $movie->image = "movie_cover.jpg";
  }
?>
<div class="card" id="movie-card">
  <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>/img/movies/<?= $movie->image ?>')"></div>
  <div class="card-body">
    <p class="card-rating">
      <i class="fas fa-star"></i>
      <span class="rating"><?= $movie->rating ?></span>
    </p>
    <h5 class="card-title">
      <a href="<?= $BASE_URL ?>/movie.php?id=<?= $movie->id ?>"><?= $movie->title ?></a>
    </h5>
    <a href="<?= $BASE_URL ?>/movie.php?id=<?= $movie->id ?>" class="btn" id="rate-btn">Rate</a>
    <a href="<?= $BASE_URL ?>/movie.php?id=<?= $movie->id ?>" class="btn" id="card-btn">View</a>
  </div>
</div>
