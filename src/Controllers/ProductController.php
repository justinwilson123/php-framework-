<?php

declare(strict_types=1);

namespace App\Controllers;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\ServerRequestInterface;

class ProductController
{
    public function products(): Response
    {
        $stream = Utils::streamFor("All products");

        $response = new Response;

        $response = $response->withBody($stream);
        return $response;
    }

    public function product(ServerRequest $request): Response
    {
        $id = $request->getQueryParams()['id'];

        $stream = Utils::streamFor("single product id = $id");

        $response = new Response;

        $response = $response->withBody($stream);
        return $response;
    }

    public function oneProduct(ServerRequest $request, array $args): Response
    {
        $id = $args['id'];

        $stream = Utils::streamFor("single product id = $id");

        $response = new Response;

        $response = $response->withBody($stream);
        return $response;
    }
}
