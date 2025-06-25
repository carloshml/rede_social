<?php
require_once(__DIR__ . '/../controllers/bd.class.php');

class TweetService
{
    private $link;

    public function __construct()
    {
        $db = new BD();
        $this->link = $db->conecta_database();
    }

    public function listarTweets($usuario_id)
    {
        $sql = "
            SELECT 
                t.id_tweet,
                DATE_FORMAT(t.data_inclusao, ' %T %d %b %Y ') AS data_inclusao,
                t.tweet,
                u.usuario,
                u.foto_usuario,
                u.id AS id_usuario
            FROM tweet AS t
            JOIN usuarios AS u ON t.id_usuario = u.id
            WHERE t.id_usuario = :usuario_id
               OR t.id_usuario IN (
                   SELECT id_usuario_seguidor
                   FROM seguidores
                   WHERE id_usuario = :usuario_id
               )
            ORDER BY t.id_tweet DESC
        ";

        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTweetsPorUsuario($id_usuario)
    {
        $sql = "
            SELECT 
                t.id_tweet,
                DATE_FORMAT(t.data_inclusao, ' %T %d %b %Y ') AS data_inclusao,
                t.tweet,
                u.usuario,
                u.foto_usuario,
                u.id AS id_usuario
            FROM tweet AS t
            JOIN usuarios AS u ON t.id_usuario = u.id
            WHERE t.id_usuario = :id_usuario
            ORDER BY t.id_tweet DESC
        ";

        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>