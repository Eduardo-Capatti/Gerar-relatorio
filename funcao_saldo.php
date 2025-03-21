<?php
    function calculoSaldo($retorno){
            $arquivo = fopen('arquivo.txt', 'r');

            $receita = 0;
            $despesa = 0;

            while(!feof($arquivo)){
            $linha = fgets($arquivo);

            if ($linha != ''){
                    $conteudo = explode('#', $linha);

                    if($conteudo[1] == 'Receita'){
                        $receita += floatval($conteudo[2]);
                    }

                    if($conteudo[1] == 'Despesa'){
                        $despesa += floatval($conteudo[2]);
                    }
            }
                
            }

            fclose($arquivo);

            $saldo = $receita - $despesa;

            if($retorno == 'saldo'){
                return $saldo;
            }else if($retorno == 'receita'){
                return $receita;
            }else if($retorno == 'despesa'){
                return $despesa;
            }
               
    }

    calculoSaldo('saldo');

?>