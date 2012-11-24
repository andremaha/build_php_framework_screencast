<?php
/**
 *
 * Application file. Defines the routes and appropriate controllers for each route.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.4
 */

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


$routes = new RouteCollection();

$routes->add('hello', new Route('/hello/{name}', array(
    'name' => 'Default Value',
    '_controller' => 'Templater\\Controller\\DefaultController::plainTextAction'
)));

$routes->add('bye', new Route('/bye', array(
    '_controller' => 'Templater\\Controller\\DefaultController::indexAction'
)));

$routes->add('secret', new Route('/secret', array(
    '_controller' => 'Templater\\Controller\\DefaultController::indexAction'
)));

$routes->add('leap_year', new Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction'
)));

return $routes;