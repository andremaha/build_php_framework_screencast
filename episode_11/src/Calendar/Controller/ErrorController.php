<?php
/**
 *
 * Handles the 404s and 500s
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version
 */

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\FlattenException;

class ErrorController
{
    public function exceptionAction(FlattenException $exception)
    {
        $msg = "Something went terribly wrong! You broke everything! [DEBUG: ]" . $exception->getMessage() . "\n<br />";

        if ($exception->getStatusCode() == 404) {
            $msg = "Whoops, no such page";
        }

        return new Response($msg, $exception->getStatusCode());
    }
}