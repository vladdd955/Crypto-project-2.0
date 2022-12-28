<?php

require_once 'vendor/autoload.php';

use App\Controllers\CryptoCurrencyController;
use App\Controllers\LoginController;
use App\Controllers\RegistrationController;
use App\Services\LoginService;
use App\Session;
use App\Template;
use Dotenv\Dotenv;
use Twig\Environment ;
use Twig\Loader\FilesystemLoader;

Session::initialize();


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    $route->addRoute("GET", "/", [CryptoCurrencyController::class, "index"]);
    $route->addRoute("GET", "/tradePage{symbol}", [CryptoCurrencyController::class, "showForm"]);

    $route->addRoute("GET", "/register", [RegistrationController::class, "showPage"]);
    $route->addRoute("POST", "/register", [RegistrationController::class, "store"]);

    $route->addRoute("GET", "/authorization", [LoginController::class, "showPage"]);
    $route->addRoute("POST", "/authorization", [LoginService::class, "getIn"]);

    $route->addRoute("GET", "/userPage", [\App\Controllers\UserWalletController::class, "showPage"]);
    $route->addRoute("GET", "/logout", [\App\Logout::class, "logout"]);

    $route->addRoute("POST", "/tradePage{symbol}", [\App\Controllers\CryptoTradeController::class, "cryptoTrade"]);
    $route->addRoute("POST", "/sellPage{symbol}", [\App\Controllers\CryptoSellController::class, "cryptoSell"]);

    $route->addRoute("GET", "/transfer", [\App\Controllers\TransferController::class, "showPage"]);
    $route->addRoute("POST", "/transfer", [\App\Controllers\SendCryptoController::class, "sendCrypto"]);

    $route->addRoute("GET", "/shortPage", [\App\Controllers\ShortShowInfoController::class, "showPage"]);
    $route->addRoute("POST", "/shortPage", [\App\Controllers\ShortOpenController::class, "shortBuy"]);
    $route->addRoute("POST", "/sellShortPage", [\App\Controllers\ShortCloseController::class, "shortSell"]);



});

$dotenv = Dotenv::createImmutable('dotenv');
$dotenv->load();

$loader = new FilesystemLoader('views');
$twig = new Environment($loader);
$twig->addGlobal("session", $_SESSION);

$container = new DI\Container();
$container->set(\App\Repository\CryptoCurrenciesRepository::class,
    \DI\create(\App\Repository\CoinMarketCapCryptoCurrencyRepository::class));





// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        [$controller, $method] = $handler;

//        $response = (new $controller)->{$method}($vars);

        $response = $container->get($controller)->{$method}($vars);

        if ($response instanceof Template) {
            echo $twig->render($response->getPath(), $response->getParams());
//
            unset($_SESSION["errors"]);
            unset($_SESSION["hello"]);
            unset($_SESSION["coinError"]);
            unset( $_SESSION["password"]);
            break;
        }
        if ($response instanceof \App\Redirect) {
            header("location:" . $response->getUrl());
//            unset($_SESSION["errors"]);

            break;
        }
}



