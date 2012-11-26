<?php
/**
 *
 * Calculations that will be made to determine if the year is leap or not.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

namespace Calendar\Model;

class LeapYear
{
    public function isLeapYear($year = null)
    {
        if (null === $year) {
            $year = date('Y');
        }

        return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
    }

}