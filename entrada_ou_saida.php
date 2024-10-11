<?php
require('check.php');
require('conexao.php'); // Arquivo de conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];

    // Verificar se o visitante já está no banco
    $sql = "SELECT * FROM visitantes WHERE documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Visitante encontrado
        $visitante = $result->fetch_assoc();
        echo "Visitante: " . $visitante['nome'] . "<br>";
        echo "Deseja registrar a entrada ou a saída?<br>";

        // Formulário para registrar entrada ou saída
        echo '<form action="registrar_acesso.php" method="POST">
                <input type="hidden" name="id_visitante" value="' . $visitante['id_visitante'] . '">
                <button type="submit" name="acao" value="entrada">Registrar Entrada</button>
                <button type="submit" name="acao" value="saida">Registrar Saída</button>
              </form>';
    } else {
        echo "Visitante não encontrado. Por favor, cadastre-o primeiro.";
        echo '<br><a href="cadastro.visitantes.php"><button>Cadastrar Novo Visitante</button></a>';
    }

    $stmt->close();
    $conn->close();
}
?>
