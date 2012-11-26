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
            return new Response('Yes, ' . $year . ' is a leap year.');
        }

        return new Response('No, ' . $year . ' is not a leap year.');
    }
}