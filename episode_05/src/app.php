<?php
/**
 *
 * Application file. Routes for now.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.2
 */

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;

// proves if the year provided in the URL is in leap or not
function is_leap_year($year = null)
{
    if (null === $year) {
        $year = date('Y');
    }

    return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
}

$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', array(
    'name' => 'Default Value',
    '_controller' => function($request) {
        // Add some variable that will be available in the template
        $request->attributes->set('current_time', strftime('%c', time()));

        // Render the template
        $response = render_template($request);

        // Render everything as a simple text
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    })));
$routes->add('bye', new Route('/bye'));
$routes->add('secret', new Route('/secret'));
$routes->add('leap_year', new Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => function($request) {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Yes, ' . $request->attributes->get('year') . ' is a leap year.');
        } else {
            return new Response('No, ' . $request->attributes->get('year') . ' is not a leap year.');
        }
    }
)));

return $routes;