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
    echo ("Erro na conexão: " . $e->getMessage());
}

if (isset($_GET['ordem']) && empty($_GET['ordem']) == false) {
    $ordem = addslashes($_GET['ordem']);
    $sql = "SELECT * FROM usuarios ORDER BY " . $ordem . " ASC";
} elseif (isset($_GET['ordem']) && empty($_GET['ordem']) == true) {
    $ordem = addslashes($_GET['ordem']);
    $sql = "SELECT * FROM usuarios ORDER BY " . $ordem . " DESC";
} elseif (isset($_GET['ordem']) && $_GET['ordem'] == '') {
    $ordem = '';
    $sql = "SELECT * FROM usuarios";
} else {
    $ordem = '';
    $sql = "SELECT * FROM usuarios";
}

$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($stmt->rowCount() > 0) {
    foreach ($result as $usuarios) {
        echo $usuarios['nome'] . "<br>";
        echo $usuarios['idade'] . "<br>";
        echo $usuarios['email'] . "<br>";
    }
} else {
    echo "Nenhum usuário encontrado";
}

?>
<form method="GET">
    <select name="ordem" onchange="this.form.submit()">
        <option></option>
        <option value="nome" <?php echo($ordem=="nome")?'selected="selected"':"";  ?> >Nome</option>
        <option value="idade"<?php echo($ordem=="idade")?'selected="selected"':""; ?> >Idade </option>
        <option value="email"<?php echo($ordem=="email")?'selected="selected"':""; ?> >Email</option>
        <option value="data_nascimento"<?php echo($ordem=="data_nascimento")?'selected="selected"':""; ?> >Data de Nascimento</option>
    </select>
</form>

<table border="1" width="400">
    <tr>
        <th>Nome</th>
        <th>Idade</th>
    </tr>

    <?php
    $sql = $pdo->query($sql);
    if ($sql->rowCount() > 0) {

        foreach ($sql->fetchAll() as $usuarios):
            ?>
            <tr>
                <td><?php echo $usuarios['nome']; ?></td>
                <td><?php echo $usuarios['idade']; ?></td>
                <td><?php echo $usuarios['email']; ?></td>
                <td><?php echo $usuarios['data_nascimento']; ?></td>
            </tr>
            <?php
        endforeach;
    } else {
        echo "<tr><td colspan='2'>Nenhum usuário encontrado</td></tr>";
    }
    ?>
</table>