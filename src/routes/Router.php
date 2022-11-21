<?php

require_once __DIR__ . '/RouteSwitch.php';
require_once __DIR__ . '/../controllers/RegisterController.php';
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../controllers/CommentController.php';
require_once __DIR__ . '/../controllers/OrderController.php';


class Router extends RouteSwitch {
  public function run($method, $requestUri, $callback) {
    $route = substr($requestUri, 1);

    if($route === '') {
      $this->home();
    }else {
      $this->$route();
    } 
    $method = strtolower($method);
    if (!isset($this->routes[$method])) {
        $this->routes[$method] = [];
    }

    $uri = substr($path, 0, 1) !== '/' ? '/' . $path : $path;
    $pattern = str_replace('/', '\/', $uri);
    $route = '/^' . $pattern . '$/';

    $this->routes[$method][$route] = $callback;

    return $this;
  }

  public function signup($requestUri, $request) {
    $registerController = new RegisterController();
    $route = substr($requestUri, 1);
    $result = $registerController->register($request);
    if($result == 'New record created successfully') {
      $this->home();
    }else {
      $this->register();
      echo $result;
    }
  } 

  public function signin($requestUri, $request) {
    $loginController = new LoginController();
    $route = substr($requestUri, 1);
    $result = $loginController->login($request);
    if($result == 'ok') {
      $this->home();
    }else {
      $this->login();
    } 
  }  

  public function addComment($requestUri, $request) {
    $commentController = new CommentController();
    $route = substr($requestUri, 1);
    $result = $commentController->add($request);
    if($result == 'ok') {
      $this->home();
      echo 'deu certo';
    }else {
      $this->home();
    } 
  }  

  public function listComment($requestUri, $request) {
    $commentController = new CommentController();
    $route = substr($requestUri, 1);
    $result = $commentController->list($request);
    if($result) {
      $this->home();
      // echo var_dump($result);

    }else {
      $this->home();
    } 
  }

  public function saveOrder($requestUri, $request) {
    $OrderController = new OrderController();
    $route = substr($requestUri, 1);
    $result = $OrderController->add($request);
    if($result) {
      $this->home();
    }else {
      $this->home();
    } 
  }
}