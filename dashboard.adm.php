<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilo geral */
        body {
            background-color: #e9ecef;
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: #1f2d3d;
        }
        .navbar-brand {
            color: #f8f9fa;
            font-weight: bold;
        }
        .navbar-brand:hover {
            color: #adb5bd;
        }

        /* Botão de Logout */
        .logout-btn {
            color: white;
            background-color: #d9534f;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #c9302c;
        }

        /* Estilo dos Cards */
        .card {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.02);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        /* Botões Personalizados */
        .btn-custom {
            background-color: white;     /* Fundo branco */
            color: #007bff;              /* Texto azul */
            border: 2px solid #007bff;   /* Borda azul */
            border-radius: 5px;
            padding: 10px;
            font-weight: bold;
            margin-top: auto;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #429dff;   /* Fundo azul ao passar o mouse */
            color: white;                /* Texto branco ao passar o mouse */
        }

        /* Título Principal */
        h1 {
            color: #343a40;
            font-size: 1.8em;
            font-weight: bold;
            margin-top: 20px;
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
                        <a href="desabilitar.usuario.php" class="btn btn-custom btn-block">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card de Gerenciar Visitantes -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">Gerenciar Visitantes</div>
                    <div class="card-body text-center">
                        <p>Controle o registro de entrada e saída de visitantes.</p>
                        <a href="gerenciar.visitantes.php" class="btn btn-custom btn-block">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card de Relatórios -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">Relatórios</div>
                    <div class="card-body text-center">
                        <p>Gere relatórios detalhados das atividades do sistema.</p>
                        <a href="relatorios.php" class="btn btn-custom btn-block">Acessar</a>
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
