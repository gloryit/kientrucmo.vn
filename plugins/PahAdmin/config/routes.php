<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'PahAdmin', [
        'path' => '/pah-admin',
    ],
    function (RouteBuilder $routes) {
        $routes->connect('/', [
            'controller' => 'Posts',
            'action' => 'index',
            'plugin' => 'PahAdmin',
        ]);

        $routes->connect('/:controller/:action', []);
        $routes->connect('/:controller/:action/*', []);
        $routes->fallbacks(DashedRoute::class);
    }
);
