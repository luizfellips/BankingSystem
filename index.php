

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="source/css/index.css">

    <title>Index</title>
</head>

<body>
    <div class="conteudo">
        <?php include("templates/header.php");?>
        <div class="corpo-menu">
        <?php if (isset($_GET['Sucesso'])) {
                    $sucesso = $_GET['Sucesso'];
                    echo "<p style=color:green> $sucesso </p>";
                }
                ?>
            <h1>Operações</h1>
            <?php
            session_start();
            if(isset($_SESSION["UsuarioID"])){
                include("templates/menuLogado.php");
            }
            else{
                include("templates/menuDeslogado.php");
            }
            session_abort();
            ?>
            
        </div>
        <div class="usuario-atual">
            <h1>Usuario logado:</h1>
            <p id="UsuarioLogado">Nenhum</p>
        </div>

    </div>

</body>


<?php
session_start();
if(isset($_SESSION["UsuarioID"])){
    require_once("modules/dbauth/Conexao.php");
    require_once("modules/dbauth/Constants.php");
    include("modules/classes/Usuario.php");
    include("modules/functions/sql_functions.php");
    
    try {
        $Conexao = Conexao::getConnection();
        $IDSessao = $_SESSION["UsuarioID"];
        $resultado = BuscarPorID($Conexao,$IDSessao);
        $Usuario = $resultado['usuario'];
        echo "<script>document.getElementById('UsuarioLogado').innerText = '$Usuario' </script>";
    
    } catch (Exception $err) {
        print_r($err);
    }
}
session_abort();
?>

</html>