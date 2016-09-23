<?php
use SportDe\CliClient\Application;
use SportDe\CliClient\Application\ServiceLocator;

require __DIR__ . '/vendor/autoload.php';

(new Application(new ServiceLocator()))->process($_SERVER['argv']);
