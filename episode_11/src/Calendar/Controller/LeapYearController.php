<?php
/**
 *
 * The controller to be used in the Simplex framework to handle the request /is_leap_year/{year} and return the appropriate
 * response
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Calendar\Model\LeapYear;

class LeapYearController
{
    public function indexAction(Request $request, $year)
    {
        $leapyear = new LeapYear();
        if ($leapyear->isLeapYear($year)) {
            $response = new Response('Yes, ' . $year . ' is a leap year. If this number stays the same for 10 seconds caching works: ' . rand());
        } else {
            $response =  new Response('No, ' . $year . ' is not a leap year.');
        }

// Following results in these headers:
//        HTTP/1.1 200 OK
//        Age:              0
//        Cache-Control:    max-age=10, public, s-maxage=10
//        Content-Length:   108
//        Content-Type:     text/html; charset=UTF-8
//        Date:             Mon, 26 Nov 2012 21:11:33 GMT
//        Etag:             "asdf"
//        Last-Modified:    Sun, 25 Nov 2012 09:00:00 GMT

        $response->setCache(array(
                'public'    => true,
                'etag'      => 'asdf',
                'last_modified' => date_create_from_format('Y-m-d H:i:s', '2012-11-25 10:00:00'),
                'max_age'   => 10,
                's_maxage'  => 10,
            ));

       // Quick alternative to set TimeToLive without headers
       // $response->setTtl(10);

        return $response;

    }
}