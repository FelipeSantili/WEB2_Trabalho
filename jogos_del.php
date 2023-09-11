<?php

include_once("persistencia.php");

//Verificar se o ID do jogo foi enviado/recebido
$id = "";
if(isset($_GET['id']))
    $id = $_GET['id'];

if(! $id) {
    echo "ID do jogo não informado!";
    echo "<br>";
    echo "<a href='jogos.php'>Voltar</a>";
    exit;
}

//Carregar o array de jogos do arquivo
$jogos = buscarDados();

//Encontar o jogo no array
$index = -1;
for($i=0; $i<count($jogos); $i++) {
    if($id == $jogos[$i]['id']) {
        $index = $i;
        break;
    }
}

//Verificar se o jogo foi encontrado
if($index < 0) {
    echo "ID do jogo não encontrado!";
    echo "<br>";
    echo "<a href='jogos.php'>Voltar</a>";
    exit;
}

//Excluir o jogo
array_splice($jogos, $index, 1);


//Persisitir o array sem o jogo excluido
salvarDados($jogos);

//Redirecionar a página
header("location: jogos.php");
