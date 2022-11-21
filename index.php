<?php
require_once __DIR__ . '/src/routes/Router.php';
require_once __DIR__ . '/src/Request.php';

$requestUri = $_SERVER['REQUEST_URI'];
$route = substr($requestUri, 10);
$request = $_REQUEST;
$router = new Router;

if(isset($request['username']) && isset($request['email'])) {
  $router->signup($requestUri, $request);
}
if(isset($request['login'])) {
  $router->signin($requestUri, $request);
}
if(isset($request['comment'])) {
  $router->addComment($requestUri, $request);
}
if(isset($request['massas']) && isset($request['andares'])) {
  $router->saveOrder($requestUri, $request);
}
if($route == '/'){
  $router->listComment($requestUri, $request);
}

