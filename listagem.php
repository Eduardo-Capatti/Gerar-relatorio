<?php

    session_start();

    require_once('funcao_saldo.php');

?>
<!doctype html>
<html lang='pt-br'>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seu site para criar relatórios</title>
        <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='CSS/style.css'>
    </head>

    <body>

        <div class='container'>

            <div class='row mt-5'>
                <div class='col-12'>
                    <form class='row' method='POST' action='filtrar.php'>

                        <div class='my-3 col-12 col-md-4'>
                            <div class='input-group'>
                                <label class='input-group-text' for='tipo'>Tipo: </label>
                                <select class='form-select' id='tipo' name='tipo'>
                                    <option value='Receita'>Receita</option>
                                    <option value='Despesa'>Despesa</option>
                                </select>
                            </div>
                        </div>

                        <div class='my-3 col-7 col-md-5'>
                            <div class='input-group'>
                                <label class='input-group-text' for='mes'>Mês: </label>
                                <input class='form-control' type='number' id='mes' name='mes' placeholder='mês em número' min='1' max='12'>
                            </div>
                        </div>

                        <div class='my-3 col-5 col-md-3 p-0'>
                            <button class='btn btn-success' type='submit'>Filtrar</button>
                            <a class='btn btn-success' href='listagem.php'>Tirar filtro</a>
                        </div>

                    </form>
                </div>
            </div>

            <div class='row'>
                <div class='col-12'>
                    
                    <div>
                        <p>Saldo:
                            <? if(calculoSaldo('saldo') >= 0){?>

                            <span class='text-success'>R$<?=number_format(calculoSaldo('saldo'), 2, ',', '.')?></span>

                            <?} else{ ?>

                            <span class='text-danger'>R$<?=number_format(calculoSaldo('saldo'), 2, ',', '.')?></span>

                            <?} ?>
                        </p>

                        <a class='btn btn-warning text-white' href='index.php'>Voltar</a>

                        <a class='btn btn-warning text-white' href='gerar_relatorio.php'>Relatório</a>
                    </div>

                    <table class='table table-striped table-hover'>

                        <thead>
                            <tr>
                                <th class='tipo'>Tipo</th>
                                <th class='valor'>Valor</th>
                                <th class='data'>Data</th>
                                <th class='descricao'>Descricão</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                                $arquivo = fopen('arquivo.txt', 'r');
                            
                                while(!feof($arquivo)){
                                $linha = fgets($arquivo);

                                if($linha != ''){
                                $conteudo = explode('#', $linha);

                                if(isset($_SESSION['ids'])){
                                        foreach($_SESSION['ids'] as $i => $valor){
                                            if($valor == $conteudo[0]){
                            ?>
                                            <tr> 
                                                <td> <?=$conteudo[1]?> </td>
                                                <td>   
                                                    <?php 
                                                        if($conteudo[1] == 'Receita'){
                                                    
                                                    ?>
                                                    <span class='text-success'>R$<?=number_format(floatval($conteudo[2]), 2, ',', '.')?></span>
                                                    <?} else{?>
                                                    <span class='text-danger'>R$<?=number_format(floatval($conteudo[2]), 2, ',', '.')?></span>
                                                    <?}      ?>
                                                </td>
                                                <td> <?=$conteudo[3]?> </td>
                                                <td> <?=$conteudo[4]?> </td>
                                                <th colspan='row'>
                                                    <form method='POST' action='excluir.php'>
                                                        <input type='hidden' name='id' value=<?=$conteudo[0]?>>
                                                        <button class='btn btn-danger' type='submit'>
                                                            <svg class="trash-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width='30px'>
                                                                <path d="M9 3V4H4V6H5V19C5 20.1 5.9 21 7 21H17C18.1 21 19 20.1 19 19V6H20V4H15V3H9ZM7 6H17V19H7V6ZM9 8V17H11V8H9ZM13 8V17H15V8H13Z"/>
                                                            </svg>    
                                                        </button>
                                                    </form>    
                                                </th>
                                            </tr>

                            <? }}} else{ ?>

                            <tr> 
                    
                                <td> <?=$conteudo[1]?> </td>

                                <td>   
                                    <?php 
                                        if($conteudo[1] == 'Receita'){
                                    
                                    ?>
                                    <span class='text-success'>R$<?=number_format(floatval($conteudo[2]), 2, ',', '.')?></span>
                                    <?} else{?>
                                    <span class='text-danger'>R$<?=number_format(floatval($conteudo[2]), 2, ',', '.')?></span>
                                    <?}      ?>
                                </td>

                                <td> <?=$conteudo[3]?> </td>
                                <td> <?=$conteudo[4]?> </td>

                                <th colspan='row'>

                                <form method='POST' action='excluir.php'>
                                    <input type='hidden' name='id' value=<?=$conteudo[0]?>>
                                    <button class='btn btn-danger' type='submit'>
                                        <svg class="trash-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width='30px'>
                                            <path d="M9 3V4H4V6H5V19C5 20.1 5.9 21 7 21H17C18.1 21 19 20.1 19 19V6H20V4H15V3H9ZM7 6H17V19H7V6ZM9 8V17H11V8H9ZM13 8V17H15V8H13Z"/>
                                        </svg>    
                                    </button>
                                </form>
                                
                                </th>
                            </tr>

                            <?php } } }

                                fclose($arquivo);

                                session_destroy();

                            ?>

                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </body>

</html>