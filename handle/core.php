<?php

class Core
{

    public function initDB()
    {
        try {
            $GLOBALS['db'] = new PDO("mysql:host=" . DB_HOST .";dbname=" . DB_NAME , DB_USER , DB_PASS);
            $GLOBALS['db']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS['db']->exec("set names utf8");
        }
        catch (Exception $e)
        {
            die(json_encode(array("success" => false , "message" => 'Erro ao tentar ligar à base de dados. Por favor, contacte o suporte: ' . $e->getMessage() )));
        }
    }
    public static function encriptaPassword ( $password )
    {
        return md5($password);
    }

}

?>