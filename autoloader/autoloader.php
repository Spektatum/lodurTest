<?php
/**
 *   Config file for php unit tests
 *   php version 7
 *
 * @category Test
 * @package  Lodur
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

 
/**
 * Autoloader for classes with namespace
 * Excludes the vendor name = first part of namespace 
 * Then locates the class file in the decided location (src)
 * 
 * This enables you to use namespace & load and start objects
 * in different parts of the code. 
 * https://www.php.net/manual/en/function.spl-autoload-register.php
 * https://www.php.net/manual/en/language.namespaces.definition
 *
 * @param string $class the name of the class.
 */
spl_autoload_register(function ($class) {
    // echo "type2: $class<br>";

    // Here is the source for the object oriented programming
    $baseDir = __DIR__ . "/../src";

    // Here the main vendor name is excluded to find the files
    $dir = str_replace(NAMESPACE1, '', $class);

    // And the file direction is completed
    $file = $baseDir . str_replace("\\", "/", $dir) . '.php';

    // If the file exists, require it
    // and you can instantiate the object directly in the code
    if (file_exists($file)) {
        require $file;
    }
});