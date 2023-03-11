
<?php 
require_once("../modules/dbauth/Conexao.php");
require_once("../modules/dbauth/Constants.php");

try {
    $Conexao = Conexao::getConnection();
    $query = "select t1.usuario_id,t1.usuario,t1.email,t2.id_conta,t2.saldo
    from usuarios as t1
    inner join contas t2 on t1.usuario_id = t2.usuario_id;";
    $stmt = $Conexao->prepare($query);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../source/css/tabelas/usuarios.css">
    <title>Usuários</title>
</head>
<body>
    <div class="conteudo">
        <?php include("../templates/header.php")?>
        <section>
            <table id="tabela-usuarios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>E-mail</th>
                        <th>ID da conta</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($usuarios as $usuario)
                         {
                    ?>
                    <tr>
                        <td class="item"><?php echo $usuario['usuario_id']?></td>
                        <td class="item"><?php echo $usuario['usuario']?></td>
                        <td class="item"><?php echo $usuario['email']?></td>
                        <td class="item"><?php echo $usuario['id_conta']?></td>
                        <td class="item"><?php echo $usuario['saldo']?></td>
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