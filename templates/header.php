<?php
session_start();
?>

<header class="header-principal">
            <h1>INTERNET BANKING</h1>
            <ul>
                <li><a href="/Documents/BankingSystem/index.php">Início</a></li>
                <?php if(isset($_SESSION["UsuarioID"])){
                    echo '<li><a href="/Documents/BankingSystem/Tabelas/transacoes.php">Transações</a></li>';
                    echo '<li><a href="/Documents/BankingSystem/Tabelas/usuarios.php">Usuários</a></li>';
                    }?>
            </ul>
</header>

<?php
session_abort();
?>