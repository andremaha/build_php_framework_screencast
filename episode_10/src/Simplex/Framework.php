<?php
/**
 *
 * Request handling logic - it's all about creating the appropriate Response to the certain Request.
 * In the Episode 09 we'll add an event dispatcher to easily hook into the request and let the plugins to manipulate
 * the response onf the fly.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.3
 */
namespace Simplex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Framework implements HttpKernelInterface
{
    protected $matcher;
    protected $resolver;
    protected $dispatcher;

    // In order to use test doubles in phpunit, we need to replace the concrete classes with interfaces
    public function __construct(EventDispatcher $dispatcher, $matcher, ControllerResolverInterface $resolver)
    {
        $this->matcher = $matcher;
        $this->resolver = $resolver;
        $this->dispatcher = $dispatcher;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->resolver->getController($request);
            $arguments = $this->resolver->getArguments($request, $controller);

            $response = call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Nope, no such page!', 404);
        } catch (\Exception $e) {
            $response = new Response("Something went terribly wrong. Server is confused. What have you done?! We are all doomed! \n" . $e->getMessage(
            ) . "\n" . $e->getTraceAsString(), 500);
        }

        // dispatch an event called 'response' just before sending the response
        $this->dispatcher->dispatch('response', new ResponseEvent($response, $request));

        return $response;

    }
}