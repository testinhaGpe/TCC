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
        echo "<div class='alert alert-success'>Visitante encontrado: <strong>" . $visitante['nome'] . "</strong></div>";

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
                echo "<div class='alert alert-info'>O visitante já está no ambiente. Deseja registrar a saída?</div>";
                echo '<form action="registrar.acesso.php" method="POST" class="mb-3">
                        <input type="hidden" name="id_visitante" value="' . $id_visitante . '">
                        <button type="submit" name="acao" value="saida" class="btn btn-primary">Registrar Saída</button>
                      </form>';
            } else {
                // Último acesso foi uma saída, oferecer opção de registrar entrada
                echo "<div class='alert alert-info'>O visitante não está no ambiente. Deseja registrar a entrada?</div>";
                echo '<form action="registrar.acesso.php" method="POST" class="mb-3">
                        <input type="hidden" name="id_visitante" value="' . $id_visitante . '">
                        <button type="submit" name="acao" value="entrada" class="btn btn-success">Registrar Entrada</button>
                      </form>';
            }
        } else {
            // Nenhum registro anterior encontrado, oferecer opção de registrar entrada
            echo "<div class='alert alert-warning'>Nenhum registro anterior encontrado. Deseja registrar a entrada?</div>";
            echo '<form action="registrar.acesso.php" method="POST" class="mb-3">
                    <input type="hidden" name="id_visitante" value="' . $id_visitante . '">
                    <button type="submit" name="acao" value="entrada" class="btn btn-success">Registrar Entrada</button>
                  </form>';
        }

        $stmt_last_access->close();
    } else {
        // Visitante não encontrado
        echo "<div class='alert alert-danger'>Visitante não encontrado. Por favor, cadastre-o primeiro.</div>";
        echo '<a href="cadastro.visitantes.php" class="btn btn-warning">Cadastrar Novo Visitante</a>';
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
    <title>Controle de Acesso</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <!-- Bootstrap JS and dependencies (jQuery and Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
