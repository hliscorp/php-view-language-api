<?php

namespace Lucinda\Templating;

/**
 * Abstracts view compilation logic.
 */
class ViewCompilation
{
    private string $compilationPath;
    private string $checksumPath;
    /**
     * @var string[]
     */
    private array $components = [];

    /**
     * Creates a compilation instance.
     *
     * @param string $compilationsFolder
     * @param string $templatePath
     */
    public function __construct(string $compilationsFolder, string $templatePath)
    {
        $this->compilationPath = $compilationsFolder."/".$templatePath.".php";
        $this->checksumPath = $compilationsFolder."/checksums/".crc32($templatePath).".crc";
        // preset components referenced in checksum
        $file = new File($this->checksumPath);
        if ($file->exists()) {
            $contents = $file->getContents();
            $this->components = explode(",", $contents);
        }
    }

    /**
     * Gets compilation file path.
     *
     * @return string
     */
    public function getCompilationPath(): string
    {
        return $this->compilationPath;
    }

    /**
     * Adds a compilation component (template / tag)
     *
     * @param string $path Path to component.
     */
    public function addComponent(string $path): void
    {
        $this->components[] = $path;
    }

    /**
     * Gets latest modification time of compilation components.
     *
     * @return int Greater than zero if all components found, -1 if at least one component is not found.
     */
    private function getLatestModificationTime(): int
    {
        $latestDate = 0;
        foreach ($this->components as $file) {
            $file = new File($file);
            if (!$file->exists()) {
                return -1;
            }
            $time = $file->getModificationTime();
            if ($time>$latestDate) {
                $latestDate = $time;
            }
        }
        return $latestDate;
    }

    /**
     * Saves compilation & its checksum to disk.
     *
     * @param  string $outputStream
     * @throws ViewException
     */
    public function save(string $outputStream): void
    {
        // saves checksum
        $file = new File($this->checksumPath);
        $file->putContents(implode(",", $this->components));

        // saves compilation
        $compilation = new File($this->compilationPath);
        $compilation->putContents($outputStream);
    }

    /**
     * Checks if any of compilation components have changed since last update.
     *
     * @return boolean
     */
    public function hasChanged(): bool
    {
        $compilation = new File($this->compilationPath);
        if (!empty($this->components)) {
            if ($compilation->exists()) {
                $time = $this->getLatestModificationTime();
                if ($time==-1) {
                    $this->components = [];
                    return true;
                }
                if ($compilation->getModificationTime() >= $time) {
                    return false;
                }
            }
            // reset components
            $this->components = [];
        }
        return true;
    }
}
