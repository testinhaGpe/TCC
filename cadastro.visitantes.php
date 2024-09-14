<?php require('check.php'); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Visitante</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">    
</head>
<body class="body-cadastro">
    <div class="box">
        <form action="">
            <fieldset>
                <legend><b>Cadastro do Visitante</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome"class="inputUser" required>
                    <label for="Nome" class="labelInput">Nome Completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <br><br>
                <p>Genero:</p>
                <input type="radio" id="feminino"name="genero" value="feminino"require>
                <label for="femino">Feminino</label>
                <br><br>
                <input type="radio" id="masculino"name="genero" value="masculino"require>
                <label for="masculino">Masculino</label>
                <br><br>
                <input type="radio" id="outro"name="genero" value="outro"require>
                <label for="outro">Outro</label>
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>   
    </div>
</body>
</html>
