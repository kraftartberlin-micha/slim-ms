<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Project\Factory;
$factory = new Factory();
echo $factory->requestHandler()->route()->getBody();
