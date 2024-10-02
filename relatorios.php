<?php
// Conexão com o banco de dados
$servername = "localhost:3308"; // Ou o IP do servidor do banco de dados
$username = "root"; // Usuário do banco de dados
$password = "etec2024"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta para obter registros de acesso com o nome dos visitantes
$sql = "SELECT r.id_registro, v.nome AS nome_visitante, r.data_acesso, r.hora_entrada, r.hora_saida, r.tipo_acesso
        FROM registrosdeacesso r
        JOIN visitantes v ON r.id_visitante = v.id_visitante";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Acesso</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Relatórios de Acesso</h1>

    <!-- Tabela para exibir registros de acesso -->
    <table border="1">
        <thead>
            <tr>
                <th>ID Registro</th>
                <th>Nome do Visitante</th>
                <th>Data de Acesso</th>
                <th>Hora de Entrada</th>
                <th>Hora de Saída</th>
                <th>Tipo de Acesso</th>
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
                            <td>" . $row['tipo_acesso'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum registro encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br><br>
    <!-- Botão para voltar ao Dashboard -->
    <a href="dashboard.php"><button>Voltar</button></a>

    <?php
    // Fechar a conexão
    $conn->close();
    ?>
</body>
</html>
