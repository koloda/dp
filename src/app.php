<?php

require 'boot.php';

use Ahc\Cli\Output\Color;
use \koloda\dp\Command\Dp;
use \koloda\dp\File\DuplicateFinder;
use \koloda\dp\File\ResultsWriter;

$command = new Dp;

try {
    $command->parse($argv);

    $finder = new DuplicateFinder($command->dir, (bool) $command->recursive);
    $duplicates = $finder->scan();

    if (!$command->output) {
        $command->output = 'duplicates.txt';
    }
    $writer = new ResultsWriter($duplicates, $command->output);
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


