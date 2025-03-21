<?php 

    session_start();
    
    date_default_timezone_set('America/Sao_Paulo');

    $data = date('Y-m-d');
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu site para criar relatórios</title>
    <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='CSS/style.css'>

    <style>
        
        <?if(isset($_GET['valor']) && $_GET['valor'] == 'no'){ ?> 
        .input-valor::placeholder{
            color: #a94442;            
        }
        <?}?>

        <?if((isset($_GET['descricao']) && $_GET['descricao'] == 'no') || (isset($_GET['erro2']) && $_GET['erro2'] == 'hash') ){ ?> 
        textarea::placeholder{
            color: #a94442 !important;            
        }
        <?}?>

    </style>


</head>
<body>  

    <div class='container'>

        <div class='row'>
            <div class='col-12'>

                <?if(isset($_GET['erro']) && $_GET['erro'] == 'info'){?>
                    <div class='text-danger text-center'>
                        <p>Termine de preencher todas as informações em vermelho!</p>
                    </div>
                <?}if (isset($_GET['erro2']) && $_GET['erro2'] == 'hash'){?>
                    <div class='text-danger text-center'>
                        <p>Não coloque # na descrição!</p>
                    </div>
                <?}?>

                <form class='' action='processa_envio.php' method='post'>

                    <div class='input-group my-3'>

                        <label class='input-group-text'>Tipo: </label>

                        <div class='form-control <?if(isset($_GET['erro']) && $_GET['erro'] == 'info' && isset($_GET['tipo']) && $_GET['tipo'] == 'no'){ ?> 
                        <?="border border-danger"?> <?}?> ' 
                        <?if(isset($_GET['erro']) && $_GET['erro'] == 'info' && isset($_GET['tipo']) && $_GET['tipo'] == 'no'){ ?> 
                        <?="style = 'background-color: #f2dede; color: #a94442'"?> <?}?> >

                            <div class='form-check form-check-inline'>

                                <input class='form-check-input' type='radio' id='receita' name='tipo' value='Receita'
                                <?if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Receita'){?> <?="checked"?> <?}?>>

                                <label class='form-check-label' for='receita'>Receita</label>
                
                            </div>

                            <div class='form-check form-check-inline'>

                                <input class='form-check-input' type='radio' id='despesa' name='tipo' value='Despesa'
                                <?if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Despesa'){?> <?="checked"?> <?}?>> 

                                <label class='form-check-label' for='despesa'>Despesa</label>

                            </div>
                        </div>

                    </div>

                    <div class='input-group my-3'>
                        <label class='input-group-text' for='valor'>Valor:</label>

                        <input type='number' name='valor' id='valor' min='0.1' step='any' placeholder='preencha o valor' class='form-control input-valor
                        
                        <?if(isset($_GET['valor']) && $_GET['valor'] == 'no'){ ?> 
                        <?="border border-danger"?> <?}?> ' 
                        <?if(isset($_GET['valor']) && $_GET['valor'] == 'no'){ ?> 
                        <?="style = 'background-color: #f2dede; color:rgb(12, 12, 12)'"?> <?}?>
                        <?if(isset($_SESSION['valor'])){?> <?="value = "?> <?=$_SESSION['valor']?> <?}?> >
                    </div>
                  
                    <div class='input-group my-3'>
                        <label class='input-group-text' for='data'>Data:</label>

                        <input type='date' name='data' id='data' max=<?=$data?> class='form-control 
                        <?if(isset($_GET['data']) && $_GET['data'] == 'no'){ ?> 
                        <?="border border-danger"?> <?}?> ' 
                        <?if(isset($_GET['data']) && $_GET['data'] == 'no'){ ?> 
                        <?="style = 'background-color: #f2dede; color: #a94442'"?> <?}?>
                        <?if(isset($_SESSION['data'])){?> <?="value = "?> <?=$_SESSION['data']?> <?}?>>

                    </div>

                    <div class='input-group my-3'>
                        <label class='input-group-text' for='descricao'>Descrição:</label>

                        <textarea maxlength='100' type='text' name='descricao' id='descricao' placeholder="digite a descrição" style='resize: none
                        <?if((isset($_GET['descricao']) && $_GET['descricao'] == 'no') || (isset($_GET['erro2']) && $_GET['erro2'] == 'hash')){ ?> 
                        <?=";background-color: #f2dede"?> <?}?> ' 
                        class='form-control teste
                        <?if((isset($_GET['descricao']) && $_GET['descricao'] == 'no') || (isset($_GET['erro2']) && $_GET['erro2'] == 'hash')){ ?> 
                        <?="border border-danger"?> <?}?> '><?if(isset($_SESSION['descricao'])){?><?=$_SESSION['descricao']?><?}?></textarea>

                    </div>

                    <?session_destroy()?>

                    <button class='btn btn-success' type='submit'>Enviar</button>

                    <a class='btn btn-warning text-white' href='listagem.php'>Analisar</a>

                </form>
            </div>
        </div>

    </div>

</body>
</html>