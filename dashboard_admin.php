<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand {
            color: white;
        }
        .card {
            margin-top: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .logout-btn {
            color: white;
            background-color: #dc3545;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <div class="ml-auto">
            <button class="logout-btn">Logout</button>
        </div>
    </nav>

    <!-- Conteúdo do Dashboard -->
    <div class="container">
        <div class="row">
            <!-- Card de Gerenciar Porteiros -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Gerenciar Porteiros</div>
                    <div class="card-body">
                        <p>Gerencie o cadastro de porteiros no sistema.</p>
                        <a href="desabilitar_usuario.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card de Gerenciar Visitantes -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Gerenciar Visitantes</div>
                    <div class="card-body">
                        <p>Controle o registro de entrada e saída de visitantes.</p>
                        <a href="gerenciar_visitantes.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card de Relatórios -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Relatórios</div>
                    <div class="card-body">
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
