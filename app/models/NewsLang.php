<?php
namespace App\Models;

use App\Traits\ConnectionHelper;
use App\Traits\TextTrait;
use Illuminate\Database\Eloquent\Model;

class NewsLang extends Model
{
    use TextTrait, ConnectionHelper;

    protected $table = 'news_langs';

    /***********************************************************
     * RELATIONS
     ************************************************************
     */
    public function parent()
    {
        return $this->hasOne(News::class, 'id', 'news_id');
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