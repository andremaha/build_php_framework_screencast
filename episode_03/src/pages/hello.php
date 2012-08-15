<?php
/**
 *
 * Represents the page that takes up the request parameter name and greets the user. We are echoing the values, since
 * the output is handled by the front controller.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     build_php_framework_screencast
 * @version     0.1
 */

// Get the name using object-oriented approach
$input = $request->get('name', 'Unknown');
?>
Hello, <?php echo htmlspecialchars($input, ENT_QUOTES, 'UTF-8');?>!
