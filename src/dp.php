<?php

if (php_sapi_name() !== 'cli') {
    exit('This script can only run as command-line app');
}

if ($argc < 2) {
    exit('Folder name for searching duplicates is required');
}

$folder = realpath($argv[1]);
if (!$folder) {
    exit('Path not exists');
}

echo "Start scanning...\r\n";

$files = array_diff(scandir($folder), ['.', '..']);
$hashes = [];

foreach ($files as $f) {
    $fpath = $folder . DIRECTORY_SEPARATOR . $f;
    if (is_dir($fpath)) {
        echo "Skipping folder $f\r\n";
        continue;
    }

    $hash = hash_file('sha384', $fpath);

    echo "{$f}: {$hash}\r\n";

    if (!isset($hashes[$hash])) {
        $hashes[$hash] = [];
    }

    $hashes[$hash][] = $fpath;
}

//results
$f = fopen('duplicates.txt', 'w');

foreach ($hashes as $similarFiles) {
    if (count($similarFiles) > 1) {
        $duplicates = implode("\r\n", $similarFiles) . "\r\n\r\n";
        fwrite($f, $duplicates);
    }
}

fclose($f);
exit('Done');
