<?php
declare(strict_types=1);

namespace Project\RequestHandler;

use Project\Http\Request;
use Project\Http\Response;
use Project\Values\Method;
use Project\Values\Url;

class IndexGetRequestHandler implements RequestHandlerInterface
{
    public function handle(Request $request, Response $response): Response
    {
        $response->setBody('index');
        return $response;
    }

    public function getUrl(): Url
    {
        return new Url('/');
    }

    public function getMethod(): Method
    {
        return new Method('get');
    }
}