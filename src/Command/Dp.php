<?php

namespace koloda\dp\Command;

use Ahc\Cli\Input\Command;

/**
 * Command parser for dp app
 *
 * @property string $dir
 * @property string $recursive
 * @property string $output
 */
class Dp extends Command
{
    public function __construct()
    {
        parent::__construct(
            'dp',
            'Search file duplicates and provide functionality to delete them'
        );

        $this->version('0.1')
            ->argument('<dir>', 'Directory for search')
            ->option(
                '-r --recursive',
                'Search duplicates recursively (in all subdirectories)'
            )
            ->option(
                '-o --output',
                'Output file'
            );
    }
}
