<?php
session_start();
require_once 'conexao.php';

$sucesso = '';
$erro = '';

if ($_POST) {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    
    // Validações
    if (empty($nome) || empty($email) || empty($senha) || empty($tipo)) {
        $erro = 'Por favor, preencha todos os campos!';
    } elseif ($senha !== $confirmar_senha) {
        $erro = 'As senhas não coincidem!';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter pelo menos 6 caracteres!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Email inválido!';
    } else {
        // Tentar cadastrar usuário
        if (cadastrarUsuario($nome, $email, $senha, $tipo)) {
            $sucesso = 'Cadastro realizado com sucesso! Você pode fazer login agora.';
            // Limpar formulário
            $_POST = array();
        } else {
            $erro = 'Erro ao cadastrar usuário. Email já existe ou erro no servidor.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - FisioVida</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo h1 {
            color: #667eea;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #5a6fd8;
        }

        .sucesso {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 1rem;
            border: 1px solid #c3e6cb;
        }

        .erro {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 1rem;
            border: 1px solid #f5c6cb;
        }

        .links {
            text-align: center;
            margin-top: 1.5rem;
        }

        .links a {
            color: #667eea;
            text-decoration: none;
            margin: 0 10px;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 1rem;
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        .tipo-info {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/index.html" class="back-btn">← Voltar ao início</a>
        
        <div class="logo">
            <h1>🏥 FisioVida</h1>
            <p>Crie sua conta</p>
        </div>

        <?php if ($sucesso): ?>
            <div class="sucesso"><?php echo $sucesso; ?></div>
        <?php endif; ?>

        <?php if ($erro): ?>
            <div class="erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required value="<?php echo $_POST['nome'] ?? ''; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo $_POST['email'] ?? ''; ?>">
            </div>

            <div class="form-group">
                <label for="tipo">Tipo de Usuário:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione...</option>
                    <option value="paciente" <?php echo ($_POST['tipo'] ?? '') == 'paciente' ? 'selected' : ''; ?>>Paciente</option>
                    <option value="fisioterapeuta" <?php echo ($_POST['tipo'] ?? '') == 'fisioterapeuta' ? 'selected' : ''; ?>>Fisioterapeuta</option>
                </select>
                <div class="tipo-info">
                    <strong>Paciente:</strong> Acesse exercícios, acompanhe seu tratamento<br>
                    <strong>Fisioterapeuta:</strong> Gerencie pacientes e crie planos de tratamento
                </div>
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required minlength="6">
            </div>

            <div class="form-group">
                <label for="confirmar_senha">Confirmar Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required minlength="6">
            </div>

            <button type="submit" class="btn">Cadastrar</button>
        </form>

        <div class="links">
            <a href="/api/login.php">Já tem conta? Faça login</a>
        </div>
    </div>

    <script>
        // Validação em tempo real da confirmação de senha
        document.getElementById('confirmar_senha').addEventListener('input', function() {
            const senha = document.getElementById('senha').value;
            const confirmarSenha = this.value;
            
            if (confirmarSenha && senha !== confirmarSenha) {
                this.style.borderColor = '#dc3545';
            } else {
                this.style.borderColor = '#e1e5e9';
            }
        });

        // Foco automático no primeiro campo
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nome').focus();
        });
    </script>
</body>
</html>
