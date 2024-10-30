<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #eef2f5;
            color: #333;
            font-family: Arial, sans-serif;
        }
        /* Navbar */
        .navbar {
            background-color: #1a1f71;
            border-bottom: 4px solid #1f5eff;
        }
        .navbar-brand {
            color: white;
            font-weight: bold;
        }
        .navbar-brand:hover {
            color: #d0d3db;
        }
        /* Botão de Logout */
        .logout-btn {
            color: white;
            background-color: #d9534f;
            border: none;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        .logout-btn:hover {
            background-color: #c9302c;
            transform: scale(1.05);
        }
        /* Cards */
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-4px);
        }
        .card-header {
            background-color: #1a1f71;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        .card-body p {
            color: #555;
        }
        .btn-primary {
            background-color: #1f5eff;
            border: none;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 15px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-primary:hover {
            background-color: #0044cc;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

   <!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <div class="ml-auto">
        <a href="index.php" class="logout-link">
            <button class="logout-btn">Deslogar</button>
        </a>
    </div>
</nav>

    <!-- Conteúdo do Dashboard -->
    <div class="container mt-4">
        <div class="row">
            <!-- Card de Gerenciar Porteiros -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">Gerenciar Porteiros</div>
                    <div class="card-body text-center">
                        <p>Gerencie o cadastro de porteiros no sistema.</p>
                        <a href="desabilitar.usuario.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card de Gerenciar Visitantes -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">Gerenciar Visitantes</div>
                    <div class="card-body text-center">
                        <p>Controle o registro de entrada e saída de visitantes.</p>
                        <a href="gerenciar.visitantes.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card de Relatórios -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">Relatórios</div>
                    <div class="card-body text-center">
                        <p>Gere relatórios detalhados das atividades do sistema.</p>
                        <a href="relatorios.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
