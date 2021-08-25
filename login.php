<?php
    if(count($_POST) > 0) {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $servername = "localhost";
    $username = "root";
    $password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=restaurante_bd", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão realizada com sucesso.";

    // 3. verficar se email e senha estão no BD
    $consulta = $conn->prepare("SELECT codigo FROM Usuario WHERE email=:email AND senha=md5(:senha)");
    $consulta->bindParam(':email', $email, PDO::PARAM_STR);
    $consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
    $consulta->execute();

    $result = $consulta->fetchAll();
    $qtd_usuarios = count($result);
    if($qtd_usuarios == 1) {

        // TODO substituir pelo redirecionamento...
        $resultado["msg"] = "Email e senha cadastrado com sucesso!";
        $resultado["cod"] = 0;
    } else if($qtd_usuarios == 0) {
        $resultado["msg"] = "Email e senha NÃO cadastrado...";
        $resultado["cod"] = 0;
    }
 }
 catch (PDOException $e) {
     echo "Conexão falhou " . $e->getMessage();
    }
        $conn = null;
}
    include("index.php");
?>