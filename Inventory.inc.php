<?php

/**automatically load classes without requiring manual includes*/

// Define the base directories for our class files
define('BASE_PATH', __DIR__);
define('CLASSES_PATH', BASE_PATH . '/classes');

/**
 * @param string $class The fully qualified class name
 * @return void
 */
function customAutoloader(string $class): void {
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

/**
 * Returns extension-related information for a file
 * @param string $fileName The name or path of the file
 * @return string The file extension (e.g., 'jpg', 'php')
 */
function info(string $fileName): string {
    return pathinfo($fileName, PATHINFO_EXTENSION);
}

function putonsale(mysqli $conn, string $sku, string $discount_id): bool {
    $stmt = $conn->prepare("UPDATE inventory SET discount_id = ? WHERE sku = ?");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("ss", $discount_id, $sku);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function takeofsale(mysqli $conn, string $sku): bool {
    $stmt = $conn->prepare("UPDATE inventory SET discount_id = NULL WHERE sku = ?");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("s", $sku);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

?>