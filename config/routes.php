<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', ['_namePrefix' => 'app:'], function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */

    $routes->connect('/', ['controller' => 'Homes', 'action' => 'index'], [
        '_name' => 'index',
    ]);

    $routes->connect('/trang-chu', ['controller' => 'Homes', 'action' => 'index'], [
        '_name' => 'homes',
    ]);

    $routes->connect('/lien-he', ['controller' => 'Contacts', 'action' => 'index'], [
        '_name' => 'contact',
    ]);

    $routes->connect('/gioi-thieu', ['controller' => 'Introduces', 'action' => 'introduce'], [
        '_name' => 'introduce',
    ]);

    $routes->connect('/cong-trinh-thuc-te', ['controller' => 'Highlights', 'action' => 'index'], [
        '_name' => 'highlights',
    ]);

    /** @var \Cake\Routing\RouteBuilder $routes */
    $routes->connect('/:category', ['controller' => 'Services', 'action' => 'category', 'prefix' => null], [
        'pass' => ['category'],
        '_name' => 'category'
    ]);

    /** @var \Cake\Routing\RouteBuilder $routes */
    $routes->connect('/:category/:slug-:id.html', ['controller' => 'Services', 'action' => 'details', 'prefix' => null], [
        'pass' => ['category', 'slug', 'id'],
        'id' => '[0-9]+',
        '_name' => 'details'
    ]);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

Router::scope('/cafe-va-can-ho', ['_namePrefix' => 'cafe:'], function ($routes) {

    /** @var \Cake\Routing\RouteBuilder $routes */
    $routes->connect('/', ['controller' => 'CafeCanHo', 'action' => 'index', 'prefix' => null], [
        '_name' => 'index'
    ]);

    /** @var \Cake\Routing\RouteBuilder $routes */
    $routes->connect('/:slug.html', ['controller' => 'CafeCanHo', 'action' => 'detail', 'prefix' => null], [
        'pass' => ['slug'],
        '_name' => 'view'
    ]);
});

Router::scope('/cong-trinh-thuc-te', ['_namePrefix' => 'services:'], function ($routes) {
    /** @var \Cake\Routing\RouteBuilder $routes */
    $routes->connect('/:slug.html', ['controller' => 'Services', 'action' => 'detail', 'prefix' => null], [
        'pass' => ['slug'],
        '_name' => 'view'
    ]);
});

Router::scope('/tin-tuc', ['_namePrefix' => 'news:'], function ($routes) {
    /** @var \Cake\Routing\RouteBuilder $routes */
    $routes->connect('/:slug.html', ['controller' => 'News', 'action' => 'detail', 'prefix' => null], [
        'pass' => ['slug'],
        '_name' => 'view'
    ]);
});

Router::scope('/du-an-tieu-bieu', ['_namePrefix' => 'highlights:'], function ($routes) {
    /** @var \Cake\Routing\RouteBuilder $routes */
    $routes->connect('/:slug.html', ['controller' => 'Highlights', 'action' => 'detail', 'prefix' => null], [
        'pass' => ['slug'],
        '_name' => 'view'
    ]);
});


/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
