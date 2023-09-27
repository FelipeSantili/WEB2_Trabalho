<?php

require_once("Connection.php");

$id = 0;
if(isset($_GET['id']))
    $id = $_GET['id'];

if(!$id) {
    echo "ID inválido!<br>";
    echo "<a href='produto_listar.php'>Voltar</a>";
    exit;
}

$conn = Connection::getConnection();

$sql = "DELETE FROM produtos WHERE id = ?";
$stm = $conn->prepare($sql);
$stm->execute([$id]);

header("Location: produto_listar.php");