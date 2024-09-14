<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">    
</head>
<body class="body-cadastro">
    <div class="box">
        <form action="processa_cadastro.php" method="POST">
            <fieldset>
                <legend><b>Cadastro de Novo Usuário</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="date" name="data_nascimento" id="data_nascimento" class="inputUser" required>
                    <label for="data_nascimento" class="labelInput">Data de Nascimento</label>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                     <label for="telefone" class="labelInput">Telefone</label>
                </div>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br><br>
                <p>Nível de Acesso:</p>
                <select name="nivel_acesso" id="nivel_acesso" required>
                    <option value="porteiro">Porteiro</option>
                    <option value="administrador">Administrador</option>
                </select>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Cadastrar">
            </fieldset>   
        </form>
    </div>
</body>
</html>
