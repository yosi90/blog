CREATE DATABASE blog;

USE blog;

CREATE TABLE usuarios(
    id_usuario INT NOT NULL UNIQUE AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL UNIQUE,
    correo VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro DATETIME NOT NULL,
    activo TINYINT NOT NULL,
    moderador TINYINT NOT NULL DEFAULT 0,
    administrador TINYINT NOT NULL DEFAULT 0,
    bloqueado TINYINT NOT NULL DEFAULT 0,
    PRIMARY KEY(id_usuario)
);

CREATE TABLE usuariosUrlActualizar(
    id_url INT NOT NULL UNIQUE AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    url VARCHAR(255) NOT NULL,
    fecha DATETIME NOT NULL,
    intentos INT NOT NULL DEFAULT 1,
    PRIMARY KEY (id_url),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE usuariosUrlActivar(
    id_url INT NOT NULL UNIQUE AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    url VARCHAR(255) NOT NULL,
    fecha DATETIME NOT NULL,
    PRIMARY KEY (id_url),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE entradas(
    id_entrada INT NOT NULL UNIQUE AUTO_INCREMENT,
    url VARCHAR(255) NOT NULL UNIQUE,
    titulo VARCHAR(80) NOT NULL UNIQUE,
    texto TEXT NOT NULL,
    fecha DATETIME NOT NULL,
    activa TINYINT NOT NULL DEFAULT 1,
    archivada TINYINT NOT NULL DEFAULT 0,
    bloqueada TINYINT NOT NULL DEFAULT 0,
    PRIMARY KEY (id_entrada)
);

CREATE TABLE usuario_entradas(
    id_usuario INT NOT NULL,
    id_entrada INT NOT NULL,
    PRIMARY KEY (id_usuario, id_entrada),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (id_entrada) REFERENCES entradas (id_entrada) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE entradas_ediciones(
    id_edicion INT NOT NULL UNIQUE AUTO_INCREMENT,
    id_entrada INT NOT NULL,
    url VARCHAR(255) NOT NULL,
    titulo VARCHAR(80) NOT NULL,
    texto TEXT NOT NULL,
    fecha DATETIME NOT NULL,
    activa TINYINT NOT NULL,
    PRIMARY KEY (id_edicion),
    FOREIGN KEY (id_entrada) REFERENCES entradas (id_entrada) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE comentarios (
    id_comentario INT NOT NULL UNIQUE AUTO_INCREMENT,
    texto TEXT NOT NULL,
    fecha DATETIME NOT NULL,
    bloqueado TINYINT NOT NULL DEFAULT 0,
    PRIMARY KEY (id_comentario)
);

CREATE TABLE usuario_comentarios(
    id_usuario INT NOT NULL,
    id_comentario INT NOT NULL,
    PRIMARY KEY (id_usuario, id_comentario),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (id_comentario) REFERENCES comentarios (id_comentario) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE entrada_comentarios(
    id_entrada INT NOT NULL,
    id_comentario INT NOT NULL,
    indice INT NOT NULL DEFAULT 0,
    PRIMARY KEY(id_entrada, id_comentario),
    FOREIGN KEY (id_entrada) REFERENCES entradas (id_entrada) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (id_comentario) REFERENCES comentarios (id_comentario) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE comentarios_ediciones(
    id_edicion INT NOT NULL UNIQUE AUTO_INCREMENT,
    id_comentario INT NOT NULL,
    texto TEXT NOT NULL,
    fecha DATETIME NOT NULL,
    PRIMARY KEY (id_edicion),
    FOREIGN KEY (id_comentario) REFERENCES comentarios (id_comentario) ON UPDATE CASCADE ON DELETE RESTRICT
);