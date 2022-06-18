<?php

namespace Library;

class Storage {

    private static $instance = null;
    private $folder_disk = null;

    public static function disk($disk) : Storage
    {
        if(self::$instance === null) self::$instance = new Storage($disk);
        else self::$instance->folder_disk = $disk;

        return self::$instance;
    }

    public function __construct($disk)
    {
        $this->folder_disk = $disk;
    }

    public function path($file)
    {
        return STORAGE_DIR . $this->folder_disk . DIRECTORY_SEPARATOR . $file;
    }

    public function has($file)
    {
        return file_exists($this->path($file));
    }

    public function put($file, $content)
    {
        file_put_contents($this->path($file), $content);
        return $content;
    }

}