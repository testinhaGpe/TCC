<?php
// Conexão com o banco de dados ----------------- Lembrando que na etec é localhost:3308 e senha etec2024

$servername = "localhost"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = "psilva09"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

//Conexão Escola 
$servername = "localhost:3308"; // Endereço do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = "etec2024"; // Senha do banco de dados
$dbname = "controleacesso_sql"; // Nome do banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} 
?>