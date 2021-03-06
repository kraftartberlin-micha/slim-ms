<?php
declare(strict_types=1);

namespace Project\RequestHandler;

use Project\Http\Response;
use Project\Http\Request;
use Project\Http\Method;
use Project\Http\Url;

interface RequestHandlerInterface
{
    public function handle(Request $request, Response $response):Response;

    public function getMethod():Method;
    public function getUrl():Url;
}