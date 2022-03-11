<?php 

	function doLogin ($data) {

		if (empty($data["username"]) || empty($data["password"])) {

            die(json_encode(array("success" => false , "message" => 'Por favor, preencha os dados')));

        };

        $verifica = $GLOBALS['db']->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
        $verifica->execute(array($data["username"], Core::encriptaPassword($data["password"]) ));
        $dados = $verifica->fetch();        

        if (empty($dados)) {
            die(json_encode(array("success" => false , "message" => 'Nome de utilizador/Email ou palavra-passe estão errados.')));
        };     
        
        $_SESSION["info"] = $dados;

        die(json_encode(array("success" => true , "message" => 'Bem-vindo à Magnum Opus.', "url" => MAINFORM_URL )));
        
	};

?>