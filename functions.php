<?php

/**automatically load classes without requiring manual includes*/

// Define the base directories for our class files
define('BASE_PATH', __DIR__);
define('CLASSES_PATH', BASE_PATH . '/classes');

/**
* @param string $class The fully qualified class name*/
function customAutoloader($class) {
    // Convert class name to file path
    $file = CLASSES_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    
    
    if (file_exists($file)) {
        require_once $file;
    }
}

// Register the autoloader function
spl_autoload_register('customAutoloader');

// Include existing Product classes
require_once 'Product.inc.php';

// Include session handler for POS session management
require_once 'session.php';

/**
 * Returns extension-related information for a file
 * @param string $fileName The name or path of the file
 * @return string The file extension (e.g., 'jpg', 'php')
 */
function info($fileName) {
    return pathinfo($fileName, PATHINFO_EXTENSION);
}

?>
