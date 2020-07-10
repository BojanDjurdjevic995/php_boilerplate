<?php
namespace App\Traits;

use PDO;
use Illuminate\Database\MySqlConnection;

trait ConnectionHelper
{
    public function getConnection()
    {
        $DB = include ROOT_PATH . 'config/database.php';
        $db = $DB['connections']['mysql']['database'];
        $user = $DB['connections']['mysql']['username'];
        $pass = $DB['connections']['mysql']['password'];
        $pdo = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8mb4', $user, $pass);

        $conn = new MySqlConnection($pdo, env('DB_DATABASE'), '', $DB['connections']['mysql']);
        return $conn;
    }
}