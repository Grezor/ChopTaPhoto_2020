<?php

namespace App\Router;

use AltoRouter;
use App\Controllers\HomeController;
use App\Controllers\HttpErrorController;
use App\Responses\AbstractResponse;
use App\Router\Router as RouterRouter;
use Exception;
use ReflectionClass;

class Router
{
    private AltoRouter $router;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    public function get(string $path, array $action, string|null $name = null): void
    {
        $this->addRoute(['GET'], $path, $action, $name);
    }

    public function post(string $path, array $action, string|null $name = null): void
    {
        $this->addRoute(['POST'], $path, $action, $name);
    }

    public function put(string $path, array $action, string|null $name = null): void
    {
        $this->addRoute(['PUT'], $path, $action, $name);
    }

    public function patch(string $path, array $action, string|null $name = null): void
    {
        $this->addRoute(['PATCH'], $path, $action, $name);
    }

    public function delete(string $path, array $action, string|null $name = null): void
    {
        $this->addRoute(['DELETE'], $path, $action, $name);
    }

    /**
     * addRoute
     *
     * @param  array $methods (GET/POST/PUT/DELETE)
     * @param  string $path (HomeController::class)
     * @param  array $action (method index, show, update)
     * @param  string|null $name (name route)
     * @return void
     */
    public function addRoute(array $methods, string $path, array $action, string|null $name = null): void
    {
        if (count($action) !== 2) {
            throw new Exception("L'action doit comporter 2 élements [ClassName, methods]");
        }

        $methods = implode(' | ', $methods);

        $this->router->map($methods, $path, $action, $name);
    }

    /**
     * run
     *
     * @return AbstractResponse
     */
    public function run(): AbstractResponse
    {
        $routeMatched = $this->router->match();

        if ($routeMatched === false) {
            $routeMatched = $this->getNotFoundAction();
        }

        $targetClass = $routeMatched['target'][0]; // exemple HomeController::class
        $targetMethod = $routeMatched['target'][1]; // exemple: index

        $class = new ReflectionClass($targetClass);
        // si la classe n'est pas instanciable
        if (!$class->isInstantiable()) {
            throw new Exception("The class {$targetClass} is not instantiable");
        }
        //crée une nouvelle instance
        $instance = $class->newInstance();
        // recuperer la methode de la class
        $method = $class->getMethod($targetMethod);
        return $method->invokeArgs($instance, $routeMatched['params']);
    }

    /**
     * getNotFoundAction
     * @return array
     */
    private function getNotFoundAction(): array
    {
        return [
            'target' => [HttpErrorController::class, 'e404'],
            'name' => '',
            'params' => []
        ];
    }
}
