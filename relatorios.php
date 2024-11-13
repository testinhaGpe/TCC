<?php
// Conexão com o banco de dados

//conexão Casa
$servername = "localhost"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = "psilva09"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

//Conexão Escola 
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

// Consulta para obter registros de acesso com o nome dos visitantes, formatando data e horários
$sql = "SELECT r.id_registro, v.nome AS nome_visitante, 
        DATE_FORMAT(r.data_acesso, '%d/%m/%Y') AS data_acesso, 
        DATE_FORMAT(r.hora_entrada, '%H:%i') AS hora_entrada, 
        DATE_FORMAT(r.hora_saida, '%H:%i') AS hora_saida, 
        r.tipo_acesso
        FROM registrosdeacesso r
        JOIN visitantes v ON r.id_visitante = v.id_visitante
        WHERE DATE(r.data_acesso) = CURDATE()  -- Filtra registros do dia atual
        ORDER BY r.id_registro ASC"; // Ordenar pelo número do registro (id_registro)

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Acesso</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">   
</head>
<body>
    <h1>Relatórios de Entrada e Saida</h1>

    <!-- Tabela para exibir registros de acesso -->
    <table border="1">
        <thead>
            <tr>
                <th>Numero Registro</th>
                <th>Nome do Visitante</th>
                <th>Data de Acesso</th>
                <th>Hora de Entrada</th>
                <th>Hora de Saída</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Exibir os registros na tabela
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id_registro'] . "</td>
                            <td>" . $row['nome_visitante'] . "</td>
                            <td>" . $row['data_acesso'] . "</td>
                            <td>" . $row['hora_entrada'] . "</td>
                            <td>" . $row['hora_saida'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum registro encontrado</td></tr>";
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
