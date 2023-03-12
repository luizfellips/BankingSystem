

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../source/css/app/logar.css">
    <title>Document</title>
</head>

<body>
    <div class="conteudo">
        <?php include('../templates/header.php') ?>
        <h1>Entrar</h1>
        <form action="logar.php" method="post" class="formulario">
            <?php if (isset($_GET['Erro'])) {
                $erro = $_GET['Erro'];
                echo "<p style=color:red> $erro </p>";
            }
            ?>
            <p>Seu usuário ou e-mail</p>
            <input type="text" name="Usuario" required>
            <p>Sua senha</p>
            <input type="password" name="Senha" required>
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>

<?php
if (isset($_POST["Usuario"]) && isset($_POST["Senha"])) {
    require_once("../modules/dbauth/Conexao.php");
    require_once("../modules/dbauth/Constants.php");
    include("../modules/classes/Login.php");
    try {
        $Conexao = Conexao::getConnection();
        $usuario = $_POST["Usuario"];
        $senha = $_POST["Senha"];
        $usuario_credenciais = new Login($Conexao, $usuario, $senha);
        if ($usuario_credenciais->Autenticar()) {
            $usuario_id = $usuario_credenciais->BuscarIdUsuario();
            session_start();
            $_SESSION["UsuarioID"] = $usuario_id;
            header("Location: ../index.php");
            exit;
            
        } else {
            echo "Um erro ocorreu na autenticação!";
        }



    } catch (Exception $ex) {
        print_r($ex);
    }
}
?>

</html>