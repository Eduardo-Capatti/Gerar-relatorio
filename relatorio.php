<?php
    require_once('funcao_saldo.php');

    date_default_timezone_set('America/Sao_Paulo');

    $horas = date('G:i');

    $data = explode('.', date('m.d.Y'));

    $mes = $data[0];

    $ano = $data[2];

    switch($mes){

        case 1:
            $mes = 'Janeiro';
        break;

        case 2:
            $mes = 'Fevereiro';
        break;

        case 3:
            $mes = 'Março';
        break;

        case 4:
            $mes = 'Abril';
        break;

        case 5:
            $mes = 'Maio';
        break;

        case 6:
            $mes = 'Junho';
        break;

        case 7:
            $mes = 'Julho';
        break;

        case 8:
            $mes = 'Agosto';
        break;

        case 9:
            $mes = 'Setembro';
        break;

        case 10:
            $mes = 'outubro';
        break;

        case 11:
            $mes = 'Novembro';
        break;

        case 12:
            $mes = 'Dezembro';
        break;

    }

    $tr = 0;

?>

<!doctype html>
<html lang='pt-br'>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>

            #receitas{
                float: left;
                width: 50%;
            }

            #despesas{
                float: right;
                width: 50%;
            }

            #receitas table, #despesas table{
                width: 75%;
                margin: 0 auto;
                border-collapse: collapse;
            }

            #receitas table td,  #despesas table td{
                width: 100px;
                text-align: center;
                border-bottom: 1px solid gray;
            }

            #receitas table .descricao, #despesas table .descricao{
                width: 400px;
            }

            #total-receita{
                clear:both;
                float: left;
                width:50%;
            }

            #total-despesa{
                float: right;
                width:50%;
            }

            #total-receita table{
                background-color: #5cb85c;
            }

            #total-despesa table{
                background-color: #d9534f;
            }

            #total-receita table, #total-despesa table{
                margin: 0 auto;
                width: 75%;
            }

            #total-receita table td, #total-despesa table td{
                padding-right: 300px;
            }

            #total-receita table th, #total-despesa table th{
                padding-right: 250px;            
            }

            #receitas, #despesas, #total-receita, #total-despesa{
                margin-top: 50px;
            }

            #saldo{
                clear:both;
                margin: 120px 0 0 120px;
            }

            h1{
                font-size: 36px;
            }

            h2{
                font-size: 32px;
            }

            h3{
                font-size: 28px;
            }

            h1, h2, h3{
                color: ;
            }

            th, td{
                font-size: 24px;
            }

        </style>

    </head>

    <body>

        <div>

            <div style='text-align:center; margin-top: 50px'>
                <h1>Relatório gerado em <?=$mes . ' de ' . $ano ?> às <?=$horas?> </h1>
            </div>   

            <div style='text-align: center'>
                <div id='receitas'>

                    <h3>Receitas</h3>

                    <table>
                        <thead>
                            <tr>
                                <th class='descricao'>Descrição</th>
                                <th>Valor</th>
                                <th>Data</th>
                            </tr>
                        <thead>
                        
                        <tbody>

                            <?php 
                                $arquivo = fopen('arquivo.txt', 'r');

                                while(!feof($arquivo)){
                                    $linha = fgets($arquivo);
                                    $conteudo = explode('#', $linha);

                                    if($linha != ''){
                                        if($conteudo[1] == 'Receita'){
                                            $tr++;
                            ?>

                            <? if($tr % 2 == 1){ ?>

                            
                                <tr style='background-color: #b0b0b0'>

                                    <td class='descricao'><?=$conteudo[4]?></td>
                                    <td>R$<?=number_format(floatval($conteudo[2]), 2, ',', '.')?></td>
                                    <td><?=$conteudo[3]?></td>

                                </tr>

                            <?} else{ ?>

                                <tr style='background-color: white'>

                                    <td class='descricao'><?=$conteudo[4]?></td>
                                    <td>R$<?=number_format(floatval($conteudo[2]), 2, ',', '.')?></td>
                                    <td><?=$conteudo[3]?></td>

                                </tr>
                                
                            <?php }}} else{ 
                                    $tr = 0;
                                }}
                            ?>
                            
                        </tbody>
                    </table>
                </div>

                <div id='despesas'>

                    <h3>Despesas</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Data</th>
                            </tr>
                        <thead>
                        
                        <tbody>
                            <?php 
                                $arquivo = fopen('arquivo.txt', 'r');

                                while(!feof($arquivo)){
                                    $linha = fgets($arquivo);
                                    $conteudo = explode('#', $linha);

                                    if($linha != ''){
                                        if($conteudo[1] == 'Despesa'){
                                        $tr++;
                            ?>

                            <? if($tr % 2 == 1){ ?>

                            
                                <tr style='background-color: #b0b0b0 '>

                                    <td class='descricao'><?=$conteudo[4]?></td>
                                    <td>R$<?=number_format(floatval($conteudo[2]), 2, ',', '.')?></td>
                                    <td><?=$conteudo[3]?></td>

                                </tr>

                            <?} else{ ?>

                                <tr style='background-color: white'>

                                    <td class='descricao'><?=$conteudo[4]?></td>
                                    <td>R$<?=number_format(floatval($conteudo[2]), 2, ',', '.')?></td>
                                    <td><?=$conteudo[3]?></td>

                                </tr>
                                
                            <? }}}} ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <div style='clear:both'>
                <div id='total-receita'> 
                    <table>
                        <tbody>
                            <tr>
                                <th scope='row'>Total:</th>
                                <td>R$+<?=number_format(calculoSaldo('receita'), 2, ',', '.')?></td>
                            </tr>
                        </tbody>
                    </table>                  
                </div>

                <div id='total-despesa'>    
                    <table>
                        <tbody>
                            <tr>
                                <th scope='row'>Total:</th>
                                <td>R$-<?=number_format(calculoSaldo('despesa'), 2, ',', '.')?></td>
                            </tr>
                        </tbody>
                    </table>                
                </div>
            </div>

            <div id='saldo'>
                <? if(calculoSaldo('saldo')>=0){?>
                    <h2>Saldo final = <span style='color:#5cb85c'> R$<?=number_format(calculoSaldo('saldo'), 2, ',', '.')?></span></h2>
                <?}else{?>
                    <h2>Saldo final = <span style='color:#d9534f'> R$<?=number_format(calculoSaldo('saldo'), 2, ',', '.')?></span></h2>
                <?}?>
            </div>

        </div>
    </body>

</html>