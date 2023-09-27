<?php

require_once ("Connection.php");

function limparInput($input){
    $input = trim($input);
    $input = stripslashes($input);
    return htmlspecialchars($input);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["descricao"]) && isset($_GET["un_medida"])) {

        $descricao = limparInput($_GET["descricao"]);
        $un_medidada = limparInput($_GET["un_medida"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        h3{
            margin-top: 0px;
        }
        #cont-up{
            margin-top: 0px;
            padding-top: 15px;
        }
        .formgrupo {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 94%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            background-color: #0a0a23;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
    <title>Produtos</title>
    
</head>
<body>
<div class="container" id="cont-up">
    <h3 id="menu">Inserir</h3>


    <form action="produto_inserir.php" method="GET" id="inserir">

        <div class="formgrupo">
            <label for="descricao">Descricao:</label>
            <input type="text" name="descricao" id="descricao" required>
        </div>
        <div class="formgrupo">
            <label for="un_medida">Unidade de medida:</label>
            <input type="text" name="un_medida" id="un_medida" required>
        </div>

        <button type="submit" class="btn">Inserir produto</button>
        <button type="button" class="btn" onclick="produtosLista();">Listar Produtos</button>

    </form>
</div>
<script>
function produtosLista(){
        window.location.href = "produto_listar.php";
    }
</script>
</body>
</html>