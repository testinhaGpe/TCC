<?php
session_start();
// coloque arquivo do banco quando necessario

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{ 
    $nomeUsuario = $_POST['nomeUsuario'];
    $senhaUsuario = md5($_POST['senhaUsuario']); // Criptografa a senha usada md5

    if($nomeUsuario=='adm' && $senhaUsuario==md5('123'))
    {
        // Inicia a sessão
        $_SESSION['idUsuario'] = 1; //Subtituir com os dados do banco quando necessario
        $_SESSION['nivelAcesso'] = 'Administrador';
        $_SESSION['usuario'] = $nomeUsuario;
        date_default_timezone_set('America/Sao_Paulo');
        $_SESSION['acesso']=date('d/m/Y H:i:s');

        header('Location: dashboard.php', ); //Redireciona para pagina de dashboard
        exit;
    } else {
        echo "<script>
        alert('Usuario ou senhas incorretos!');
        window.location.href = 'index.php';
        </script>";
        exit();
    }
}
?>