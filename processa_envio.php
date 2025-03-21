<?php

    $urlGet = '';

    if($_POST['tipo'] == '' || !isset($_POST['tipo']) ||  $_POST['valor'] == '' || $_POST['data'] == '' || $_POST['descricao'] == '' || str_contains($_POST['descricao'], '#') ){
        session_start();

        if($_POST['tipo'] == '' || !isset($_POST['tipo'])){
            $urlGet .= '&tipo=no';
        }else{
            $_SESSION['tipo'] = $_POST['tipo'];
        }

        if($_POST['valor'] == ''){
            $urlGet .= '&valor=no';
        }else{
            $_SESSION['valor'] = $_POST['valor'];
        }

        if($_POST['data'] == ''){
            $urlGet .= '&data=no';
        }else{
            $_SESSION['data'] = $_POST['data'];
        }

        if($_POST['descricao'] == ''){
            $urlGet .= '&descricao=no';
        }else{
            $_SESSION['descricao'] = $_POST['descricao'];
        }

        if(str_contains($_POST['descricao'], '#')){
            $urlGet .= '&erro2=hash';
        }

        header('Location: index.php?erro=info' . $urlGet);

    }else{
        $contador = 0;

        $tipo = $_POST['tipo'];
        $valor = $_POST['valor'];
        $data = explode('-',$_POST['data']);
        $data = $data[2] . '/' . $data[1] . '/' . $data[0];
        $descricao = $_POST['descricao'];

        $arquivo = fopen('arquivo.txt','r');

        while(!feof($arquivo)){
            fgets($arquivo);
            $contador++;
        }
        fclose($arquivo);

        $id = $contador;

        $arquivo = fopen('arquivo.txt', 'a');

        $texto = $id . '#' . $tipo . '#' . $valor . '#' . $data . '#' . $descricao . PHP_EOL; 

        fwrite($arquivo, $texto);

        fclose($arquivo);

        header('Location: listagem.php');
    }

?>