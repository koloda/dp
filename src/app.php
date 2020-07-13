<?php

use Ahc\Cli\Output\Color;
use dp\Command\Dp;
use dp\File\DuplicateFinder;
use dp\File\ResultsWriter;

require 'boot.php';

$command = new Dp;

try {
    $command->parse($argv);
    $finder = new DuplicateFinder($command->dir);
    $duplicates = $finder->scan();
    $writer = new ResultsWriter($duplicates);
    $writer->flush();
    $color = new Color;

    if (count($duplicates)) {
        $cnt = count($duplicates);
        echo $color->warn("{$cnt} files has duplicates\r\n");
    } else {
        echo $color->ok("No files with duplicates found\r\n");
    }
} catch (\Exception $e) {
    $color = new Color;
    echo $color->error($e->getMessage()) . "\r\n\r\n";
    $command->showHelp();
}


