<?php

//run app only via cli
if (php_sapi_name() !== 'cli') {
    exit('This script can only run as command-line app');
}

// set autoloader
spl_autoload_register(function ($class)
{
    $prefix = 'koloda\dp\\';
    $baseDir = realpath(__DIR__ . '/.') . '/';
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

require './vendor/autoload.php';
