<?php
function editProfile($data) {
        // Se os campos estiverem vazios
        if ($data["new_password"] == "" && $data["con_password"] == "") {
            $verifica = $GLOBALS['db']->prepare("SELECT * FROM login WHERE id = ? AND password = ?");
        	$verifica->execute(array($_SESSION["info"]["id"], Core::encriptaPassword($data["password"])));

        	$statement = $GLOBALS['db']->prepare("UPDATE login SET nome_func = :nome_func, username = :username WHERE id = :id");
			$statement->execute(array(
			"nome_func" => $data["nome_func"],
			"username" => $data["username"],
			"id" => $_SESSION["info"]["id"]));
			
			if ($verifica->rowCount() == 0) {
            die(json_encode(array("success" => false , "message" => 'A palavra-passe atual está errada. Por favor, tente novamente.')));
        	}

        	die(json_encode(array("success" => true , "message" => 'Dados alterados com sucesso.', "url" => ROOT_URL)));
        	
        }

        if ($data["new_password"] != $data["con_password"]) {
            die(json_encode(array("success" => false , "message" => 'As palavras-passe não coincidem. Por favor, tente novamente.')));
        }

        $verifica = $GLOBALS['db']->prepare("SELECT * FROM login WHERE id = ? AND password = ?");
        $verifica->execute(array($_SESSION["info"]["id"], Core::encriptaPassword($data["password"])));
        //$dados = $verifica->fetch();

        if ($verifica->rowCount() == 0) {
            die(json_encode(array("success" => false , "message" => 'A palavra-passe atual está errada. Por favor, tente novamente.')));
        }

        if ($data["password"] == $data["new_password"]) {
            die(json_encode(array("success" => false , "message" => 'A palavra-passe não pode ser igual à palavra-passe atual. Por favor, tente novamente.')));
        }        

        $statement = $GLOBALS['db']->prepare("UPDATE login SET nome_func = :nome_func, username = :username, password = :password WHERE id = :id");
		$statement->execute(array(
			"nome_func" => $data["nome_func"],
			"username" => $data["username"],
			"password" => Core::encriptaPassword($data["new_password"]),
			"id" => $_SESSION["info"]["id"]
        ));

        session_destroy();
        session_unset();

        die(json_encode(array("success" => true , "message" => 'Dados alterados com sucesso.' , "url" => ROOT_URL )));
}
?>