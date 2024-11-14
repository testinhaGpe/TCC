<?php
// Configurações de conexão com o banco de dados

require('conexao.php'); // Conexão com o banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta para obter uma única entrada por visitante por dia
$sql = "SELECT v.nome AS nome_visitante, 
        DATE_FORMAT(r.data_acesso, '%d/%m/%Y') AS data_acesso, 
        MIN(DATE_FORMAT(r.hora_entrada, '%H:%i')) AS hora_entrada, 
        MAX(DATE_FORMAT(r.hora_saida, '%H:%i')) AS hora_saida, 
        TIMEDIFF(MAX(r.hora_saida), MIN(r.hora_entrada)) AS tempo_permanencia
        FROM registrosdeacesso r
        JOIN visitantes v ON r.id_visitante = v.id_visitante
        GROUP BY v.nome, r.data_acesso
        ORDER BY r.data_acesso DESC, v.nome ASC"; // Ordenar por data de acesso e nome do visitante

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Tempo de Permanência</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <h1>Relatório de Tempo de Permanência de Visitantes</h1>

    <!-- Tabela para exibir registros de acesso com tempo de permanência -->
    <table border="1">
        <thead>
            <tr>
                <th>Nome do Visitante</th>
                <th>Data de Acesso</th>
                <th>Hora de Entrada</th>
                <th>Hora de Saída</th>
                <th>Tempo de Permanência</th>
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
                            <td>" . $row['hora_saida'] . "</td>
                            <td>" . (!empty($row['tempo_permanencia']) ? $row['tempo_permanencia'] : 'Ainda no local') . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum registro encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br><br>
    <!-- Botão para voltar ao dashboard administrativo -->
    <button onclick="window.location.href='dashboard.php'">Voltar</button>

    <?php
    // Fechar a conexão
    $conn->close();
    ?>
</body>
</html>
