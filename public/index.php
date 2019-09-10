<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Project\Factory;
$factory = new Factory();
$response = $factory->router()->route();
http_response_code($response->getStatus());
echo $response->getBody();
