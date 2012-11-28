<?php
/**
 *
 * That is the framework's front controller. This is the single entry script - all requests go here and all responses
 * get routed from here.
 * In the Episode_09 we are adding the event listener for the 'response' event. And then we refactor those listeners
 * and use the subscribers - because it makes our application more decoupled.
 * @see Simplex\ResponseEvent
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.5
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
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;

// Form the request from all possible sources - $_GET, $_POST, $_FILE, $_COOKIE, $_SESSION
// TEST with command line
//$request = Request::create('/is_leap_year/2012');
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

// Subscribe to a couple of events with the EventDispatcher Component
$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new Simplex\GoogleListener());
$dispatcher->addSubscriber(new Simplex\ContentLengthListener());

// Load our framework to handle Requests
$framework = new Simplex\Framework($dispatcher, $matcher, $resolver);
$framework = new HttpCache($framework, new Store(__DIR__ . '/../cache'));
$response = $framework->handle($request);

// TEST with command line
// echo $response;
$response->send();