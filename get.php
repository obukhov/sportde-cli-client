<?php
use SportDe\CliClient\Application\Application;
use SportDe\CliClient\Application\ServiceFactory;

require __DIR__ . '/vendor/autoload.php';

$exitCode = (new Application(new ServiceFactory()))->run($_SERVER['argv']);

exit($exitCode);
