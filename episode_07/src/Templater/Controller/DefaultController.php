<?php
/**
 *
 * This is the default controller for our templating engine. It will parse the request, find a page to include and
 * output the response.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

namespace Templater\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    /**
     * Parses the request, includes the template file and returns the Respose
     *
     * @param Request $request comes for free - no configuration needed, all is handled by the HttpKernel\Controller\ControllerReslover
     */
    public function indexAction(Request $request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        // We follow the naming convention. The name of the route = the name of the file
        include sprintf(__DIR__. '/../../../src/pages/%s.php', $_route);

        return new Response(ob_get_clean());
    }

    /**
     * Additionally to parsing the request this action manipulates the request by adding the attribute 'current_time' to
     * it, which in turn will be used in the template as $current_time.
     * And this action sets the content-type headers to response, so we get the plain text, hence the name.
     *
     * @param Request $request
     * @return Response
     */
    public function plainTextAction(Request $request)
    {
        // Add some variable that will be available in the template
        $request->attributes->set('current_time', strftime('%c', time()));

        // Render the template
        $response = $this->indexAction($request);

        // Render everything as a simple text
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }

}