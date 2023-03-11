<?php
session_start();
if (isset($_SESSION["UsuarioID"])) {
    require_once("../modules/dbauth/Conexao.php");
    require_once("../modules/dbauth/Constants.php");
    include("../modules/functions/sql_functions.php");

    try {
        $Conexao = Conexao::getConnection();
        $IDSessao = $_SESSION["UsuarioID"];
        $resultado = BuscarPorID($Conexao, $IDSessao);
        $nomeUsuario = $resultado['usuario'];
    } catch (Exception $err) {
        print_r($err);
    }
    session_abort();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../source/css/operacoes/operacoes.css">
    <title>Depósito</title>
</head>

<body>
    <div class="conteudo">
        <?php include("../templates/header.php");
        ?>
        <p>
            Saque sendo efetuado para:
        </p>
        <?php echo "<h3>$nomeUsuario</h3>" ?>
        <form action="sacar.php" method="post">
            <p>Número da sua conta</p>
            <input type="text" name="NumeroConta" required>
            <p>Quantia a sacar</p>
            <input type="number" name="Quantia" step="any" required>
            <input type="submit" value="Sacar">
        </form>
    </div>
</body>

<?php
session_start();
if (isset($_SESSION["UsuarioID"]) && isset($_POST["NumeroConta"]) && isset($_POST["Quantia"])) {
    require_once("../modules/dbauth/Conexao.php");
    require_once("../modules/dbauth/Constants.php");
    include("../modules/classes/Usuario.php");
    $IDSessao = $_SESSION["UsuarioID"];
    $NumeroConta = $_POST["NumeroConta"];
    $Quantia = $_POST["Quantia"];
    try {
        $Conexao = Conexao::getConnection();

        $resultado = BuscarPorID($Conexao, $IDSessao);
        $UsuarioAtual = new Usuario($Conexao, informacoesArray: $resultado);
        if ($UsuarioAtual->Sacar($NumeroConta, $Quantia)) {
            echo "Quantia sacada com sucesso!";
        } else {
            echo "Um erro ocorreu.";
        }

    } catch (Exception $err) {
        echo "NÚMERO DE CONTA NÃO ENCONTRADO! <br/>";
        echo "Mais detalhes do erro: <br/>";
        
        throw new Exception('Erro: '. $err->getMessage());
        
    }
}



?>


</html>