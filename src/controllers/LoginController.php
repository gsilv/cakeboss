<?php
  require_once __DIR__ . '/../database/databaseConnection.php';

  class LoginController {
    public function login($request) {
      $dbConnection = new DatabaseConnection();
      try {
        $conn = $dbConnection->start();
      }catch(Exception $e){
        $result = $e;
      }
      if(!isset($_SESSION)) {
        session_start();
      }

      $username = $request['login'];
      $password = $request['password'];
      
      if(empty($username) || empty($password)){
        $result = "username and password required";
      }

      $sql = "SELECT * FROM users WHERE username = '$username'";
      $dbResult = $conn->query($sql);
      $user = $dbResult->fetch_assoc();
      $password = hash('sha1', $password);
      $sessionId = hash('sha1', $username);

      if(empty($user)) {
        $result = "user not found";
      }elseif($password != $user["password"]) {
        $result = "wrong password";
      }else {
        $result = 'ok';
      }
      $_SESSION['username'] = $username;
      $dbConnection->close($conn);
      return $result;
    }

    public function logOut($request) {
      session_start();
      if(!isset($_SESSION['username'])) {
        return 'session doesnt exists';
      }
      unset($_SESSION['username']);
      return 'ok';
    }
  }