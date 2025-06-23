<?php
class BD
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'twitter_clone';
    private $charset = 'utf8mb4';

    public function conecta_mysql()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset}";

        try {
            $pdo = new PDO($dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            // Log this error in production instead of echoing
            die('Erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }
}
?>