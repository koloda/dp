<?php

namespace dp\Command;

use Ahc\Cli\Input\Command;

/**
 * Command parser for dp app
 *
 * @property string $dir
 * @property string $recursive
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
            );
    }
}
