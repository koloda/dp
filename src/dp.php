<?php

use dp\File\DuplicateFinder;
use dp\File\ResultsWriter;

require 'boot.php';

if ($argc < 2) {
    exit('Folder name for searching duplicates is required');
}

echo "Start scanning...\r\n";

$finder = new DuplicateFinder($argv[1]);
$duplicates = $finder->scan();
$writer = new ResultsWriter($duplicates);
$writer->flush();

exit('Done');
