<?php
require_once 'conexao.php';

// Obter dados da clínica
$clinica = obterDadosClinica();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações da Clínica - FisioVida</title>
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

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .clinic-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            text-align: center;
        }

        .clinic-card h1 {
            color: #667eea;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }

        .clinic-card .subtitle {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 2rem;
        }

        .info-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-card h3 {
            color: #667eea;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }

        .info-card .highlight {
            color: #333;
            font-weight: 500;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 2rem;
        }

        .service-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-card h4 {
            color: #667eea;
            margin-bottom: 1rem;
        }

        .service-card p {
            color: #666;
            font-size: 0.9rem;
        }

        .contact-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .contact-section h3 {
            color: #667eea;
            margin-bottom: 1.5rem;
        }

        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 2rem;
        }

        .contact-item {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .contact-item h4 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .contact-item p {
            color: #666;
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            margin: 10px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
        }

        .btn:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 10px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .contact-info {
                grid-template-columns: 1fr;
            }

            .clinic-card h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="logo">🏥 FisioVida</div>
            <a href="index.html" class="back-btn">← Voltar ao início</a>
        </div>
    </div>

    <div class="container">
        <div class="clinic-card">
            <h1><?php echo htmlspecialchars($clinica['nome'] ?? 'Clínica FisioVida'); ?></h1>
            <p class="subtitle">Especializada em Fisioterapia e Reabilitação Física</p>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <h3>📍 Localização</h3>
                <p class="highlight"><?php echo htmlspecialchars($clinica['endereco'] ?? 'Rua das Flores, 123 - Centro'); ?></p>
                <p>Fácil acesso por transporte público e estacionamento disponível.</p>
            </div>

            <div class="info-card">
                <h3>📞 Contato</h3>
                <p class="highlight"><?php echo htmlspecialchars($clinica['telefone'] ?? '(11) 99999-9999'); ?></p>
                <p>Atendimento de segunda a sexta, das 7h às 19h.</p>
            </div>

            <div class="info-card">
                <h3>⏰ Horário de Funcionamento</h3>
                <p class="highlight">Segunda a Sexta: 7h às 19h</p>
                <p class="highlight">Sábado: 8h às 12h</p>
                <p>Domingos e feriados: Fechado</p>
            </div>
        </div>

        <div class="info-card">
            <h3>ℹ️ Sobre a Clínica</h3>
            <p><?php echo htmlspecialchars($clinica['descricao'] ?? 'Nossa clínica oferece tratamentos especializados em fisioterapia, com foco na reabilitação física e melhoria da qualidade de vida dos nossos pacientes. Contamos com profissionais qualificados e equipamentos modernos para garantir o melhor atendimento.'); ?></p>
        </div>

        <div class="info-card">
            <h3>🩺 Nossos Serviços</h3>
            <div class="services-grid">
                <div class="service-card">
                    <h4>Fisioterapia Ortopédica</h4>
                    <p>Tratamento de lesões musculoesqueléticas e pós-operatórias</p>
                </div>
                <div class="service-card">
                    <h4>Fisioterapia Neurológica</h4>
                    <p>Reabilitação para pacientes com distúrbios neurológicos</p>
                </div>
                <div class="service-card">
                    <h4>Fisioterapia Respiratória</h4>
                    <p>Tratamento de problemas respiratórios e pulmonares</p>
                </div>
                <div class="service-card">
                    <h4>Pilates Clínico</h4>
                    <p>Exercícios terapêuticos para fortalecimento e alongamento</p>
                </div>
                <div class="service-card">
                    <h4>Hidroterapia</h4>
                    <p>Tratamento aquático para reabilitação e relaxamento</p>
                </div>
                <div class="service-card">
                    <h4>Acupuntura</h4>
                    <p>Terapia complementar para dor e relaxamento</p>
                </div>
            </div>
        </div>

        <div class="contact-section">
            <h3>📞 Entre em Contato</h3>
            <div class="contact-info">
                <div class="contact-item">
                    <h4>Telefone</h4>
                    <p><?php echo htmlspecialchars($clinica['telefone'] ?? '(11) 99999-9999'); ?></p>
                </div>
                <div class="contact-item">
                    <h4>WhatsApp</h4>
                    <p><?php echo htmlspecialchars($clinica['telefone'] ?? '(11) 99999-9999'); ?></p>
                </div>
                <div class="contact-item">
                    <h4>Email</h4>
                    <p>contato@fisiovida.com.br</p>
                </div>
                <div class="contact-item">
                    <h4>Endereço</h4>
                    <p><?php echo htmlspecialchars($clinica['endereco'] ?? 'Rua das Flores, 123 - Centro'); ?></p>
                </div>
            </div>
            
            <div>
                <a href="index.html" class="btn">Voltar ao Início</a>
                <a href="login.php" class="btn btn-secondary">Fazer Login</a>
            </div>
        </div>
    </div>

    <script>
        // Adicionar efeitos visuais
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.info-card, .service-card');
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
