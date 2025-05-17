<?php
//Conexão via PDO para Database
class bd
{
    //ALTERE DE ACORDO COM AS CONFIGURAÇÕES DE USUÁRIO E DATABASE.
    //Host
    private $host = 'localhost'; //Normalmente é localhost.
    //Usuário
    private $user = 'root';
    //Senha:
    private $password = ''; //Deixe vazia caso não exista.
    //Bando de Dados:
    private $database = 'twitter_clone';
    public function conecta_mysql()
    {
        // cria conexão
        $con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        // char set de comunicação entre a aplicação e o banco de dados;
        mysqli_set_charset($con, 'utf8');
        // verificar se houve erro de conexão;
        if (mysqli_connect_errno()) {
            echo 'Erro ao tentar se conectar com o BD Mysql' . msqli_connect_error();
        }
        return $con;
    }
}
?>