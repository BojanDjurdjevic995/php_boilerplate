<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ConnectionHelper;

class Gallery extends Model
{
    use ConnectionHelper;
    protected $table = 'galleries';

}