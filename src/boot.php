<?php

if (php_sapi_name() !== 'cli') {
    exit('This script can only run as command-line app');
}

require './vendor/autoload.php';

spl_autoload_register(function ($class)
{
    $prefix = 'dp\\';
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
