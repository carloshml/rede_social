# Projeto CRUD em PHP - Rede_Social

Este é um projeto de estudo para a construção de uma rede social semelhante ao Twitter, utilizando **PHP** e **MySQL**. O objetivo é compreender o funcionamento do **CRUD (Create, Read, Update, Delete)** na prática, aplicando conceitos essenciais de banco de dados e desenvolvimento web.

## 📌 Objetivos e Recursos

✅ Cadastro e login de usuários  
✅ Postagem de tweets  
✅ Sistema de seguidores  
✅ Interface simples para interação  
✅ Estudo de boas práticas em PHP e MySQL  


## 🚀 Tecnologias Utilizadas

- **PHP** – Para a construção do backend
- **MySQL** – Banco de dados relacional

## 📂 Estrutura do Banco de Dados

O sistema utiliza três tabelas principais para gerenciamento de usuários, tweets e seguidores:

### Tabela `usuarios`
Armazena os dados dos usuários cadastrados na rede social.

```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    foto_usuario VARCHAR(255) NOT NULL
);
```

### Tabela `tweet`
Guarda as postagens feitas pelos usuários, incluindo a data e o autor do tweet.

```sql
CREATE TABLE tweet (
    id_tweet INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    tweet VARCHAR(255) NOT NULL,
    data_inclusao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

### Tabela `usuarios_seguidores`
Registra o relacionamento entre usuários e seguidores.

```sql
CREATE TABLE if not exists usuarios_seguidores (
    id_usuario INT,
    seguindo_id_usuario INT
);
```

 