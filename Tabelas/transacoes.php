<?php
session_start();
if(!isset($_SESSION['UsuarioID'])){
    header("Location: /Documents/BankingSystem/index.php");
}
session_abort();
?>

<?php 
require_once("../modules/dbauth/Conexao.php");
require_once("../modules/dbauth/Constants.php");

try {
    $Conexao = Conexao::getConnection();
    $query = "select * from transacoes";
    $stmt = $Conexao->prepare($query);
    $stmt->execute();
    $transacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    //throw $th;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../source/css/tabelas/transacoes.css">
    <title>Transações</title>
</head>
<body>
    <div class="conteudo">
        <?php include("../templates/header.php")?>
        <section>
            <table id="tabela-transacao">
                <thead>
                    <tr>
                        <th>ID da transação</th>
                        <th>ID da conta</th>
                        <th>Tipo da transação</th>
                        <th>Quantia</th>
                        <th>Data e hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($transacoes as $transacao)
                         {
                    ?>
                    <tr>
                        <td class="item"><?php echo $transacao['id_transacao']?></td>
                        <td class="item"><?php echo $transacao['id_conta']?></td>
                        <td class="item"><?php echo $transacao['tipo_transacao']?></td>
                        <td class="item"><?php echo $transacao['quantia']?></td>
                        <td class="item"><?php echo $transacao['registro_data_hora']?></td>
                    </tr>
                    <?php
                     }
                        ?>

                </tbody>
            </table>
        </section>
    </div>
</body>
</html>