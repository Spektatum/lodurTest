
<?php
/**
 * Autoloader for classes.
 *
 * @param string $class the name of the class.
 */

 var_dump('test');
spl_autoload_register(function ($class) {
    echo "$class<br>";
    $path = "src/{$class}.php";
    if (is_file($path)) {
        include($path);
    }

});

/**
 * Autoloader for classes with namespace, exclude the vendor name.
 *
 * @param string $class the name of the class.
 */
spl_autoload_register(function ($class) {
    echo "$class<br>";

    // Base directory for the namespace prefix
    $baseDir = __DIR__ . "/src/";

    // Remove the vendor-part
    $offset = strpos($class, "\\") + 1;

    // Get the relative class name
    $relativeClass = substr($class, $offset);

    // Replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $baseDir . str_replace("\\", "/", $relativeClass) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});