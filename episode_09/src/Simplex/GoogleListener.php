<?php
/**
 *
 * This event listener adds a small amount of data to the end of the content - in our test case it is the GoogleAnalytics code
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

namespace Simplex;

class GoogleListener
{
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();

        // Just showing off how easy it is to check and manipulate the Request and Response data
        if (
            $response->isRedirection()
            ||
            ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'text/html'))
            ||
            'html' !== $event->getRequest()->getRequestFormat()) {
            return;
        }

        $response->setContent($response->getContent() . 'GA FAKE CODE');
    }
}