CREATE DATABASE db_chat_wp COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    nome  VARCHAR(255) NOT NULL ,
    numero INT(11) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    admin BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE contatos (
    id INT NOT NULL AUTO_INCREMENT ,
    usuario1_id INT NOT NULL ,
    usuario2_id INT NOT NULL  ,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario1_id) REFERENCES usuarios (id),
    FOREIGN KEY (usuario2_id) REFERENCES usuarios (id)

)
ENGINE = InnoDB;

CREATE TABLE mensagens (
    id INT NOT NULL AUTO_INCREMENT ,
    usuario_id INT NOT NULL ,
    destinatario_id INT NOT NULL ,
    texto VARCHAR(255) NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)

)
ENGINE = InnoDB;


INSERT INTO usuarios (nome, numero,senha, admin) 
VALUES ('admin', 42094568, '$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q', 
		true);





/* SQL TESTES

SELECT * FROM mensagens  INNER JOIN contatos ON contatos.id = mensagens.id INNER JOIN usuarios ON usuarios = mensagens.usuario_id;

SELECT * FROM mensagens INNER JOIN contatos ON contatos.id = mensagens.id INNER JOIN usuarios ON contatos.usuario2_id = usuarios.id

SELECT * FROM mensagens INNER JOIN contatos ON contatos.id = mensagens.id INNER JOIN usuarios ON contatos.usuario2_id = usuarios.id OR  usuarios.id = contatos.usuario1_id;
 SELECT * FROM mensagens INNER JOIN contatos ON contatos.id = mensagens.id INNER JOIN usuarios ON contatos.usuario2_id = 2 OR  usuarios.id = 1;
SELECT * FROM mensagens INNER JOIN contatos ON contatos.id = mensagens.id WHERE contatos.usuario1_id = 1 OR contatos.usuario2_id = 2


SELECT * FROM mensagens INNER JOIN contatos ON contatos.id = mensagens.id INNER JOIN usuarios ON contatos.usuario2_id = usuarios.id WHERE contatos.usuario1_id = 1 OR contatos.usuario2_id = 2
SELECT * FROM contatos WHERE contatos.usuario1_id = 1 OR contatos.usuario2_id = 2
SELECT * FROM mensagens INNER JOIN usuarios WHERE usuarios.id = 5 AND mensagens.destinatario_id = 4 OR  usuarios.id = 5  AND mensagens.destinatario_id = 4
*/