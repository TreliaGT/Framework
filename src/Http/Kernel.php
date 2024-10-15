<?php
namespace GGCode\framework\Http;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use GGCode\framework\Http\Repsonse;
use GGCode\framework\Controllers\AbstractController;
use GGCode\framework\Database\Connection;

class Kernel {
    protected ?Connection $connection = null;

    public function __construct(){
        $config = include BASE_PATH . '/database/config.php';
        $this->connection = Connection::create($config['connectionString']);
    }

    public function handle(Request $request): Response {
        $dispatcher = simpleDispatcher(function(RouteCollector $routeCollector) {
            $routes = include BASE_PATH . '/routes/web.php';

            foreach ($routes as $route) {
                $routeCollector->addRoute(...$route);
            }
        });

        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getURI());

        [$status, [$controller, $method], $vars] = $routeInfo;

        $controller = new $controller;
        
        if($controller instanceof AbstractController){
            $controller->setRequest($request);
        }

        return call_user_func_array([$controller, $method], $vars); // Call the method
        
    }
}
