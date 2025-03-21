<?php   

    session_start();

    $id = [];

    $arquivo = fopen('arquivo.txt', 'r');


    while(!feof($arquivo)){
        $linha = fgets($arquivo);

        if($linha != ''){
            $conteudo = explode('#', $linha);


            $data = explode('/', $conteudo[3]);

            if($conteudo[1] == $_POST['tipo'] && intval($data[1]) == intval($_POST['mes'])){
                $id[] = $conteudo[0];

            }else if($conteudo[1] == $_POST['tipo'] && $_POST['mes'] == ''){
                $id[] = $conteudo[0];
            }
        }
    }

    $_SESSION['ids'] = $id;

    header('Location: listagem.php');

?>