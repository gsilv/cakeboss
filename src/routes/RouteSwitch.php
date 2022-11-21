<?php

abstract class RouteSwitch {
  public function home() {
    require $path = __DIR__ . '/../../pages/home/index.html';
  }

  public function register() {
    require $path = __DIR__ . '/../../pages/register/index.html';
    header('Location:'. '/myproject/pages/register/index.html');
  }

  public function login() {
    require __DIR__ . '/../../pages/login/index.html';
    header('Location:'. '/myproject/pages/login/index.html');
  }
    
  public function __call($name, $arguments) {
    http_response_code(404);
    require __DIR__ . '/../../pages/not-found.html';
  }
}