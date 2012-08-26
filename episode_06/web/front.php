<?php
/**
 *
 * That is the framework's front controller. This is the single entry script - all requests go here and all responses
 * get routed from here
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.3
 */

// Load the autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Use the short names of the classes
// Also a nice way to declare what Symfony Components will be used in the script
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

// Form the request from all possible sources - $_GET, $_POST, $_FILE, $_COOKIE, $_SESSION
$request = Request::createFromGlobals();

// Form the empty response
$response = new Response();

// Create a mapping - each URL pattern will be mapped to the page file
$routes = include __DIR__ . '/../src/app.php';

// Context is needed to enforce method requirements
$context = new RequestContext($request->getUri());

// Create a UrlMather that will take URL paths and convert them to the internal routes
$matcher = new UrlMatcher($routes, $context);

// The resolver will take care of the lazy loading of our controller classes
$resolver = new ControllerResolver();

try {
    // We're attaching additional info to the HTTP Request, so that we can use it in our render template function
    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $resolver->getController($request);
    $arguments = $resolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);
} catch (ResourceNotFoundException $e) {
    $response->setStatusCode(404);
    $response->setContent('Woha! We don\'t have THAT page');
} catch (\Exception $e) {
    $response->setStatusCode(500);
    $response->setContent("Something went terribly wrong. Server is confused. What have you done?! We are all doomed! \n" . $e->getMessage());
}

// Generic controller - when no logic to be done, just render the template
function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__. '/../src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
}

$response->send();