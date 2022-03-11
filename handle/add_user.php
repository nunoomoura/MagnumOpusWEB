<?php
function addUser($data) {
        if ($data["password"] != $data["conf_password"]) {
            die(json_encode(array("success" => false , "message" => 'As palavras-passe não coincidem. Por favor, tente novamente.')));
        }
        
        $statement = $GLOBALS['db']->prepare("INSERT INTO login(nome_func, username, password) VALUES (:nome_func, :username, :password)");
        $statement->execute(array(
            "nome_func" => $data["new_nome_func"],
            "username" => $data["new_username"],
            "password" => Core::encriptaPassword($data["password"]),
        ));

        die(json_encode(array("success" => true , "message" => 'Dados inseridos com sucesso.' , "url" => UTILIZADORES_URL )));
}
?>