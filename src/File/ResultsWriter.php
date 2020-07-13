<?php

namespace koloda\dp\File;

/**
 * General class to write app results to file
 */
class ResultsWriter
{
    private string $file;
    private array $duplicates;

    /**
     * @param array $duplicates     List of duplicates (Result of DuplicatesFinder::scan())
     * @param string $file Output   file to write results
     */
    public function __construct(array $duplicates, string $file = 'duplicates.txt')
    {
        $this->file = realpath(getcwd()) . DIRECTORY_SEPARATOR . $file;
        $this->duplicates = $duplicates;

        if (is_dir($this->file)) {
            throw new \RuntimeException("Bad output file location specified");
        }
    }

    /**
     * Writes information about duplicates tofile
     *
     * @return void
     */
    public function flush()
    {
        $f = fopen($this->file, 'w');

        foreach ($this->duplicates as $hash => $similarFiles) {
            $lines = implode("\r\n", $similarFiles) . "\r\n\r\n";
            fwrite($f, $lines);
        }

        fclose($f);
    }
}
