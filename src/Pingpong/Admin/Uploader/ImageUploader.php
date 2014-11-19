<?php namespace Pingpong\Admin\Uploader;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ImageUploader {

    /**
     * @var string
     */
    protected $ext = '.png';

    /**
     * @param $ext
     * @return $this
     */
    public function setExt($ext)
    {
        $this->ext = $ext;

        return $this;
    }

    /**
     * @return string
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @return string
     */
    public function getRandomFilename()
    {
        return sha1(str_random()) . $this->getExt();
    }

    /**
     * @return string
     */
    public function getDestinationFile()
    {
        return public_path(str_finish($this->path, '/') . $this->filename);
    }

    /**
     * @param $width
     * @return $this
     */
    public function widen($width)
    {
        $this->image->widen($width);

        return $this;
    }

    /**
     * @param $file
     * @return $this
     */
    public function upload($file)
    {
        $this->filename = $this->getRandomFilename();
        $this->image = Image::make(Input::file($file)->getRealPath());

        return $this;
    }

    public function getDestinationDirectory()
    {
        return dirname($this->getDestinationFile());
    }

    /**
     * @param null $path
     * @return mixed
     */
    public function save($path = null)
    {
        if ( ! is_null($path)) $this->path = $path;

        if( ! is_dir($path = $this->getDestinationDirectory()))
        {
            File::makeDirectory($path, 0777, true);
        }

        $this->image->save($this->getDestinationFile());

        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }
}