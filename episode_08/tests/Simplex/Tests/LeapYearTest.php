<?php
/**
 *
 * Test of the LeapYear model class caclulation. It's very silly, but made as an
 * exercise.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

namespace Simplex\Tests;

use Calendar\Model\LeapYear;

class LeapYearTest extends \PHPUnit_Framework_TestCase
{

    private $is_leap_year  = 2032;
    private $not_leap_year = 2034;
    private $leap_year     = null;

    public function setUp()
    {
        $this->leap_year = new LeapYear();
    }

    /**
     * Tests if the the year identified as being in fact a leap year
     */
    public function testIsLeapYearPositive()
    {
        $this->assertTrue($this->leap_year->isLeapYear($this->is_leap_year));
    }

    /**
     * Tests if the year is not identified as being a leap year
     */
    public function testIsLeapYearNegative()
    {
        $this->assertFalse($this->leap_year->isLeapYear($this->not_leap_year));
    }


}