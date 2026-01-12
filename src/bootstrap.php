<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Utils;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Route;
use League\Route\Router;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

// error reporting
ini_set('display_errors', '1');

$requst = ServerRequest::fromGlobals();

$router = new Router();

$router->get(
    '/',
    [HomeController::class, "index"]
    // function () {

    //     $stream = Utils::streamFor("Home Page");

    //     $response = new Response;

    //     $response = $response->withBody($stream);
    //     return $response;
    // }
);

$router->get('/products', [ProductController::class, "products"]);

$router->map("GET", "/product", [ProductController::class, "product"]);
$router->map("GET", "/oneproduct/{id:number}", [ProductController::class, "oneProduct"]);


$response = $router->dispatch($requst);

$emitter = new SapiEmitter;

$emitter->emit($response);
