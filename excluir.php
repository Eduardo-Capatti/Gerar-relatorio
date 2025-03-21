<?php

    $linhaAtual = -1;
    $arquivo = fopen('arquivo.txt', 'r');

    while(!feof($arquivo)){
        $linhaAtual++;
        $linha = fgets($arquivo);

        $conteudo = explode('#', $linha);

        if($conteudo[0] == $_POST['id']){
            break;
        }
    }

    $linha = file('arquivo.txt');

    unset($linha[$linhaAtual]);

    file_put_contents('arquivo.txt', implode($linha));

    fclose($arquivo);

    header('Location: listagem.php');


?>