<?php
session_start();
require_once 'conexao.php';

// Verificar se o usuário está logado e é fisioterapeuta
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'fisioterapeuta') {
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
    <title>Área do Fisioterapeuta - FisioVida</title>
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

        .btn-success {
            background: #28a745;
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-warning {
            background: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
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

        .patient-list {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .patient-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .patient-item:last-child {
            border-bottom: none;
        }

        .patient-info h4 {
            color: #333;
            margin-bottom: 0.25rem;
        }

        .patient-info p {
            color: #666;
            font-size: 0.9rem;
        }

        .patient-status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
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

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 10px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .patient-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="logo">🏥 FisioVida</div>
            <div class="user-info">
                <span>Dr(a). <?php echo htmlspecialchars($usuario_nome); ?></span>
                <a href="logout.php" class="logout-btn">Sair</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="welcome-card">
            <h1>Área do Fisioterapeuta</h1>
            <p>Gerencie seus pacientes e crie planos de tratamento eficazes</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">12</div>
                <div class="stat-label">Pacientes Ativos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">8</div>
                <div class="stat-label">Consultas Hoje</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">24</div>
                <div class="stat-label">Exercícios Prescritos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">95%</div>
                <div class="stat-label">Taxa de Sucesso</div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>👥 Meus Pacientes</h3>
                <p>Gerencie a lista de pacientes, visualize prontuários e acompanhe o progresso de cada um.</p>
                <a href="#" class="btn">Gerenciar Pacientes</a>
            </div>

            <div class="card">
                <h3>📋 Planos de Tratamento</h3>
                <p>Crie e personalize planos de tratamento específicos para cada paciente.</p>
                <a href="#" class="btn btn-success">Criar Plano</a>
            </div>

            <div class="card">
                <h3>🏃‍♂️ Exercícios</h3>
                <p>Biblioteca de exercícios e prescrições personalizadas para seus pacientes.</p>
                <a href="#" class="btn btn-warning">Biblioteca</a>
            </div>

            <div class="card">
                <h3>📊 Relatórios</h3>
                <p>Gere relatórios detalhados sobre o progresso e evolução dos tratamentos.</p>
                <a href="#" class="btn btn-secondary">Gerar Relatórios</a>
            </div>
        </div>

        <div class="quick-actions">
            <h3>⚡ Ações Rápidas</h3>
            <div class="action-buttons">
                <a href="#" class="btn">Nova Consulta</a>
                <a href="#" class="btn btn-success">Adicionar Paciente</a>
                <a href="#" class="btn btn-warning">Prescrever Exercícios</a>
                <a href="#" class="btn btn-secondary">Agenda</a>
                <a href="clinica.php" class="btn btn-secondary">Informações da Clínica</a>
            </div>
        </div>

        <div class="patient-list">
            <h3>👥 Pacientes Recentes</h3>
            <div class="patient-item">
                <div class="patient-info">
                    <h4>João Silva</h4>
                    <p>Última consulta: 15/01/2024</p>
                </div>
                <div class="patient-status status-active">Ativo</div>
            </div>
            <div class="patient-item">
                <div class="patient-info">
                    <h4>Maria Santos</h4>
                    <p>Última consulta: 14/01/2024</p>
                </div>
                <div class="patient-status status-pending">Aguardando</div>
            </div>
            <div class="patient-item">
                <div class="patient-info">
                    <h4>Pedro Costa</h4>
                    <p>Última consulta: 13/01/2024</p>
                </div>
                <div class="patient-status status-active">Ativo</div>
            </div>
        </div>
    </div>

    <script>
        // Adicionar interatividade simples
        document.addEventListener('DOMContentLoaded', function() {
            // Animar cards ao carregar
            const cards = document.querySelectorAll('.card, .stat-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Simular contadores animados
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalValue = stat.textContent;
                const isPercentage = finalValue.includes('%');
                const numericValue = parseInt(finalValue.replace(/\D/g, ''));
                
                let currentValue = 0;
                const increment = numericValue / 30;
                
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= numericValue) {
                        currentValue = numericValue;
                        clearInterval(timer);
                    }
                    stat.textContent = Math.floor(currentValue) + (isPercentage ? '%' : '');
                }, 50);
            });
        });
    </script>
</body>
</html>
