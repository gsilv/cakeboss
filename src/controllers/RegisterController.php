<?php
require_once __DIR__ . '/../database/databaseConnection.php';

class RegisterController {
  public function register($request) {
    $dbConnection = new DatabaseConnection();
    try {
      $conn = $dbConnection->start();
    }catch(Exception $e){
      echo $e;
    }

    $formKeys   = array_keys($request);
    $username   = $request["username"];
    $fullname   = $request["fullname"];
    $email      = $request["email"];
    $contact    = $request["number"];
    $address    = $request["street"]." - ".$request["addressNum"];
    $password   = $request["password"];
    $confirmPassword = $request["confirmpassword"];
    
    for($i = 0; $i < count($formKeys); $i++) {
      $fieldIsEmpty = empty($request[$formKeys[$i]]);
      if($fieldIsEmpty) {
        $result = "<h4>É necessário preencher campo". $formKeys[$i] ."</h4></br>";
      }
    }
    if($password != $confirmPassword) {
      $result = "<h3>Password doesnt match</h3>";
      return;
    }
    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $userList = $conn->query($sql);
    $userAlreadyExists = $userList->fetch_assoc();
    if(!empty($userAlreadyExists)) {
      $result = "username already in use";
      $dbConnection->close($conn);
      return $result;
    }
    $password = hash('sha1', $password);
    $sql = "INSERT INTO users (username, name, email, password, address, tel) 
      VALUES ('$username', '$fullname', '$email', '$password', '$address', '$contact')";

    if($conn->query($sql) === TRUE) {
      $result = "New record created successfully";
    }else {
      $result = "Error: " . $sql . "<br>" . $conn->error;
    }
    $dbConnection->close($conn);
    return $result;
  }

  public function list() {
    $dbConnection = new DatabaseConnection();
    try {
      $conn = $dbConnection->start();
    }catch(Exception $e){
      echo $e;
    }
    $sql = "SELECT * FROM users";
    $usersList = $conn->query($sql);
    $users = array();
    if($usersList->num_rows > 0) {
      while($row = $usersList->fetch_assoc()) {
        array_push($users, $row);
      }
    }
    $dbConnection->close($conn);
    return $users;
  }

  public function getById($userId) {
    $dbConnection = new DatabaseConnection();
    try {
      $conn = $dbConnection->start();
    }catch(Exception $e){
      echo $e;
    }
    $sql = "SELECT * FROM users WHERE id = $userId";
    $usersList = $conn->query($sql);
    $user = $usersList->fetch_assoc();

    $dbConnection->close($conn);
    return $user;
  }

  public function getByUsername($username) {
    $dbConnection = new DatabaseConnection();
    try {
      $conn = $dbConnection->start();
    }catch(Exception $e){
      echo $e;
    }
    $sql = "SELECT * FROM users WHERE username = $username";
    $usersList = $conn->query($sql);
    $user = $usersList->fetch_assoc();

    $dbConnection->close($conn);
    return $user;
  }

  public function delete($userId) {
    $dbConnection = new DatabaseConnection();
    try {
      $conn = $dbConnection->start();
    }catch(Exception $e){
      echo $e;
    }
    $sql = "DELETE FROM users WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
    $dbConnection->close($conn);
  }
}