<?php
declare(strict_types=1);

namespace Project\Http;

use RuntimeException;

class Request
{
    private $request;
    private $server;

    public function __construct()
    {
        $this->ensureServerHasImportantKeysFilled($_SERVER);
        $this->request = $_REQUEST;
        $this->server = $_SERVER;
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function uri(): string
    {
        return $this->server['REQUEST_URI'];
    }

    public function args(): array
    {
        return $this->server['argv'] ?: [];
    }

    private function ensureServerHasImportantKeysFilled($server)
    {
        if(count($server) < 1){
            throw new RuntimeException('Empty Server Var');
        }

        if(empty($server['REQUEST_URI'])){
            throw new RuntimeException('Empty REQUEST_URI');
        }

        if(empty($server['REQUEST_METHOD'])){
            throw new RuntimeException('Empty REQUEST_METHOD');
        }
    }
}