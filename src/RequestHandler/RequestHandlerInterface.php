<?php
declare(strict_types=1);

namespace Project\RequestHandler;

use Project\Http\Response;
use Project\Http\Request;

interface RequestHandlerInterface
{
    public function handle(Request $request, Response $response):Response;
}