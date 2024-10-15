<?php 
use GGCode\framework\Http\Request;
use GGCode\framework\Http\Response;
use GGCode\framework\Http\Kernel;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$request = Request::create();

$kernel = new Kernel();

$repsonse = $kernel->handle($request);

$repsonse->send();


