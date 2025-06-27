-- Tabela `usuarios`
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    foto_usuario VARCHAR(255) NOT NULL
);

-- Tabela `tweet`
CREATE TABLE tweet (
    id_tweet INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    tweet VARCHAR(255) NOT NULL,
    data_inclusao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Tabela `seguidores`
CREATE TABLE if not exists seguidores (
    id_usuario INT,
    id_usuario_seguidor INT
);
