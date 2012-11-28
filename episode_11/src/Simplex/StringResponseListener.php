<?php
/**
 *
 * Acting on the sting as a response
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

namespace Simplex;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;

class StringResponseListener implements EventSubscriberInterface
{
    public function onView(GetResponseForControllerResultEvent  $event)
    {
        $responseSting = $event->getControllerResult();

        $response = new Response();
        // Play with the Response a bit
        $response->headers->set('Content-Type', 'text/plain');
        $response->setContent($responseSting);

        if (is_string($responseSting)) {
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents()
    {
        return array('kernel.view' => 'onView');
    }
}