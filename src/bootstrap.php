<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Utils;
use HttpSoft\Emitter\SapiEmitter;

require dirname(__DIR__) . '/vendor/autoload.php';

// error reporting
ini_set('display_errors', '1');

$requst = ServerRequest::fromGlobals();

$page = $requst->getQueryParams()['page'] ?? 'home';

$route =
    ob_start();

require dirname(__DIR__) . '/' . $page . '.php';

$content = ob_get_clean();

$stream = Utils::streamFor($content);

$response = new Response;

$response = $response->withHeader('Content-Type', 'text/html')
    ->withStatus(418)
    ->withBody($stream);

$emitter = new SapiEmitter;

$emitter->emit($response);
