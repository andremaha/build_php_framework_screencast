<?php
/**
 *
 * That is the framework's front controller. This is the single entry script - all requests go here and all responses
 * get routed from here
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

// Load the autoloader
require_once __DIR__ . '/../src/autoload.php';

// Use the short names of the classes
// Also a nice way to declare what Symfony Components will be used in the script
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Form the request from all possible sources - $_GET, $_POST, $_FILE, $_COOKIE, $_SESSION
$request = Request::createFromGlobals();

// Form the empty response
$response = new Response();

// Create a mapping - each URL pattern will be mapped to the page file
$map = array(
    '/hello' => __DIR__ . '/../src/pages/hello.php',
    '/bye'   => __DIR__ . '/../src/pages/bye.php',
    '/secret' => __DIR__ . '/../src/pages/secret.php'
);

// Deside which file to include based on the mapping
$path = $request->getPathInfo();
if (isset($map[$path])) {
    // Start the buffer - to convert our pages to templates and echo the content directly
    ob_start();
    require $map[$path];
    $response->setContent(ob_get_clean());
} else {
    $response->setStatusCode(404);
    $response->setContent('Woha! We don\'t have THAT page');
}

$response->send();