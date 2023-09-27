<?php

include_once("Connection.php");

if(! isset ($_GET['descricao']) ||! isset($_GET['un_medida'])){ // verificação de preenchimento das variáveis
    echo "Informe a descrição e unidade de medida";
    exit;
}

$descricao = $_GET['descricao'];
$un_medida = $_GET['un_medida'];

$conn = Connection::getConnection(); // chama a conexão


$sql = "INSERT INTO produtos (descricao, un_medida) VALUES (?, ?)"; // define a consulta SQL para inserir um novo produto na tabela "produtos"
$stmt = $conn->prepare($sql); // prepara a consulta
$stmt->bindParam(1, $descricao, PDO::PARAM_STR, 50); // bind de tipo da variável
$stmt->bindParam(2, $un_medida, PDO::PARAM_STR, 50);

$result = $stmt->execute(); //consulta o sql pra inserir os dados

if ($result) { // verificação de sucesso da operação
    echo "Produto cadastrado com sucesso! ID: " . $conn->lastInsertId(). ".<br>";
    echo "<a href='index.php'>Voltar</a>";
} else {
    echo "Erro ao cadastrar o produto.";
}