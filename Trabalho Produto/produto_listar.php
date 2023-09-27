<?php

require_once("Connection.php");

$conn = Connection::getConnection();

$sql = "SELECT * FROM produtos";
if ($conn == null){
    echo "Lista vazia!";
    exit;
}
$stm = $conn->prepare($sql); 
$stm->execute();

$result = $stm->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
   body {
            font-family: Tahoma;
            background-color: #1b1b32;
        }
    .container {
            max-width: 400px;
            margin-top: 1.5% !important;
            margin: auto;
            padding: 20px 20px 20px 20px;
            background-color: #f5f6f7;
            border-radius: 2px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
    #cont-up{
            margin-top: 0px;
            padding-top: 15px;
        }
    </style>
    <title>Produtos</title>
</head>
<body>
<div class="container">
<table border="1";>
    <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th colspan="2">Unidade de medida</th>
    </tr>
    <?php foreach ($result as $r): ?>
        <tr>
            <td><?= $r["id"] ?></td>
            <td><?= $r["descricao"] ?></td>
            <td><?= $r["un_medida"] ?></td>
            <td><a href="produto_excluir.php?id=<?= $r["id"] ?>"  onclick="return confirm('Deseja realmente excluir?');">Excluir</a> </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
    echo "<a href='index.php'>Voltar</a>";
?>
</div>
</body>
</html>