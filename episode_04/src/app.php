<?php
/**
 *
 * Application file. Routes for now.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', array('name' => 'Default Value')));
$routes->add('bye', new Route('/bye'));
$routes->add('secret', new Route('/secret'));

return $routes;