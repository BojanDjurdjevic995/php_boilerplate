<?php
namespace App\Traits;

use App\Providers\Builder;
use PDO;
use Illuminate\Database\MySqlConnection;

trait ConnectionHelper
{
    public function getConnection($connection = 'mysql')
    {
        $connection = isset($this->conn) ? $this->conn : $connection;
        $DB      = include base_path('config/database.php');
        $DB      = $DB['connections'][$connection];
        $db      = $DB['database'];
        $user    = $DB['username'];
        $pass    = $DB['password'];
        $charset = $DB['charset'];

        $pdo = new PDO('mysql:host=localhost;dbname='.$db.';charset=' . $charset, $user, $pass);
        $conn = new MySqlConnection($pdo, env('DB_DATABASE'), '', $DB);
        return $conn;
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}