<?php
require('check.php');
require('conexao.php'); // Arquivo de conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização do CPF (remoção de caracteres não numéricos)
    $cpf = preg_replace('/\D/', '', $_POST['cpf']); 

    // Verificar se o visitante já está no banco
    $sql = "SELECT * FROM visitantes WHERE documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Visitante encontrado
        $visitante = $result->fetch_assoc();
        $id_visitante = $visitante['id_visitante'];
        echo "<p>Visitante encontrado: <strong>" . $visitante['nome'] . "</strong></p>";

        // Verificar o último registro de acesso
        $sql_last_access = "SELECT tipo_acesso FROM registrosdeacesso 
                            WHERE id_visitante = ? ORDER BY data_acesso DESC, hora_entrada DESC LIMIT 1";
        $stmt_last_access = $conn->prepare($sql_last_access);
        $stmt_last_access->bind_param("i", $id_visitante);
        $stmt_last_access->execute();
        $result_last_access = $stmt_last_access->get_result();

        if ($result_last_access->num_rows > 0) {
            // Último registro encontrado
            $ultimo_registro = $result_last_access->fetch_assoc();
            
            if ($ultimo_registro['tipo_acesso'] == 'entrada') {
                // Visitante já registrou entrada, oferecer opção de registrar saída
                echo "<p>O visitante já está no ambiente. Deseja registrar a saída?</p>";
                echo '<form action="registrar.acesso.php" method="POST">
                        <input type="hidden" name="id_visitante" value="' . $id_visitante . '">
                        <button type="submit" name="acao" value="saida" class="btn">Registrar Saída</button>
                      </form>';
            } else {
                // Último acesso foi uma saída, oferecer opção de registrar entrada
                echo "<p>O visitante não está no ambiente. Deseja registrar a entrada?</p>";
                echo '<form action="registrar.acesso.php" method="POST">
                        <input type="hidden" name="id_visitante" value="' . $id_visitante . '">
                        <button type="submit" name="acao" value="entrada" class="btn">Registrar Entrada</button>
                      </form>';
            }
        } else {
            // Nenhum registro anterior encontrado, oferecer opção de registrar entrada
            echo "<p>Nenhum registro anterior encontrado. Deseja registrar a entrada?</p>";
            echo '<form action="registrar.acesso.php" method="POST">
                    <input type="hidden" name="id_visitante" value="' . $id_visitante . '">
                    <button type="submit" name="acao" value="entrada" class="btn">Registrar Entrada</button>
                  </form>';
        }

        $stmt_last_access->close();
    } else {
        // Visitante não encontrado
        echo "<p>Visitante não encontrado. Por favor, cadastre-o primeiro.</p>";
        echo '<a href="cadastro.visitantes.php"><button class="btn">Cadastrar Novo Visitante</button></a>';
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
</body>
</html>
