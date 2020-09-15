<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ConnectionHelper;

class News extends Model
{
    use ConnectionHelper;

    protected $table = 'news';

    /***********************************************************
     * RELATIONS
     ************************************************************
     */
    public function children()
    {
        return $this->hasMany(NewsLang::class, 'news_id', 'id')->where('lang', env('news_lang', 'en'));
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'news_id', 'id');
    }
}