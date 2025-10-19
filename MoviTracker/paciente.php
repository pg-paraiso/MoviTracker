<?php
session_start();
require_once 'conexao.php';

// Verificar se o usuário está logado e é paciente
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'paciente') {
    header('Location: login.php');
    exit;
}

$usuario_nome = $_SESSION['usuario_nome'];
$usuario_email = $_SESSION['usuario_email'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Paciente - FisioVida</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .welcome-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            text-align: center;
        }

        .welcome-card h1 {
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .welcome-card p {
            color: #666;
            font-size: 1.1rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 2rem;
        }

        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            color: #667eea;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #5a6fd8;
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .status-indicator {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .quick-actions {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .quick-actions h3 {
            color: #667eea;
            margin-bottom: 1rem;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 10px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="logo">🏥 FisioVida</div>
            <div class="user-info">
                <span>Olá, <?php echo htmlspecialchars($usuario_nome); ?>!</span>
                <a href="logout.php" class="logout-btn">Sair</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="welcome-card">
            <h1>Bem-vindo à sua área!</h1>
            <p>Gerencie seu tratamento e acompanhe seu progresso</p>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>📋 Meu Tratamento</h3>
                <p>Visualize seu plano de tratamento atual, exercícios prescritos e próximas sessões.</p>
                <div class="status-indicator status-active">Tratamento Ativo</div>
                <br><br>
                <a href="#" class="btn">Ver Detalhes</a>
            </div>

            <div class="card">
                <h3>🏃‍♂️ Exercícios</h3>
                <p>Acesse os exercícios recomendados pelo seu fisioterapeuta e acompanhe sua evolução.</p>
                <div class="status-indicator status-pending">3 Exercícios Pendentes</div>
                <br><br>
                <a href="#" class="btn">Iniciar Exercícios</a>
            </div>

            <div class="card">
                <h3>📊 Progresso</h3>
                <p>Monitore seu progresso através de gráficos e relatórios detalhados.</p>
                <div class="status-indicator status-active">Bom Progresso</div>
                <br><br>
                <a href="#" class="btn">Ver Relatórios</a>
            </div>

            <div class="card">
                <h3>👨‍⚕️ Meu Fisioterapeuta</h3>
                <p>Entre em contato com seu fisioterapeuta e agende consultas.</p>
                <div class="status-indicator status-active">Dr. Maria Santos</div>
                <br><br>
                <a href="#" class="btn">Contatar</a>
            </div>
        </div>

        <div class="quick-actions">
            <h3>⚡ Ações Rápidas</h3>
            <div class="action-buttons">
                <a href="#" class="btn">Agendar Consulta</a>
                <a href="#" class="btn btn-secondary">Baixar Relatório</a>
                <a href="#" class="btn btn-secondary">Alterar Dados</a>
                <a href="clinica.php" class="btn btn-secondary">Informações da Clínica</a>
            </div>
        </div>

        <div class="card">
            <h3>📅 Próximas Atividades</h3>
            <p><strong>Hoje:</strong> Exercícios de alongamento (15 min)</p>
            <p><strong>Amanhã:</strong> Sessão de fisioterapia - 14:00</p>
            <p><strong>Próxima semana:</strong> Avaliação de progresso</p>
        </div>
    </div>

    <script>
        // Adicionar interatividade simples
        document.addEventListener('DOMContentLoaded', function() {
            // Animar cards ao carregar
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
