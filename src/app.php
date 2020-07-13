<?php

use Ahc\Cli\Output\Color;
use koloda\dp\Command\Dp;
use koloda\dp\File\DuplicateFinder;
use koloda\dp\File\ResultsWriter;

require 'boot.php';

function main()
{
    // fix for dotnet
    if (!isset($argv)) {
        $argv = [];
    }

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
}

main();
