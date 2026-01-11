<?php

declare(strict_types=1);

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

$router->get('/', function () {

    $stream = Utils::streamFor("Home Page");

    $response = new Response;

    $response = $response->withBody($stream);
    return $response;
});

$router->get('/products', function () {

    $stream = Utils::streamFor("All products");

    $response = new Response;

    $response = $response->withBody($stream);
    return $response;
});

$router->map("GET", "/product", function (ServerRequest $request): Response {
    $id = $request->getQueryParams()['id'];

    $stream = Utils::streamFor("single product id = $id");

    $response = new Response;

    $response = $response->withBody($stream);
    return $response;
});
$router->map("GET", "/oneproduct/{id:number}", function (ServerRequest $request, array $args): Response {
    $id = $args['id'];

    $stream = Utils::streamFor("single product id = $id");

    $response = new Response;

    $response = $response->withBody($stream);
    return $response;
});


$response = $router->dispatch($requst);

$emitter = new SapiEmitter;

$emitter->emit($response);
