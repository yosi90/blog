<?php
define('NOMBRE_SERVIDOR', 'localhost');
define('NOMBRE_USUARIO', 'root');
define('PASSWORD', '');
define('NOMBRE_DB', 'blog');

define("SERVIDOR", "http://localhost:8080/blog");
define("INDEX", SERVIDOR."/index");
define("RUTA_REGISTRO", SERVIDOR."/registro");
define("RUTA_REGISTRO_CORRECTO", SERVIDOR."/registro-correcto");
define("RUTA_LOGIN", SERVIDOR."/login");
define("RUTA_LOGOUT", SERVIDOR."/logout");
define("RUTA_ENTRADAS", SERVIDOR."/entradas");
define("RUTA_FAVORITOS", SERVIDOR."/favoritos");
define("RUTA_AUTORES", SERVIDOR."/autores");
define("RUTA_INICIAR_SESION", SERVIDOR."/inicio_sesion");
define("RUTA_ENTRADA", SERVIDOR."/entrada");
define("RUTA_NUEVA_ENTRADA", SERVIDOR."/nueva-entrada");
define("RUTA_EDITAR_ENTRADA", SERVIDOR."/editar-entrada");
define("RUTA_BORRAR_ENTRADA", SERVIDOR."/borrar-entrada");
define("RUTA_GESTOR", SERVIDOR."/gestor");
define("RUTA_GESTOR_ADM", SERVIDOR."/gestor-administrador");
define("RUTA_GESTOR_ENTRADAS", RUTA_GESTOR."/entradas");
define("RUTA_GESTOR_FAVORITOS", RUTA_GESTOR."/favoritos");
define("RUTA_GESTOR_COMENTARIOS", RUTA_GESTOR."/comentarios");
define("RUTA_GESTOR_ENTRADAS_USR", RUTA_GESTOR_ADM."/entradas-usuario");
define("RUTA_GESTOR_COMENTARIOS_USR", RUTA_GESTOR_ADM."/comentarios-usuario");

define("PLANTILLAS", SERVIDOR . "/plantillas/");
define("VISTAS", SERVIDOR . "/vistas/");
define("APP", SERVIDOR . "/app/");
define("IMG", SERVIDOR . "/img/");
define("CSS", SERVIDOR . "/css/");
define("JS", SERVIDOR . "/js/");
define("editor", SERVIDOR . "/libraries/ckeditor/");
?>