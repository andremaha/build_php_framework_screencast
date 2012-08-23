<?php
/**
 *
 * That is the framework's front controller. This is the single entry script - all requests go here and all responses
 * get routed from here
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.2
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

// Deside which file to include based on the mapping
$path = $request->getPathInfo();
try {
    // Start the buffer - to convert our pages to templates and echo the content directly
    ob_start();

    // Take the 'key' of the array and converts it to $key variable, so we can use it in our templates
    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);

    // We will need URLgenerator to create links in templates
    $generator = new UrlGenerator($routes, $context);

    include sprintf(__DIR__ . '/../src/pages/%s.php', $_route);
    $response->setContent(ob_get_clean());
} catch (ResourceNotFoundException $e) {
    $response->setStatusCode(404);
    $response->setContent('Woha! We don\'t have THAT page');
} catch (\Exception $e) {
    $response->setStatusCode(500);
    $response->setContent('Something went terribly wrong. Server is confused. What have you done?! We are all doomed!');
}

$response->send();