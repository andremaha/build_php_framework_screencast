<?php
/**
 *
 * Represents the final page of the framework - we want to be nice to our users and wish them the pleasant journey
 * on the web.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */
?>
<p>Farewell!</p>
<p>Are you missing the service already? Well, you can always just <a href="<?php echo $generator->generate('hello', array('name' => 'Your Name Here'));?>">go back</a>.</p>
