<?php
/**
 *
 * Uses the Symfony Universal Class loader to automatically load the classes based on the PSR-0 Standard
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.3
 */

require_once __DIR__ . '/../vendor/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

// Register the loader
$loader = new UniversalClassLoader();
$loader->register();
$loader->registerNamespace('Symfony\\Component\\HttpFoundation', __DIR__ . '/../vendor/symfony/http-foundation');