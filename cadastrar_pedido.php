<?php

    if(count($_POST) > 0) {
        // 1. pegar os valores do formulario
        $nome  = $_POST["nome_produto"];
        $qtd   = $_POST["qtd_produto"];
        $obs   = $_POST["obs_produto"];
        $preco = $_POST["preco_produto"];
        // TODO pegar o código do usuário logado (chave estrangeira)

        // 2. conexão com banco de dados
        $servername = "localhost";
        $username   = "root";
        $password   = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=restaurante_bd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Conexão realizada com sucesso.";

        // 3. verficar se email e senha estão no BD
        $sql = "INSERT INTO item_pedido
                (cod_usuario, nome_produto, observacao, preco_und, quantidade)
                VALUES (?,?,?,?,?)";
        $stmt= $conn->prepare($sql);
        // TODO pegar o código do usuário logado
        $stmt->execute([null, $nome, $qtd, $obs, $preco]);

        $resultado["msg"] = "Item inserido";
        $resultado["cod"] = 1;
     }
     catch (PDOException $e) {
         echo "Conexão falhou " . $e->getMessage();
         $resultado["msg"] = "Item não inserido";
         $resultado["cod"] = 0;
        }
        $conn = null;
    }
?>