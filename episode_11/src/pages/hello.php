<?php
/**
 *
 * Represents the page that takes up the request parameter name and greets the user. We are echoing the values, since
 * the output is handled by the front controller.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.4
 */

// Thanks to the extract() function in our front controller we could call the variables by their names
// So that ?name=Andrey will be translated into $params['name'] = 'Andrey'
// And then to the $name variable
?>
Hello, <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8');?>!
Today is <?php echo $current_time; ?>

