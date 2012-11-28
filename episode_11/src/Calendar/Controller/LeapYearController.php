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
use Calendar\Model\LeapYear;

class LeapYearController
{
    public function indexAction(Request $request, $year)
    {
        $leapyear = new LeapYear();
        if ($leapyear->isLeapYear($year)) {
            return 'Yes, ' . $year . ' is a leap year. If this number stays the same for 10 seconds caching works: ' . rand();
        } else {
           return 'No, ' . $year . ' is not a leap year.';
        }

    }
}