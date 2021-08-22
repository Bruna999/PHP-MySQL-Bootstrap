<?php

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $servername = "localhost";
    $username = "root";
    $password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=restaurante_bd", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexão sucedida";
    $stmt = $conn->prepare("SELECT codigo FROM Usuario WHERE email=:email AND senha=md5(:senha)");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll();
    $qtd_usuario = count($result);
    if($qtd_usuario == 1) {
        echo "Usuario encontrado!";
    } else if($qtd_usuario == 0) {
        echo "Usuario NÃO encontrado..";
    }
}
catch (PDOException $e) {
    echo "Conexão fracassada: " . $e->getMessage();
}
    $conn = null;

    include("index.html");
?>