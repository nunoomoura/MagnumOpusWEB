<?php
function editUser($data) {
        // Se os campos estiverem vazios
        if ($data["new_password"] == "" && $data["con_password"] == "") {
            $verifica = $GLOBALS['db']->prepare("SELECT * FROM login WHERE id = ?");
            $verifica->execute(array($data["editUser_id"]));

            $statement = $GLOBALS['db']->prepare("UPDATE login SET nome_func = :nome_func, username = :username WHERE id = :id");
            $statement->execute(array(
            "nome_func" => $data["nome_func"],
            "username" => $data["username"],
            "id" => $data["editUser_id"]));

            die(json_encode(array("success" => true , "message" => 'Dados alterados com sucesso.', "url" => UTILIZADORES_URL)));
            
        }

        if ($data["new_password"] != $data["con_password"]) {
            die(json_encode(array("success" => false , "message" => 'As palavras-passe não coincidem. Por favor, tente novamente.')));
        }

        $verifica = $GLOBALS['db']->prepare("SELECT * FROM login WHERE id = ?");
        $verifica->execute(array($data["editUser_id"]));
        //$dados = $verifica->fetch();       

        $statement = $GLOBALS['db']->prepare("UPDATE login SET nome_func = :nome_func, username = :username, password = :password WHERE id = :id");
        $statement->execute(array(
            "nome_func" => $data["nome_func"],
            "username" => $data["username"],
            "password" => Core::encriptaPassword($data["new_password"]),
            "id" => $data["editUser_id"]
        ));

        die(json_encode(array("success" => true , "message" => 'Dados alterados com sucesso.' , "url" => UTILIZADORES_URL )));
}
?>