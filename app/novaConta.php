<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../source/css/app/novaConta.css">
    <title>Criar nova conta</title>
</head>

<body>
    <div class="conteudo">
        <?php include("../templates/header.php"); ?>
        <div class="formulario">

            <h1>Crie sua conta</h1>
            <form action="novaConta.php" method="POST">
                <?php if (isset($_GET['Erro'])) {
                    $erro = $_GET['Erro'];
                    echo "<p style=color:red> $erro </p>";
                }
                ?>
                <p>Seu usuário</p>
                <input type="text" name="Usuario" minlength="10" required>
                <p>Seu e-mail</p>
                <input type="text" name="Email" required>
                <p>Sua senha</p>
                <input type="password" name="Senha" required>
                <p>Confirme sua senha</p>
                <input type="password" name="ConfirmarSenha" required>
                <input type="submit" value="Cadastrar">
            </form>
        </div>

    </div>
</body>
<?php
if (isset($_POST['Usuario']) && isset($_POST['Email']) && isset($_POST['Senha']) && isset($_POST['ConfirmarSenha'])) {
    if ($_POST['Senha'] != $_POST['ConfirmarSenha']) {
        $mensagem_erro = urlencode("As senhas não conferem, tente novamente");
        header("Location: novaConta.php?Erro=" . $mensagem_erro);

    } else {
        require_once("../modules/dbauth/Conexao.php");
        require_once("../modules/dbauth/Constants.php");
        include("../modules/classes/Usuario.php");
        try {
            $Conexao = Conexao::getConnection();
            $usuario = $_POST['Usuario'];
            $senha = $_POST['Senha'];
            $email = $_POST['Email'];
            $obj_usuario = new Usuario($Conexao, usuario:$usuario, senha:$senha, email:$email);
            if ($obj_usuario->RegistrarConta()) {
                $mensagem_sucesso = urlencode("Conta criada com sucesso");
                header("Location: ../index.php?Sucesso=" . $mensagem_sucesso);
            }
            else{
                $mensagem_erro = urlencode("Um erro ocorreu");
                header("Location: novaConta.php?Erro=" . $mensagem_erro);
            }
        } catch (Exception $err) {
            print_r($err);
        }
    }
}

?>

</html>