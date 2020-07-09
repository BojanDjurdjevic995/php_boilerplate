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
    public function getName()
    {
        return $_FILES[$this->file]['name'];
    }

    /**
     * Return size of upload file
     * @return integer
     */
    public function getSize()
    {
        return ceil($_FILES[$this->file]['size'] / 1024);
    }

    /**
     * Return type of upload file
     * @return string
     */
    public function getType()
    {
        return $_FILES[$this->file]['type'];
    }

    /**
     * Return tmp name of upload file
     * @return string
     */
    public function getTmpName()
    {
        return $_FILES[$this->file]['tmp_name'];
    }

    /**
     * Return file extension of upload file
     * @return string
     */
    public function getExtension()
    {
        $fileNameCmps = explode(".", $this->getName());
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
