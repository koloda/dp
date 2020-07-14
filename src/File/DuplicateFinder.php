<?php

namespace koloda\dp\File;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * General class todetect duplicates
 */
class DuplicateFinder
{
    private string $folderPath;
    private bool $recursive;

    /**
     * @param string $folder    Folder to search duplicates
     */
	public function __construct(string $folder, bool $recursive = false)
	{
        $this->folderPath = realpath($folder);
        $this->recursive = $recursive;

		if (!$this->folderPath) {
		    throw new \RuntimeException('Path not exists');
		}
    }

    /**
     * Scans directory and prepare array with duplicatesinfo
     *
     * @return array
     */
    public function scan(): array
    {
        $files = $this->getFiles();
        $hashes = [];
        $duplicates = [];

        foreach ($files as $fpath) {
            if (is_dir($fpath)) {
                continue;
            }

            $hash = hash_file('crc32', $fpath);

            if (!isset($hashes[$hash])) {
                $hashes[$hash] = [];
            }

            $hashes[$hash][] = $fpath;
        }

        foreach ($hashes as $hash => $similarFiles) {
            if (count($similarFiles) > 1) {
                $duplicates[$hash] = $similarFiles;
            }
        }

        return $duplicates;
    }

    protected function getFiles()
    {
        if ($this->recursive) {
            $dirIterator = new RecursiveDirectoryIterator($this->folderPath);
            $iterator = new RecursiveIteratorIterator($dirIterator);
            $files = [];

            /** @var \SplFileInfo $file */
            foreach ($iterator as $file) {
                if (!$file->isDir()) {
                    $files[] = $file->getPathname();
                }
            }

            return $files;
        } else {
            $files = array_diff(scandir($this->folderPath), ['.', '..']);

            return array_map(
                function ($file) {
                    return $this->folderPath . DIRECTORY_SEPARATOR . $file;
                },
                $files
            );
        }
    }
}
