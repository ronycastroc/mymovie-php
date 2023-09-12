<?php 
  require_once(__DIR__ . "/../models/Review.php");
  require_once(__DIR__ . "/../models/Message.php");
  require_once(__DIR__ . "/../dao/UserDAO.php");

  class ReviewDao implements ReviewDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    public function buildReview($data) {

      $reviewObject = new Review();

      $reviewObject->id = $data["id"];
      $reviewObject->rating = $data["rating"];
      $reviewObject->review = $data["review"];
      $reviewObject->user_id = $data["user_id"];
      $reviewObject->movie_id = $data["movie_id"];

      return $reviewObject;

    }

    public function create(Review $review) {

      $stmt = $this->conn->prepare("INSERT INTO reviews (
        rating, review, movie_id, user_id
      ) VALUES (
        :rating, :review, :movie_id, :user_id
      )");

      $stmt->bindParam(":rating", $review->rating);
      $stmt->bindParam(":review", $review->review);
      $stmt->bindParam(":movie_id", $review->movie_id);
      $stmt->bindParam(":user_id", $review->user_id);

      $stmt->execute();

      $this->message->setMessage("Review added successfully!", "success", "/../movie.php?id=$review->movie_id");

    }

    public function getMoviesReview($id) {}
    public function hasAlreadyReviewed($id, $userId) {}
    public function getRatings($id) {}

  }


?>