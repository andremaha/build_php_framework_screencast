<?php
/**
 *
 * Main application file - flat php right now
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 */

// Load the autoloader
require_once __DIR__ . 'autoload.php';

// Get the name
$input = $_GET['name'];

// Print it out
printf('Hello, %s!', $input);