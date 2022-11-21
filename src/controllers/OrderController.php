<?php
  require_once __DIR__ . '/../database/databaseConnection.php';

  class OrderController {
    public function add($request) {
      $dbConnection = new DatabaseConnection();
      try {
        $conn = $dbConnection->start();
      }catch(Exception $e){
        $result = $e;
      }

      $massa   = $request['massas'];
      $filling = $request['recheios'];
      $cover   = $request['coberturas'];
      $size    = $request['andares'];
      $deliveryDate = $request['dataEntrega'];
      $deliveryType = $request['entrega'];
      $fk_user_id   = 5;

      $sql = "INSERT INTO orders(massa, filling, cover, size, delivery_type, event_date, fk_user_id) 
        VALUES ('$massa', '$filling', '$cover', '$size', '$deliveryType', '$deliveryDate', '$fk_user_id')";
      $dbResult = $conn->query($sql);

      if($conn->query($sql) === TRUE) {
        $result = 'order saved';
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