<?php


namespace App\Models;


use App\Traits\ConnectionHelper;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use ConnectionHelper;

    protected $table = 'users';
}