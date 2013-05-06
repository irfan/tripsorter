<?php
/**
 * Short description:
 * System bootstrap file
 * 
 * @author Irfan Durmus
 */
 
/**
 * Open error reporting.
 */
error_reporting(E_ALL);

/**
 * Add include path.
 */
set_include_path(get_include_path() . ':' . __DIR__ . '/lib/');

/**
 * Autoloader for trip sorter. 
 * Checks namespaces and loads classes automatically.
 * @param $class class names with namespace
 */
function __autoload($class) {
    
    $class = ltrim($class, '\\');
    $file  = '';
    $namespace = '';
    
    if ($endOfNs = strrpos($class, '\\')) {
        $namespace = substr($class, 0, $endOfNs);
        $class = substr($class, $endOfNs + 1);
        $file  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    
    $file .= str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
    
    require_once $file;
}