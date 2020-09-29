<?php
namespace App\Models;

use App\Traits\ConnectionHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class NewsLang extends Model
{
    use ConnectionHelper;

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
        return Str::limit(strip_tags($this->content), 23);
    }
}