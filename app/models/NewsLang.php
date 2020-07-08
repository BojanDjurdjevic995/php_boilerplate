<?php
namespace App\Models;

class NewsLang extends Model
{
    protected static $table = 'news_langs';
    public $data = ['news_id' => NULL, 'image' => NULL, 'title' => NULL, 'content' => NULL, 'slug' => NULL, 'link' => NULL,
        'lang' => NULL, 'created_at' => NULL, 'updated_at' => NULL];

    /**
     * @param null $varName
     * @return |null
     */
    public function __get($varName = NULL)
    {
        if ($varName) return (isset($this->data[$varName]) ? $this->data[$varName] : NULL);
        else return $this->data;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * This method adds new record to database
     * @return bool
     */
    public function save()
    {
        $columns    = array();
        $value      = array();
        $where      = array();
        if (isset($this->data['id']))
        {
            $where[]    = 'id';
            foreach ($this->data as $key => $data)
            {
                if ($key != 'id') {
                    if ($key == 'updated_at') {
                        $this->data['updated_at'] = timeStamp();
                        $data = timeStamp();
                    }

                    $columns[]  = $key;
                    $value[]    = $data;
                } else
                    $where[]    = $data;
            }
            return self::update($columns, $value, $where);
        } else {
            foreach ($this->data as $key => $data)
            {
                if ($key == 'created_at' || $key == 'updated_at') {
                    $this->data['created_at'] = timeStamp();
                    $this->data['updated_at'] = timeStamp();
                    $data = timeStamp();
                }
                $columns[]  = $key;
                $value[]    = $data;
            }
            if ( $this->data['id'] = self::insert($columns, $value))
                return true;
            return false;
        }
    }
}