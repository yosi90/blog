CREATE DATABASE blog;
USE blog;
CREATE TABLE usuarios(
id_usuario INT NOT NULL UNIQUE AUTO_INCREMENT,
nombre VARCHAR(25) NOT NULL UNIQUE,
correo VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
fecha_registro DATETIME NOT NULL,
activo TINYINT NOT NULL,
administrador TINYINT NOT NULL DEFAULT 0,
PRIMARY KEY(id_usuario)
);

CREATE TABLE entradas(
id_entrada INT NOT NULL UNIQUE AUTO_INCREMENT,
id_autor INT NOT NULL,
url VARCHAR(255) NOT NULL UNIQUE,
titulo VARCHAR(80) NOT NULL UNIQUE,
texto TEXT NOT NULL,
fecha DATETIME NOT NULL,
activa TINYINT NOT NULL,
archivada TINYINT NOT NULL DEFAULT 0,
PRIMARY KEY (id_entrada),
FOREIGN KEY (id_autor) REFERENCES usuarios (id_usuario)
ON UPDATE CASCADE
ON DELETE RESTRICT
);

CREATE TABLE entradasEditadas(
id_edicion INT NOT NULL UNIQUE AUTO_INCREMENT,
id_entrada INT NOT NULL,
id_autor INT NOT NULL,
url VARCHAR(255) NOT NULL UNIQUE,
titulo VARCHAR(80) NOT NULL UNIQUE,
texto TEXT NOT NULL,
fechaOriginal DATETIME NOT NULL,
fechaEdicion DATETIME NOT NULL,
activa TINYINT NOT NULL,
PRIMARY KEY (id_edicion),
FOREIGN KEY (id_entrada) REFERENCES entradas (id_entrada),
FOREIGN KEY (id_autor) REFERENCES usuarios (id_usuario)
ON UPDATE CASCADE
ON DELETE RESTRICT
);

CREATE TABLE usuario_archivo_entradas(
    id_usuario int not null,
    id_entrada int not null,
    PRIMARY KEY (id_usuario, id_entrada),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    FOREIGN KEY (id_entrada) REFERENCES entradas (id_entrada)
);

CREATE TABLE comentarios (
id_comentario INT NOT NULL UNIQUE AUTO_INCREMENT,
id_autor INT NOT NULL,
id_entrada INT NOT NULL,
texto TEXT NOT NULL,
fecha DATETIME NOT NULL,
PRIMARY KEY (id_comentario),
FOREIGN KEY (id_autor) REFERENCES usuarios (id_usuario)
ON UPDATE CASCADE
ON DELETE RESTRICT,
FOREIGN KEY (id_entrada) REFERENCES entradas (id_entrada)
ON UPDATE CASCADE
ON DELETE RESTRICT
);

CREATE TABLE comentariosEditados(
id_edicion INT NOT NULL UNIQUE AUTO_INCREMENT,
id_comentario INT NOT NULL,
id_autor INT NOT NULL,
texto TEXT NOT NULL,
fechaOriginal DATETIME NOT NULL,
fechaEdicion DATETIME NOT NULL,
PRIMARY KEY (id_edicion),
FOREIGN KEY (id_comentario) REFERENCES entradas (id_comentario),
FOREIGN KEY (id_autor) REFERENCES usuarios (id_usuario)
ON UPDATE CASCADE
ON DELETE RESTRICT
);