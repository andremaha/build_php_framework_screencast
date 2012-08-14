<?php
/**
 *
 * Main application file - In the version 2 the two Symfony Components have been added Request and Responce
 * to abstract the HTTP interactions. As a result we get the full control over how the request is made and response
 * is processed. For instance, we can change the content type of the response to JSON an pack some additional info on top.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.2
 */

// Load the autoloader
require_once __DIR__ . '/autoload.php';

// Use the short names of the classes
// Also a nice way to declare what Symfony Components will be used in the script
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Form the request from all possible sources - $_GET, $_POST, $_FILE, $_COOKIE, $_SESSION
$request = Request::createFromGlobals();

// Get the name using object-oriented approach
$input = $request->get('name', 'Default value goes here');

// Print it out as json with additional info to show off Request methods
$response = new Response();
$response->headers->set('Content-Type', 'application/json');
$response->setContent(json_encode(array(
    'greeting' => sprintf('Hello, %s!', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')),
    'server'   => $request->server->get('HTTP_HOST'),
    'cookie'   => $request->cookies->get('PHPSESSID'),
    'ip'       => $request->getClientIp())));
$response->send();
