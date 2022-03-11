<?php
    
    session_name("magnumopus");
	session_start();

	ini_set ('display_errors', 1);
	ini_set('memory_limit', '256M');
	ini_set ('display_startup_errors', 1);
	ini_set ('max_execution_time', 300); //300 seconds = 5 minutes
	error_reporting (E_ALL);

	date_default_timezone_set ("Europe/Lisbon");

	DEFINE ('NOME_PROJETO' , "Magnum Opus");
	DEFINE ('ROOT_DIR' , __DIR__ . DIRECTORY_SEPARATOR);

	DEFINE ('EXT_URL'  , ".php");
	DEFINE ('ROOT_URL' , "http://localhost/MagnumOpusWEB/");

	DEFINE ('HANDLE_DIR' , ROOT_DIR . "handle/");
	DEFINE ('INCLUDE_DIR' , ROOT_DIR . "include" . DIRECTORY_SEPARATOR);
	/* Index */
	DEFINE ('INDEX_URL' , ROOT_URL);
	
	/* Imagem */
	DEFINE ('IMG_URL' , ROOT_URL . "img/");

	/* Login */
	DEFINE ('LOGIN_URL' , ROOT_URL . "login" . EXT_URL);

	DEFINE ('MAINFORM_URL', ROOT_URL . "mainform" . EXT_URL);

	/* Logout */
	DEFINE ('LOGOUT_URL' , ROOT_URL . "logout" . EXT_URL);

	/* Funcionários */
	DEFINE ('UTILIZADORES_URL', ROOT_URL . "funcionarios" . EXT_URL);

	/* Clientes */
	DEFINE ('CLIENTES_URL', ROOT_URL . "clientes" . EXT_URL);

	/* Categorias */
	DEFINE ('CATEGORIAS_URL', ROOT_URL . "categorias" . EXT_URL);
	
	/* Encomendas */
	DEFINE ('ENCOMENDAS_URL', ROOT_URL . "encomendas" . EXT_URL);

	/* Inventario */
	DEFINE ('INVENTARIO_URL', ROOT_URL . "inventario" . EXT_URL);

	DEFINE ('DB_HOST' , "127.0.0.1");
	DEFINE ('DB_NAME' , "magnumopus_db");
	DEFINE ('DB_USER' , "root");
	DEFINE ('DB_PASS' , "");

	require ("requires.php");

	$core->initDB();

?>