<?php
  require_once __DIR__ . '/../database/databaseConnection.php';

  class CommentController {
    public function add($request) {
      $dbConnection = new DatabaseConnection();
      try {
        $conn = $dbConnection->start();
      }catch(Exception $e){
        $result = $e;
      }
      if(!isset($_SESSION)) {
        session_start();
      }
      $username = $_SESSION['username'];
      $comment = $request['comment'];

      $sqlGetUser = "SELECT * FROM users WHERE username = '$username'";
      $dbResult = $conn->query($sqlGetUser);
      $user = $dbResult->fetch_assoc();
      if($user){
        $fk_user_id = $user['id'];
      }
      $sql = "INSERT INTO comments (message, fk_user_id) VALUES ('$comment', '$fk_user_id')";

      if($conn->query($sql) === TRUE) {
        $result = 'comment saved';
      }
      $dbConnection->close($conn);
      return $result;
    }

    public function list() {
      $dbConnection = new DatabaseConnection();
      try {
        $conn = $dbConnection->start();
      }catch(Exception $e){
        $result = $e;
      }

      $sql = "SELECT u.username, c.message, DATE_FORMAT(c.created_at, '%d-%c-%Y') AS created_at FROM comments AS c INNER JOIN users AS u ON c.fk_user_id = u.id";
      $dbResult = $conn->query($sql);
      $commentsResult = $dbResult->fetch_assoc();
      if(!$commentsResult) {
        $dbConnection->close($conn);
        return null;
      }
      $commentsLength = count($commentsResult);
      $comments = array();

      if($commentsLength > 0){
        do{
          array_push($comments, $commentsResult['username'], $commentsResult['message'], $commentsResult['created_at']);
        }while($commentsResult = $dbResult->fetch_assoc());
      }

      $dbConnection->close($conn);
      return $comments;
    }
  }