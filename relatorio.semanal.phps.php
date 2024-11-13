<?php
// Conexão com o banco de dados

// Conexão Casa
$servername = "localhost"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = "psilva09"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

// Conexão Escola 
//$servername = "localhost:3308"; // Endereço do servidor
//$username = "root"; // Nome de usuário do banco de dados
//$password = "etec2024"; // Senha do banco de dados
//$dbname = "controleacesso_sql"; // Nome do banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta para obter registros de acesso da última semana com o nome dos visitantes, data e tempo de duração
$sql = "SELECT v.nome AS nome_visitante, 
        DATE_FORMAT(r.data_acesso, '%d/%m/%Y') AS data_acesso, 
        TIMEDIFF(r.hora_saida, r.hora_entrada) AS duracao
        FROM registrosdeacesso r
        JOIN visitantes v ON r.id_visitante = v.id_visitante
        WHERE r.data_acesso >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
        ORDER BY r.data_acesso DESC, r.hora_entrada ASC"; 

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Semanal de Acesso</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">   
</head>
<body>
    <h1>Relatório Semanal de Acesso</h1>

    <!-- Tabela para exibir registros de acesso da última semana com nome, data e duração -->
    <table border="1">
        <thead>
            <tr>
                <th>Nome do Visitante</th>
                <th>Data de Acesso</th>
                <th>Tempo de Duração</th>
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
                            <td>" . $row['duracao'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum registro encontrado para a última semana</td></tr>";
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
