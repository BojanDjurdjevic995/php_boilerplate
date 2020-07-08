<?php
namespace App\Controllers;

class FileController
{
    protected $file = '';
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Return name of upload file
     * @return string
     */
    public function name()
    {
        return $_FILES[$this->file]['name'];
    }

    /**
     * Return size of upload file
     * @return integer
     */
    public function size()
    {
        return ceil($_FILES[$this->file]['size'] / 1024);
    }

    /**
     * Return type of upload file
     * @return string
     */
    public function type()
    {
        return $_FILES[$this->file]['type'];
    }

    /**
     * Return tmp name of upload file
     * @return string
     */
    public function tmpName()
    {
        return $_FILES[$this->file]['tmp_name'];
    }

    /**
     * Return file extension of upload file
     * @return string
     */
    public function extension()
    {
        $fileNameCmps = explode(".", $this->name());
        return strtolower(end($fileNameCmps));
    }

    /**
     * Return boolean if file stored
     * @param $tmpName
     * @param $path
     * @return bool
     */
    public function upload($tmpName, $path)
    {
        return move_uploaded_file($tmpName, $path) ? true : false;
    }

    /**
     * Return boolean if file exist
     * @param $file
     * @return bool
     */
    public static function hasFile($file)
    {
         return $_FILES[$file]['size'] ? true : false;
    }
}
