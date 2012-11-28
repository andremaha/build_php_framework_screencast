<?php
/**
 *
 * The basis for our framework testing. The not found exception is tested, as well as the correct handling of the valid
 * request.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

namespace Simplex\Tests;

use Simplex\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class FrameworkTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Using object-oriented notation we can easily get the status code of our response.
     * The 404 status code will allow to check if the empty Request in fact results in
     * NotFound exception being thrown by our framework.
     */
    public function testNotFoundHandling()
    {
        $framework = $this->getFrameworkForException(new ResourceNotFoundException());

        $response = $framework->handle(new Request());

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * If a critical error (RuntimeException) happens our framework should send 500 HTTP error back to the browser.
     */
    public function testErrorHandling()
    {
        $framework = $this->getFrameworkForException(new \RuntimeException());

        $response = $framework->handle(new Request());

        $this->assertEquals(500, $response->getStatusCode());

    }

    /**
     * Tests how well our frameworks handles the requests and if the controllers are working.
     * Even the controllers we've written ourselves as classes - for instance DefaultController with the
     * plainTextAction that returns the simple text format.
     */
    public function testControllerResponse()
    {
        $matcher = $this->getMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
        $matcher
            ->expects($this->once())
            ->method('match')
            ->will($this->returnValue(array(
                    '_route' => 'hello',
                    'name' => 'Andrey',
                    '_controller' => 'Templater\\Controller\\DefaultController::plainTextAction'
                )))
        ;
        $resolver = new ControllerResolver();

        $framework = new Framework($matcher, $resolver);

        $response = $framework->handle(new Request());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello, Andrey', $response->getContent());
        $this->assertEquals('text/plain', $response->headers->get('Content-Type'));
    }

    protected function getFrameworkForException($exception)
    {
        // @see http://www.phpunit.de/manual/current/en/test-doubles.html about how mocks work
        $matcher = $this->getMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
        $matcher
            ->expects($this->once())
            ->method('match')
            ->will($this->throwException($exception));
        $resolver = $this->getMock('Symfony\Component\HttpKernel\Controller\ControllerResolverInterface');

        return new Framework($matcher, $resolver);
    }
}