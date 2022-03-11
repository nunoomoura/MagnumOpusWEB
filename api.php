<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		die(json_encode(array("success" => false , "message" => 'Apenas poderá fazer pedidos através do método POST')));

	};


	if (isset($_POST)) {
		require ("config.php");
	};


	if (isset($_POST["cmd"])) {

		if (isset($_POST["data"])) {
			parse_str($_POST["data"], $data);
		};

		/* Login */
		if ($_POST["cmd"] == "doLogin") {
			doLogin($data);
		};

		/*Perfil*/
		if ($_POST["cmd"] == "editProfile") {
			editProfile($data);
		};
		
		/*User*/
		if ($_POST["cmd"] == "verUser") {
			verUser($_POST["id"]);
		};
		if ($_POST["cmd"] == "editUser") {
			editUser($data);
		};
		if ($_POST["cmd"] == "eliminarUser") {
			eliminarUser($_POST["id"]);
		};
		if ($_POST["cmd"] == "addUser") {
			addUser($data);
		};

		/*Clientes*/
		if ($_POST["cmd"] == "verClient") {
			verClient($_POST["cod_cliente"]);
		};
		if ($_POST["cmd"] == "editClient") {
			editClient($data);
		};
		if ($_POST["cmd"] == "eliminarClient") {
			checkClient($_POST["cod_cliente"]);
			eliminarClient($_POST["cod_cliente"]);
		};
		if ($_POST["cmd"] == "addClient") {
			addClient($data);
		};
		/*Categorias*/
		if ($_POST["cmd"] == "verCat") {
			verCat($_POST["cod_categoria"]);
		};
		if ($_POST["cmd"] == "editCat") {
			editCat($data);
		};
		if ($_POST["cmd"] == "eliminarCat") {
			eliminarCat($_POST["cod_categoria"]);
		};
		if ($_POST["cmd"] == "addCat") {
			addCat($data);
		};

		/*SubCategorias*/
		if ($_POST["cmd"] == "verSubCat") {
			verSubCat($_POST["cod_subcategoria"]);
		};
		if ($_POST["cmd"] == "editSubCat") {
			editSubCat($data);
		};
		if ($_POST["cmd"] == "eliminarSubCat") {
			eliminarSubCat($_POST["cod_subcategoria"]);
		};
		if ($_POST["cmd"] == "addSubCat") {
			addSubCat($data);
		};


		if ($_POST["cmd"] == "getSubCategorias"){
			getSubCat($_POST['idCat']);
			
		};


		/* Produtos */
		if ($_POST["cmd"] == "verProd") {
			verProd($_POST["cod_produto"]);
		};
		if ($_POST["cmd"] == "editProd") {
			editProd($data);
		};
		if ($_POST["cmd"] == "eliminarProd") {
			eliminarProd($_POST["cod_produto"]);
		};
		if ($_POST["cmd"] == "addProd") {
			addProd($data);
		};

		/* Encomendas 
		if ($_POST["cmd"] == "verEncProd") {
			verProd($_POST["cod_produto"]);
		};
		if ($_POST["cmd"] == "editProd") {
			editProd($data);
		};
		if ($_POST["cmd"] == "eliminarProd") {
			eliminarProd($_POST["cod_produto"]);
		};
		if ($_POST["cmd"] == "addProd") {
			addProd($data);
		};*/		

		/* Encomendas Produtos */
		if ($_POST["cmd"] == "verEncProd") {
			verEncProd($_POST["cod_encomenda"]);
		};
		
		/*
		if ($_POST["cmd"] == "editEncProd") {
			editEncProd($data);
		};
		if ($_POST["cmd"] == "eliminarProd") {
			eliminarEncProd($_POST["cod_produto"]);
		};
		*/
		if ($_POST["cmd"] == "addEncProd") {
			addEncProd($data);
		};
		if ($_POST["cmd"] == "verStatus") {
			verStatus($_POST["cod_encomenda"]);
		};
	};

?>
