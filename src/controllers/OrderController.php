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

      $sql = "SELECT u.username, o.massa, o.filling, o.size, o.delivery_type, DATE_FORMAT(o.event_date, '%d-%c-%Y') AS created_at FROM orders AS o INNER JOIN users AS u ON o.fk_user_id = u.id";
      $dbResult = $conn->query($sql);
      $ordersResult = $dbResult->fetch_assoc();
      if(!$ordersResult) {
        $dbConnection->close($conn);
        return null;
      }
      $ordersLength = count($ordersResult);
      $orders = array();

      if($ordersLength > 0){
        do{
          array_push($orders, $ordersResult['username'], $ordersResult['massa'], $ordersResult['filling'], $ordersResult['size'], $ordersResult['delivery_type'], $ordersResult['created_at']);
        }while($ordersResult = $dbResult->fetch_assoc());
      }

      $dbConnection->close($conn);
      return $orders;
    }
  }