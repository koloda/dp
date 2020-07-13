<?php

namespace dp\File;

class DuplicateFinder
{
    private string $folderPath;

	public function __construct(string $folder)
	{
		$this->folderPath = realpath($folder);

		if (!$this->folderPath) {
		    throw new \RuntimeException('Path not exists');
		}
    }

    public function scan(): array
    {
        $files = array_diff(scandir($this->folderPath), ['.', '..']);
        $hashes = [];
        $duplicates = [];

        foreach ($files as $f) {
            $fpath = $this->folderPath . DIRECTORY_SEPARATOR . $f;

            if (is_dir($fpath)) {
                echo "Skipping folder $f\r\n";
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
}
