<?php
/**
 * PHPMailer SPL autoloader.
 * Automatically requires classes from PHPMailer directory.
 */
spl_autoload_register(function ($class) {
    // Project-specific namespace prefix
    $prefix = 'PHPMailer\\PHPMailer\\';

    // Base directory for the namespace prefix
    $base_dir = __DIR__ . '/';

    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // No, move to the next registered autoloader
        $class = str_replace('\\', '/', $class);
        $file = $base_dir . $class . '.php';
    } else {
        // Get the relative class name
        $relative_class = substr($class, $len);

        // Replace the namespace prefix with the base directory, replace namespace
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    }

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
