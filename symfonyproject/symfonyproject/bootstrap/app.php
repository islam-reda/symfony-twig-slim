<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Spout/Autoloader/autoload.php';


$app = new Slim\App([
  'settting'=> [
    'displayErrorDetails' => true,
  ]
]);
// Fetch DI Container
$container = $app->getContainer();

//var_dump($container['upload_directory']);
//die;

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('../resourses/views', [
        'cache' => false,
    ]);
    // Instantiate and add Slim specific extension
    $router = $c->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};


$container['CustomersController'] = function($container){
  return new \App\Controllers\CustomersController($container);
};

$container['LoginController'] = function($container){
  return new \App\Controllers\LoginController($container);
};

$container['BrandController'] = function($container){
  return new \App\Controllers\BrandController($container);
};

$container['NewsController'] = function($container){
  $container['upload_directory'] = __DIR__ . '/uploads';
  return new \App\Controllers\NewsController($container);
};

$container['StoresController'] = function($container){
    return new \App\Controllers\StoresController($container);
};

$container['VouchersController'] = function($container){
    return new \App\Controllers\VouchersController($container);
};


$container['UserController'] = function($container){
    return new \App\Controllers\UserController($container);
};
$container['SettingController'] = function($container){
    return new \App\Controllers\SettingController($container);
};

$container['TestController'] = function($container){
    return new \App\Controllers\TestController($container);
};



$container['Auth'] = function($container){
  return new \App\Controllers\Api\Auth($container);
};
$container['Home'] = function($container){
  return new \App\Controllers\Api\Home($container);
};
$container['Location'] = function($container){
  return new \App\Controllers\Api\Location($container);
};


require_once('../app/router.php');
