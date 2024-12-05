<?php
// Conexão com o banco de dados
require('conexao.php'); // Conexão com o banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta para obter o total de tempo de acesso por visitante, separado por semana
$sql = "SELECT v.nome AS nome_visitante, 
        WEEK(r.data_acesso, 1) AS semana,  -- O '1' indica que a semana começa na segunda-feira
        YEAR(r.data_acesso) AS ano,
        SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, r.hora_entrada, r.hora_saida))) AS total_duracao
        FROM registrosdeacesso r
        JOIN visitantes v ON r.id_visitante = v.id_visitante
        WHERE r.data_acesso >= DATE_SUB(CURDATE(), INTERVAL 8 WEEK) 
        GROUP BY v.nome, WEEK(r.data_acesso, 1), YEAR(r.data_acesso)
        ORDER BY ano DESC, semana DESC, v.nome";

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

    <!-- Tabela para exibir registros de acesso com a soma total de duração por visitante, separada por semana -->
    <table border="1">
        <thead>
            <tr>
                <th>Nome do Visitante</th>
                <th>Período da Semana</th>
                <th>Tempo Total de Acesso</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Exibir os registros na tabela
                while ($row = $result->fetch_assoc()) {
                    // Calcular o início e o fim da semana
                    $ano = $row['ano'];
                    $semana = $row['semana'];
                    $data_inicio = date("d/m/Y", strtotime($ano . "W" . str_pad($semana, 2, "0", STR_PAD_LEFT)));
                    $data_fim = date("d/m/Y", strtotime($ano . "W" . str_pad($semana, 2, "0", STR_PAD_LEFT) . "7"));
                    
                    echo "<tr>
                            <td>" . $row['nome_visitante'] . "</td>
                            <td>" . $data_inicio . " a " . $data_fim . "</td>
                            <td>" . $row['total_duracao'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum registro encontrado para as últimas semanas</td></tr>";
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
