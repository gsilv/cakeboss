<?php
class databaseConnection {
  public function start() {
    $servername = "localhost";
    $database = "cakeboss";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if(!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
  }

  public function close($conn) {
    $closedConnection = mysqli_close($conn);
    if(!$closedConnection) {
      echo "fail to close connection";
    }
  }
}
