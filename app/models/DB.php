<?php
namespace App\Models;
use PDO;
class DB
{
    /**
     * This method create connection to database
     * @param string $connection
     * @return PDO
     */
    public static function connect($connection = 'mysql')
    {
        $mysql = include ROOT_PATH . 'config/database.php';

        try {
            $conn = new PDO('mysql:host=localhost;dbname='.$mysql[$connection]['database'].';charset=utf8mb4', $mysql[$connection]['username'], $mysql[$connection]['password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo '<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;position: relative; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
                  <h4 style="font-size: 1.5rem;">Connection failed</h4>
                  <p style="margin-top: 0; margin-bottom: 1rem;">'.$e->getMessage().'</p>
                </div>';
            die();
        }
    }
}