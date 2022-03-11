<?php
function getInfoPerfil($idUser = NULL) {
        /*eu estou a usar isto???  can't remember lol
        UPDATE: não estou, de facto, a usar esta merda
        mas pelo sim pelo não, fica que safoda
        */
        $statement = $GLOBALS['db']->prepare("SELECT * FROM login WHERE id = ? ORDER BY id DESC");
        $statement->execute(array($idUser));
        return $statement->fetch();
}

/*Dados user*/
function verUser($idUser = NULL) {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM login WHERE id = ? ORDER BY id DESC");
        $statement->execute(array($idUser));
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);

        die(json_encode($resultado));
}

/*Listagem de tabelas*/
function lista_inv() {
        if ($_SESSION["info"]) {
                $statement = $GLOBALS['db']->prepare("SELECT * FROM produtos, categorias, sub_categorias WHERE produtos.cod_categoria = categorias.cod_categoria 
                AND produtos.cod_subcategoria = sub_categorias.cod_subcategoria AND produtos.status = 1");
                $statement->execute();
                return $statement->fetchAll();
        }
}

function lista_cat() {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM categorias WHERE status = 1");
        $statement->execute();
        return $statement->fetchAll();
}

function lista_subcat($categoria = NULL) {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM sub_categorias WHERE cod_categoria = ? AND status = 1");
        $statement->execute(array($categoria));
        return $statement->fetchAll();
}

function lista_client() {
        if ($_SESSION["info"]) {
                $statement = $GLOBALS['db']->prepare("SELECT * FROM clientes WHERE status = 1");
                $statement->execute();
                return $statement->fetchAll();
        }
}

function lista_enc() {
        if ($_SESSION["info"]) {
                $statement = $GLOBALS['db']->prepare("SELECT * FROM encomendas, clientes, encomendas_estados 
                WHERE encomendas.cod_cliente = clientes.cod_cliente AND encomendas.cod_estado = encomendas_estados.cod_estado AND encomendas_estados.cod_estado != '7' ");
                $statement->execute();
                return $statement->fetchAll();
        }
}

function lista_enc_prod($idEnc = NULL) {
        if ($_SESSION["info"]) {
                $statement = $GLOBALS['db']->prepare("SELECT * FROM encomendas_produtos EP, encomendas E WHERE EP.cod_encomenda = ? ");
                $statement->execute(array($idEnc));
                return $statement->fetchAll();
        }
}

function lista_funcs() {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM login WHERE tipo_user = ? ");
        $statement->execute(array('user'));
        return $statement->fetchAll();
}

/*Elimina users*/
function eliminarUser ($id) {
        $statement = $GLOBALS['db']->prepare("DELETE FROM login WHERE id = ?");
        $statement->execute(array($id));

        die(json_encode(array("success" => true , "message" => 'Utilizador eliminado com sucesso' , "url" => UTILIZADORES_URL )));

        };

/*Clientes*/        
function verClient($idClient = NULL) {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM clientes WHERE cod_cliente = ? ORDER BY cod_cliente DESC");
        $statement->execute(array($idClient));
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);

        die(json_encode($resultado));
}

function editClient($data) {
        $verifica = $GLOBALS['db']->prepare("SELECT * FROM clientes WHERE cod_cliente = ?");
        $verifica->execute(array($data["editClient_id"]));
        //$dados = $verifica->fetch();       

        $statement = $GLOBALS['db']->prepare("UPDATE clientes SET nome_cliente = :nome_cliente, morada = :morada, cod_postal = :cod_postal, 
                                              localidade = :localidade, cidade = :cidade, num_tel = :num_tel, contribuinte = :contribuinte 
                                              WHERE cod_cliente = :cod_cliente");
        $statement->execute(array(
            "nome_cliente" => $data["nome_cliente"],
            "morada" => $data["morada"],
            "cod_postal" => $data["cod_postal"],
            "localidade" => $data["localidade"],
            "cidade" => $data["cidade"],
            "num_tel" => $data["num_tel"],
            "contribuinte" => $data["contribuinte"],

            "cod_cliente" => $data["editClient_id"]
        ));

        die(json_encode(array("success" => true , "message" => 'Dados alterados com sucesso.' , "url" => CLIENTES_URL )));
}

function checkClient ($idClient = NULL){
        $verifica = $GLOBALS['db']->prepare("SELECT * FROM encomendas WHERE cod_cliente = ?");
        $verifica->execute(array($idClient));
        if ($verifica->rowCount() != 0) {
                $hasOrders = 1;
                return $hasOrders;;
        }
}
function eliminarClient ($idClient) {
        $hasOrders = checkClient($idClient);
        if ($hasOrders != 0) {
                $statement = $GLOBALS['db']->prepare("UPDATE clientes SET status = 0 WHERE cod_cliente = ?");
                $statement->execute(array($idClient));

                die(json_encode(array("success" => true , "message" => 'Cliente inativado com sucesso' , "url" => CLIENTES_URL )));
        }

        $statement = $GLOBALS['db']->prepare("DELETE FROM clientes WHERE cod_cliente = ?");
        $statement->execute(array($idClient));

        die(json_encode(array("success" => true , "message" => 'Cliente eliminado com sucesso' , "url" => CLIENTES_URL )));

        }

function addClient($data) {
        
        $statement = $GLOBALS['db']->prepare("INSERT INTO clientes (nome_cliente, morada, cod_postal, localidade, cidade, num_tel, contribuinte) VALUES (:nome_cliente, :morada, :cod_postal,:localidade, :cidade, :num_tel, :contribuinte)");
        $statement->execute(array(
            "nome_cliente" => $data["nome_cliente"],
            "morada" => $data["morada"],
            "cod_postal" => $data["cod_postal"],
            "localidade" => $data["localidade"],
            "cidade" => $data["cidade"],
            "num_tel" => $data["num_tel"],
            "contribuinte" => $data["contribuinte"],
        ));

        die(json_encode(array("success" => true , "message" => 'Dados inseridos com sucesso.' , "url" => CLIENTES_URL )));
}

/*Categorias*/        
function verCat($idCat = NULL) {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM categorias WHERE cod_categoria = ? ORDER BY cod_categoria DESC");
        $statement->execute(array($idCat));
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);

        die(json_encode($resultado));
}

function editCat($data) {
        $verifica = $GLOBALS['db']->prepare("SELECT * FROM categorias WHERE cod_categoria = ?");
        $verifica->execute(array($data["editCat_id"]));
        //$dados = $verifica->fetch();       

        $statement = $GLOBALS['db']->prepare("UPDATE categorias SET nome_categoria = :nome_categoria WHERE cod_categoria = :cod_categoria");
        $statement->execute(array(
            "nome_categoria" => $data["nome_categoria"],

            "cod_categoria" => $data["editCat_id"]
        ));

        die(json_encode(array("success" => true , "message" => 'Dados alterados com sucesso.' , "url" => CATEGORIAS_URL )));
}

function checkCat ($idCat = NULL){
        $verifica = $GLOBALS['db']->prepare("SELECT * FROM sub_categorias, produtos WHERE sub_categorias.cod_categoria = ? AND produtos.cod_categoria = ?");
        $verifica->execute(array($idCat, $idCat));
        if ($verifica->rowCount() != 0) {
                $hasProds = 1;
                return $hasProds;
        }
}

function eliminarCat ($idCat) {

        $hasProds = checkCat($idCat);
        if ($hasProds != 0) {
                $statement = $GLOBALS['db']->prepare("UPDATE categorias SET status = 0
                                                WHERE cod_categoria = ?");
                $statement->execute(array($idCat));
                
                $statement = $GLOBALS['db']->prepare("UPDATE sub_categorias SET status = 0
                                                WHERE cod_categoria = ?");
                $statement->execute(array($idCat));

                $statement = $GLOBALS['db']->prepare("UPDATE produtos SET status = 0
                                                WHERE cod_categoria = ?");
                $statement->execute(array($idCat));

                die(json_encode(array("success" => true , "message" => 'Cliente inativado com sucesso' , "url" => CATEGORIAS_URL )));
        }
        $statement = $GLOBALS['db']->prepare("DELETE FROM categorias WHERE cod_categoria = ?");
        $statement->execute(array($idCat));

        die(json_encode(array("success" => true , "message" => 'Categoria eliminada com sucesso' , "url" => CATEGORIAS_URL )));

        }

function addCat($data) {
        
        $statement = $GLOBALS['db']->prepare("INSERT INTO categorias (nome_categoria) VALUES (:nome_categoria)");
        $statement->execute(array(
            "nome_categoria" => $data["nome_categoria"],
        ));

        die(json_encode(array("success" => true , "message" => 'Dados inseridos com sucesso.' , "url" => CATEGORIAS_URL )));
}

/*SubCategorias*/        
function verSubCat($idSubCat = NULL) {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM sub_categorias WHERE cod_subcategoria = ? ORDER BY cod_subcategoria DESC");
        $statement->execute(array($idSubCat));
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);

        die(json_encode($resultado));
}

function editSubCat($data) {
        $verifica = $GLOBALS['db']->prepare("SELECT * FROM sub_categorias WHERE cod_subcategoria = ?");
        $verifica->execute(array($data["editSubCat_id"]));
        //$dados = $verifica->fetch();       

        $statement = $GLOBALS['db']->prepare("UPDATE sub_categorias SET nome_subcategoria = :nome_subcategoria, iva = :iva 
                WHERE cod_subcategoria = :cod_subcategoria");
        $statement->execute(array(
            "nome_subcategoria" => $data["nome_subcategoria"],
            "iva" => $data["iva"],

            "cod_subcategoria" => $data["editSubCat_id"]
        ));

        die(json_encode(array("success" => true , "message" => 'Dados alterados com sucesso.' , "url" => CATEGORIAS_URL)));
}
function checkSubCat ($idSubCat = NULL){
        $verifica = $GLOBALS['db']->prepare("SELECT * FROM produtos WHERE cod_subcategoria = ?");
        $verifica->execute(array($idSubCat));
        if ($verifica->rowCount() != 0) {
                $hasProds = 1;
                return $hasProds;;
        }
}


function eliminarSubCat ($idSubCat) {
        $hasProds = checkSubCat($idSubCat);
        if ($hasProds != 0) {
                $statement = $GLOBALS['db']->prepare("UPDATE sub_categorias SET status = 0
                                                WHERE cod_subcategoria = ?");
                $statement->execute(array($idSubCat));

                $statement = $GLOBALS['db']->prepare("UPDATE produtos SET status = 0
                                                WHERE cod_subcategoria = ?");
                $statement->execute(array($idSubCat));

                die(json_encode(array("success" => true , "message" => 'Cliente inativado com sucesso' , "url" => CATEGORIAS_URL )));
        }

        $statement = $GLOBALS['db']->prepare("DELETE FROM sub_categorias WHERE cod_subcategoria = ?");
        $statement->execute(array($idSubCat));

        var_dump($hasProds);

        die(json_encode(array("success" => true , "message" => 'SubCategoria eliminada com sucesso' , "url" => CATEGORIAS_URL)));

        }

function addSubCat($data) {
        $statement = $GLOBALS['db']->prepare("INSERT INTO sub_categorias (cod_categoria, nome_subcategoria, iva) VALUES (:cod_categoria, :nome_subcategoria, :iva)");
        $statement->execute(array(
            "cod_categoria" => $data["catId"],
            "nome_subcategoria" => $data["nome_subcategoria"],
            "iva" => $data["iva"]
    ));

        die(json_encode(array("success" => true , "message" => 'Dados inseridos com sucesso.' , "url" => CATEGORIAS_URL)));
}

/* Produtos */

function checkProds ($idProd = NULL){
        $verifica = $GLOBALS['db']->prepare("SELECT * FROM encomendas_produtos WHERE cod_produto = ?");
        $verifica->execute(array($idProd));
        if ($verifica->rowCount() != 0) {
                $hasOrders = 1;
                return $hasOrders;;
        }
}

function getCat() {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM categorias");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

}


function getSubCat($idSubCat = NULL, $json = true) {      
        if (is_null($idSubCat)) {
                $statement = $GLOBALS['db']->prepare("SELECT * FROM sub_categorias");
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
        }else{
                $statement = $GLOBALS['db']->prepare("SELECT * FROM sub_categorias WHERE cod_categoria = ?");
                $statement->execute(array($idSubCat));

                if ( $json ) {
                        die(json_encode(array("success" => true, "subcategorias" => $statement->fetchAll(PDO::FETCH_ASSOC))));
                } else {
                        return $statement->fetchAll(PDO::FETCH_ASSOC);
                }
        }
}

function verProd($idProd = NULL) {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM produtos WHERE cod_produto = ? ORDER BY cod_produto DESC");
        $statement->execute(array($idProd));
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);

        die(json_encode($resultado));
}

function editProd($data) {
        $verifica = $GLOBALS['db']->prepare("SELECT * FROM produtos, categorias, sub_categorias WHERE cod_produto = ?");
        $verifica->execute(array($data["editProd_id"]));
        //$dados = $verifica->fetch();       

        $statement = $GLOBALS['db']->prepare("UPDATE produtos SET nome_produto = :nome_produto, cod_categoria = :cod_categoria,
                cod_subcategoria = :cod_subcategoria, quant_disp = :quant_disp, preco = :preco WHERE cod_produto = :cod_produto");
        $statement->execute(array(
            "nome_produto" => $data["nome_produto"],
            "cod_categoria" => $data["cod_categoria"],
            "cod_subcategoria" => $data["cod_subcategoria"],
            "quant_disp" => $data["quant_disp"],
            "preco" => $data["preco"],

            "cod_produto" => $data["editProd_id"]
        ));

        die(json_encode(array("success" => true , "message" => 'Dados alterados com sucesso.', "url" => INVENTARIO_URL)));
}

function eliminarProd ($idProd) {

        $hasOrders = checkProds($idProd);
        if ($hasOrders != 0) {
                $statement = $GLOBALS['db']->prepare("UPDATE Produtos SET status = 0 WHERE cod_produto = ?");
                $statement->execute(array($idProd));

                die(json_encode(array("success" => true , "message" => 'Cliente inativado com sucesso' , "url" => INVENTARIO_URL )));
        }

        $statement = $GLOBALS['db']->prepare("DELETE FROM produtos WHERE cod_produto = ?");
        $statement->execute(array($idProd));

        die(json_encode(array("success" => true , "message" => 'Produto eliminado com sucesso' , "url" => INVENTARIO_URL)));

}

function addProd ($data){

        $statement = $GLOBALS['db']->prepare("INSERT INTO produtos (nome_produto, cod_categoria, cod_subcategoria, quant_disp, preco) 
                                                VALUES (:nome_produto, :cod_categoria, :cod_subcategoria, :quant_disp, :preco)");
        $statement->execute(array(
            "nome_produto" => $data["nome_produto"],
            "cod_categoria" => $data["cod_categoria"],
            "cod_subcategoria" => $data["cod_subcategoria"],
            "quant_disp" => $data["quant_disp"],
            "preco" => $data["preco"]
        ));
        die(json_encode(array("success" => true , "message" => 'Dados inseridos com sucesso.' , "url" => INVENTARIO_URL )));
}

/* Encomendas Produtos */

function verEncProd ($idEncProd = NULL) {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM encomendas_produtos EP, produtos P WHERE EP.cod_produto = P.cod_produto AND EP.cod_encomenda = ?");
        $statement->execute(array($idEncProd));
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
        /*echo "<pre>";
        print_r($resultado);
        echo "</pre>";*/

        die(json_encode($resultado)); 
}

/*
function editEncProd() {

}

function eliminarEncProd () {

}
*/
function addEncProd () {

}
function getEstados() {
        $statement = $GLOBALS['db']->prepare("SELECT * FROM encomendas_estados");
        $statement->execute();
        
        die(json_encode(array("success" => true, "estados" => $statement->fetchAll(PDO::FETCH_ASSOC))));

}
function verStatus ($idEnc = NULL){
        $statement = $GLOBALS['db']->prepare("SELECT * FROM encomendas, encomendas_estados WHERE cod_encomenda = ? AND encomendas.cod_estado =
                                         encomendas_estados.cod_estado");
        $statement->execute(array($idEnc));
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);

        die(json_encode($resultado));
}

function editStatus($data) {
        $verifica = $GLOBALS['db']->prepare("SELECT * FROM encomendas WHERE cod_encomenda = ?");
        $verifica->execute(array($data["verEnc_id"]));
        //$dados = $verifica->fetch();       

        $statement = $GLOBALS['db']->prepare("UPDATE encomendas SET cod_estado = :cod_estado WHERE cod_encomenda = :cod_encomenda");
        $statement->execute(array(
            "cod_estado" => $data["cod_estado"],

            "cod_encomenda" => $data["verEnc_id"]
        ));

        die(json_encode(array("success" => true , "message" => 'Dados alterados com sucesso.', "url" => ENCOMENDAS_URL)));
}

?>