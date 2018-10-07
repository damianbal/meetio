<?php

namespace damianbal\Core;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class App
{
    protected $routes = null;
    protected $request = null;
    protected $entityManager = null;

    /**
     *
     */
    public function __construct()
    {
        $this->routes = new RouteCollection();

        $this->request = Request::createFromGlobals();

        $dotenv = new DotEnv();
        $dotenv->load(__DIR__ . '/../../config.env');

        // setup Doctrine
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__ . "/../Models"], false);

        $conn = [
            'driver' => 'pdo_mysql',
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'] ?? '',
            'dbname' => $_ENV['DB_NAME'],
            'host' => $_ENV['DB_HOST'],
        ];

        $this->entityManager = EntityManager::create($conn, $config);
    }

    /**
     * Returns doctrine entity manager
     *
     * @return EntityManager
     */
    public function getEntityManager() : EntityManager
    {
        return $this->entityManager;
    }

    /**
     * Get route
     *
     * @param string $url
     * @param callable $callback
     * @return void
     */
    public function get($url, $callback)
    {
        if (!$this->request->isMethod('GET')) {
            return;
        }

        $this->routes->add($url, new Route($url, [
            '_controller' => $callback,
            '_method' => 'GET',
        ]));
    }

    /**
     * Post route
     *
     * @param string $url
     * @param callable $callback
     * @return void
     */
    public function post($url, $callback)
    {
        if (!$this->request->isMethod('POST')) {
            return;
        }

        $this->routes->add($url, new Route($url, [
            '_controller' => $callback,
            '_method' => 'POST',
        ]));
    }

    /**
     * Put route
     *
     * @param string $url
     * @param callable $callback
     * @return void
     */
    public function put($url, $callback)
    {
        if (!$this->request->isMethod('PUT')) {
            return;
        }

        $this->routes->add($url, new Route($url, [
            '_controller' => $callback,
            '_method' => 'PUT',
        ]));
    }

    /**
     * Patch route
     *
     * @param string $url
     * @param callable $callback
     * @return void
     */
    public function patch($url, $callback)
    {
        if (!$this->request->isMethod('PATCH')) {
            return;
        }

        $this->routes->add($url, new Route($url, [
            '_controller' => $callback,
            '_method' => 'PATCH',
        ]));
    }

    /**
     * Delete route
     *
     * @param string $url
     * @param callable $callback
     * @return void
     */
    public function delete($url, $callback)
    {
        if (!$this->request->isMethod('DELETE')) {
            return;
        }

        $this->routes->add($url, new Route($url, [
            '_controller' => $callback,
            '_method' => 'DELETE',
        ]));
    }

    /**
     * Dispatch response
     *
     */
    public function create()
    {
        $matcher = new UrlMatcher($this->routes, new RequestContext());

        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

        $response = $kernel->handle($this->request);
        $response->send();

        $kernel->terminate($this->request, $response);
    }
}
