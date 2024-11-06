<?php
// Conexão com o banco de dados

// Conexão Casa
$servername = "localhost"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = "psilva09"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

// Conexão Escola 
$servername = "localhost:3308"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = "etec2024"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta para obter visitantes ativos (visitantes sem hora de saída registrada)
$sql = "SELECT v.nome AS nome_visitante, 
        DATE_FORMAT(r.data_acesso, '%d/%m/%Y') AS data_acesso, 
        r.hora_entrada
        FROM registrosdeacesso r
        JOIN visitantes v ON r.id_visitante = v.id_visitante
        WHERE r.hora_saida IS NULL
        ORDER BY r.data_acesso DESC, r.hora_entrada ASC"; 

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Visitantes Ativos</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">   
</head>
<body>
    <h1>Relatório de Visitantes Ativos</h1>

    <!-- Tabela para exibir visitantes ativos com nome, data e hora de entrada -->
    <table border="1">
        <thead>
            <tr>
                <th>Nome do Visitante</th>
                <th>Data de Acesso</th>
                <th>Hora de Entrada</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Exibir os registros na tabela
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['nome_visitante'] . "</td>
                            <td>" . $row['data_acesso'] . "</td>
                            <td>" . $row['hora_entrada'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum visitante ativo encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br><br>
    <!-- Botão para voltar à página anterior -->
    <button onclick="window.history.back()">Voltar</button>

    <?php
    // Fechar a conexão
    $conn->close();
    ?>
</body>
</html>
