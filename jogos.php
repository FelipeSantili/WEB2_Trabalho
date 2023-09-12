<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once("persistencia.php");

$jogos = buscarDados();

$msgErro = "";

$titulo  = "";
$genero  = "";
$preco = "";
$desenvolvedora   = "";
$descricao   = "";

if(isset($_POST['submetido'])) {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $preco = $_POST['preco'];
    $desenvolvedora = $_POST['desenvolvedora'];
    $descricao = $_POST['descricao'];

    $erros = array();
    
    //Valida campos obrigatórios
    if(! trim($titulo))
        array_push($erros, "Informe o título!");

    if(! trim($genero))
        array_push($erros, "Informe o gênero!");

    if(! $preco)
        array_push($erros, "Informe o valor do jogo!");
    
    if(! trim($desenvolvedora))
        array_push($erros, "Informe a desenvolvedora!");

    if(! trim($descricao))
        array_push($erros, "Informe a descrição do jogo!");
        
    if(!$erros) { //Apenas se validou os campos obrigatórios
        //Valida se o preço é maior que 0
        if($preco <= 0)
            array_push($erros, "o valor do jogo deve ser maios que 0");

        //Valida se o título do jogo tem entre 3 e 50 caracateres
        if(strlen($titulo) < 3 || strlen($titulo) > 50)
            array_push($erros, "O título deve ter entre 3 e 50 caracteres!");

        //Encontrar se o título do jogo já foi cadastrado
        $tituloExiste = false;
        foreach($jogos as $j) {
            if($titulo == $j['titulo']) {
                $tituloExiste = true;
                break;
            }
        }
        if($tituloExiste)
            array_push($erros, "O título deste jogo já foi cadastrado!");
    }

    if(!$erros) { //Apenas se passou por todas as validações
        $id = vsprintf( '%s%s-%s-%s-%s-%s%s%s',
                str_split(bin2hex(random_bytes(16)), 4) );

            $novoJogo = array(
                'id' => $id,
                'titulo' => $titulo,
                'genero' => $genero,
                'preco' => $preco,
                'desenvolvedora' => $desenvolvedora,
                'descricao' => $descricao
            );
                
            $jogos[] = $novoJogo; // Adicione o novo jogo ao array $jogos
                

        //Persistir o array jogos no arquivo
        salvarDados($jogos);

        //Redireciona para a mesma página a fim de limpar o formulário
        header("location: jogos.php");
    
    } else 
        //Seta as mensagens do array de erro para a variável $msgErro
        $msgErro = implode("<br>", $erros);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        label{
            display: flex;
            flex-direction: row;
            justify-content: initial;
        }
    </style>
    <title>Cadastro de Jogos</title>
</head>
<body>

    <h1>Cadastro de Jogos</h1>

    <h3>Formulário de Jogos</h3>
    <form action="" method="POST">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" 
            placeholder="Informe o título"
            value="<?= $titulo ?>" />
        
        <br><br>

        <label for="genero">Gênero</label>
        <select name="genero">
            <option value="">---Selecione o gênero---</option>
            <option value="A" <?php if($genero == 'A') echo 'selected'; ?>
                >Ação</option>
            <option value="V" <?php echo ($genero == 'V' ? 'selected' : '') ?>
                >Aventura</option>
            <option value="R" <?php echo ($genero == 'R' ? 'selected' : '') ?>
                >RPG</option>
            <option value="E" <?php echo ($genero == 'E' ? 'selected' : '') ?>
                >Estratégia</option>
            <option value="S" <?php echo ($genero == 'S' ? 'selected' : '') ?>
                >Simulação</option>
        </select>

        <br><br>

        <label for="preco">Preço</label>
        <input type="text" id="preco" name="preco" pattern="^\d+(\,\d{2})?$"
         required placeholder="Informe o preço R$" value="<?= $preco ?>" />

        <br><br>

        <label for="deselvolvedora">Desenvolvedora</label>
        <input type="text" name="desenvolvedora" 
            placeholder="Informe a desenvolvedora"
            value="<?= $desenvolvedora ?>" />

        <br><br>

        <label for="descricao">Descrição</label>
        <textarea id="descricao" name="descricao" rows="4" cols="50" required><?= $descricao ?></textarea>

        <br><br>

        <input type="hidden" name="submetido" value="1" />

        <button type="submit">Gravar</button>
        <button type="reset">Limpar</button>
    </form>

    <div style="color: red;">
        <?= $msgErro ?>
    </div>

    <h3>Listagem de Jogos</h3>
    <table border="1">
        <tr>
            <td>Título</td>
            <td>Gênero</td>
            <td>Preço</td>
            <td>Desenvolvedora</td>
            <td>Descrição</td>
            <td></td>
        </tr>

        <?php foreach($jogos as $j): ?>

            <tr>
                <td><?= $j['titulo'] ?></td>
                <td><?php 
                    switch($j['genero']) {
                        case 'A':
                            echo 'Ação';
                            break;
                        
                        case 'V':
                            echo 'Aventura';
                            break;

                        case 'R':
                            echo 'RPG';
                            break;

                        case 'E':
                            echo 'Estratégia';
                            break;

                        case 'S':
                            echo 'Simulação';
                            break;

                        default:
                            echo $j['genero'];
                    } 
                ?></td>
                <td><?= $j['preco'] ?></td>
                <td><?= $j['desenvolvedora'] ?></td>
                <td><a href="jogos_del.php?id=<?= $j['id'] ?>" 
                        onclick="return confirm('Confirma a exclusão?');">
                        Excluir</a></td>
            </tr>   
        <?php endforeach; ?>

    </table>
    
</body>
</html>
