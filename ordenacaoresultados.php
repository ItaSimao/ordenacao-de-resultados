<?php

$host = 'localhost';
$db = 'usuarios';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

?>
<form method="GET">
    <select name="ordem" onchange="this.form.submit()">
<option></option>
<option value="nome">Nome</option>
<option value="idade">Idade</option>
</select>
</form>

<table border="1" width="400">
    <tr>
    <th>Nome</th>
    <th>Idade</th>
    </tr>
    
    <?php
    $sql = "SELECT * from usuarios";
    $sql = $pdo->query($sql);
    if($sql->rowCount() > 0) {

        foreach($sql->fetchAll() as $usuarios):
            ?>
            <tr>
                <td><?php echo $usuarios['nome']; ?></td>
                <td><?php echo $usuarios['idade']; ?></td>
            </tr>
            <?php
            endforeach;
        } else {
            echo "<tr><td colspan='2'>Nenhum usuário encontrado</td></tr>";
        }
        ?>
</table>