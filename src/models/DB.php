<?php

abstract class DB
{
    // Configs de la base de données
    private static string $host = 'localhost';
    private static string $dbname = 'festivoituragedb';
    private static string $user = 'root';
    private static string $password = '';
    // Objet de connexion à la base de données
    private static PDO | null $db = null;
    // Initialisation cde la connexion
    public static function init(): void
    {
        try {
            self::$db = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname, self::$user, self::$password);
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage() . "</p>";
            die();
        }
    }

    public static function getConnection(): PDO | null
    {
        return self::$db;
    }

    public static function close(): void
    {
        unset(self::$db);
    }

    public static function isOpen(): bool
    {
        return self::$db != null;
    }
}
