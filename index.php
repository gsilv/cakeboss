<?php
require_once __DIR__ . '/src/routes/Router.php';
require_once __DIR__ . '/src/Request.php';

if(!isset($_SESSION)) {
  session_start();
}

$requestUri = $_SERVER['REQUEST_URI'];
$route = substr($requestUri, 10);
$request = $_REQUEST;
$router = new Router;

if(isset($request['username']) && isset($request['email'])) {
  return $router->signup($requestUri, $request);
}
if(isset($request['login'])) {
  return $router->signin($requestUri, $request);
}
if(isset($request['comment']) && isset($_SESSION['username'])) {
  return $router->addComment($requestUri, $request);
}
if(isset($request['massas']) && isset($request['andares']) && isset($_SESSION['username'])) {
  return $router->saveOrder($requestUri, $request);
}
if($route == '/index.php?logout') {
  return $router->logOut($requestUri, $request);
}
if($route == '/index.php?loginRequired') {
  $_SESSION['loginRequired'] = true;
  return $router->signin($requestUri, $request);
}
if($route == '/index.php?orders'){
  return $router->listOrder($requestUri, $request);
}
if($route == '/' || $route == '/index.php'){
  return $router->listComment($requestUri, $request);
}

