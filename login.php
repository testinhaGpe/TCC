<?php
session_start();

require('conexao.php'); // Conexão com o banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{ 
    $nomeUsuario = $_POST['nomeUsuario'];
    $senhaUsuario = $_POST['senhaUsuario'];

    // Consulta para verificar se o usuário existe e está ativo
    $sql = "SELECT id_usuario, nome, senha, tipo_usuario, status FROM usuarios WHERE nome = ? AND status = 'ativo'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nomeUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se o usuário for encontrado
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica se a senha está correta
        if (password_verify($senhaUsuario, $row['senha'])) {
            // Inicia a sessão com os dados do usuário
            $_SESSION['idUsuario'] = $row['id_usuario'];
            $_SESSION['nivelAcesso'] = $row['tipo_usuario'];
            $_SESSION['usuario'] = $row['nome'];
            date_default_timezone_set('America/Sao_Paulo');
            $_SESSION['acesso'] = date('d/m/Y H:i:s');

            // Redireciona o usuário para o dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            // Senha incorreta
            echo "<script>
            alert('Senha incorreta!');
            window.location.href = 'index.php';
            </script>";
            exit();
        }
    } else {
        // Usuário não encontrado ou não ativo
        echo "<script>
        alert('Usuário não encontrado ou inativo!');
        window.location.href = 'index.php';
        </script>";
        exit();
    }
}

$conn->close();
?>
