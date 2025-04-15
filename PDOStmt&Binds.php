<?php 

$host = 'localhost';
$db = 'usuarios';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);

$nome = 'Jesus';
$id = 3;

$sql = "UPDATE usuarios SET nome = :novonome WHERE id = :id";
$sql = $pdo->prepare($sql);

$sql->bindValue(':novonome', $nome);
$sql->bindValue(':id', $id);
$sql->execute();

echo "Atualizado com sucesso!";
} catch (PDOException $e) {
    echo "Falhou 1". $e->getMessage();

} catch (Exception $e) {
    echo "Falhou". $e->getMessage();
}