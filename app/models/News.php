<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ConnectionHelper;
use App\Traits\TextTrait;

class News extends Model
{
    use ConnectionHelper, TextTrait;

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


    /***********************************************************
     * ACCESSORS
     ************************************************************
     */
    public function getTrimContentAttribute()
    {
        return $this->trim_text(strip_tags($this->content), 20);
    }
}