<?php
declare(strict_types=1);

namespace Project\RequestHandler;

use Project\Http\Request;
use Project\Http\Response;

class IndexGetRequestHandler implements RequestHandlerInterface
{
    public function handle(Request $request, Response $response):Response
    {
        $response->setBody('index');
        return $response;
    }
}