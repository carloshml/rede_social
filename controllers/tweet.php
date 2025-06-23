<?php
require_once('bd.class.php');

class Tweet
{
    private $link;

    public function __construct()
    {
        $db = new bd();
        $this->link = $db->conecta_mysql();
    }

    public function listarTweets($usuario_id)
    {
        $sql = "SELECT t.id_tweet,
                       DATE_FORMAT(t.data_inclusao,' %T %d %b %Y ') as data_inclusao,
                       t.tweet,
                       u.usuario,
                       u.foto_usuario,
                       u.id AS id_usuario
                FROM tweet AS t
                JOIN usuarios AS u ON (t.id_usuario = u.id)
                WHERE t.id_usuario = ? 
                   OR t.id_usuario IN (
                       SELECT id_usuario_seguidor
                       FROM usuarios_seguidores
                       WHERE id_usuario = ?
                   )
                ORDER BY t.id_tweet DESC";

        $stmt = $this->link->prepare($sql);
        $stmt->bind_param("ii", $usuario_id, $usuario_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function listarTweetsPorUsuario($id_usuario)
    {
        $sql = "SELECT t.id_tweet,
                       DATE_FORMAT(t.data_inclusao,' %T %d %b %Y ') as data_inclusao,
                       t.tweet,
                       u.usuario,
                       u.foto_usuario,
                       u.id AS id_usuario
                FROM tweet AS t
                JOIN usuarios AS u ON (t.id_usuario = u.id)
                WHERE t.id_usuario = ?
                ORDER BY t.id_tweet DESC";

        $stmt = $this->link->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>