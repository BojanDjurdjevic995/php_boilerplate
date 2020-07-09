<?php
namespace App\Models;

use PDO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\MySqlConnection;

class News extends Model
{
    protected $table = 'news';

    public function getConnection()
    {
        $DB         = include ROOT_PATH . 'config/database.php';
        $db         = $DB['connections']['mysql']['database'];
        $user       = $DB['connections']['mysql']['username'];
        $pass       = $DB['connections']['mysql']['password'];
        $charset    = $DB['connections']['mysql']['charset'];
        $pdo        = new PDO('mysql:host=localhost;dbname='.$db.';charset=' . $charset, $user, $pass);

        $conn = new MySqlConnection($pdo, env('DB_DATABASE'), '', $DB['connections']['mysql']);
        return $conn;
    }

    public function children()
    {
        return $this->hasMany(NewsLang::class, 'news_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'news_id', 'id');
    }
}