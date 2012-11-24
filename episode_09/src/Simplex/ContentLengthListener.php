<?php
/**
 *
 * This listener adds the Content-Length header to the response
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

namespace Simplex;

class ContentLengthListener
{
    function onResponse(ResponseEvent $event) {
        $response = $event->getRequest();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }

    }
}