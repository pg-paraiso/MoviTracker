# 🏥 FisioVida - Sistema de Fisioterapia

Um sistema web simples para gestão de fisioterapia com páginas específicas para pacientes, fisioterapeutas e informações da clínica.

## 📋 Características

- **Frontend**: HTML, CSS e JavaScript puro (sem bibliotecas externas)
- **Backend**: PHP puro (sem frameworks)
- **Banco de Dados**: PostgreSQL no Supabase via API REST
- **Autenticação**: Sistema simples de login/cadastro
- **Responsivo**: Interface adaptável para mobile e desktop
- **API REST**: Comunicação segura e eficiente com o banco de dados

## 🚀 Funcionalidades

### Para Pacientes
- Dashboard personalizado
- Visualização do tratamento
- Acompanhamento de exercícios
- Contato com fisioterapeuta

### Para Fisioterapeutas
- Gestão de pacientes
- Criação de planos de tratamento
- Biblioteca de exercícios
- Relatórios de progresso

### Para a Clínica
- Informações institucionais
- Serviços oferecidos
- Dados de contato

## 🛠️ Instalação e Configuração

### 1. Configuração do Supabase

1. Acesse [supabase.com](https://supabase.com) e crie uma conta
2. Crie um novo projeto
3. Vá para "SQL Editor" no painel do Supabase
4. Execute o script `database.sql` fornecido
5. Obtenha as credenciais da API REST:
   - Vá para "Settings" > "API"
   - Copie a "Project URL" (será sua `$supabase_url`)
   - Copie a "anon public" key (será sua `$supabase_key`)

### 2. Configuração Local

1. Clone ou baixe este repositório
2. Configure um servidor local (XAMPP, WAMP, etc.)
3. Edite o arquivo `conexao.php` com suas credenciais do Supabase:

```php
$supabase_url = 'https://xxxxxxxxxxxxxxxxxxxx.supabase.co';
$supabase_key = 'sua_chave_anonima_aqui';
```

4. Coloque os arquivos na pasta do servidor web
5. Acesse `http://localhost/MoviTracker` no navegador

### 3. Deploy no Vercel

1. Instale o Vercel CLI:
```bash
npm i -g vercel
```

2. Faça login no Vercel:
```bash
vercel login
```

3. Na pasta do projeto, execute:
```bash
vercel
```

4. Siga as instruções para configurar o projeto
5. Configure as variáveis de ambiente no painel do Vercel:
   - `SUPABASE_URL`
   - `SUPABASE_KEY`

## 📁 Estrutura de Arquivos

```
MoviTracker/
├── index.html              # Página inicial
├── login.php               # Página de login
├── cadastro.php            # Página de cadastro
├── paciente.php            # Dashboard do paciente
├── fisioterapeuta.php      # Dashboard do fisioterapeuta
├── clinica.php             # Informações da clínica
├── logout.php              # Logout do sistema
├── conexao.php             # Conexão com banco de dados
├── database.sql            # Script SQL para criar tabelas
└── README.md               # Este arquivo
```

## 🗄️ Banco de Dados

### API REST do Supabase

O sistema utiliza a API REST do Supabase para comunicação com o banco de dados PostgreSQL. Isso oferece:

- **Segurança**: Autenticação via API keys
- **Escalabilidade**: Suporte a alta demanda
- **Simplicidade**: Não precisa de drivers PostgreSQL
- **Flexibilidade**: Funciona em qualquer servidor com PHP e cURL

### Tabelas

- **usuarios**: Armazena dados dos usuários (pacientes e fisioterapeutas)
- **clinica**: Informações da clínica

### Estrutura da tabela `usuarios`
- `id`: Chave primária
- `nome`: Nome completo do usuário
- `email`: Email único
- `senha`: Senha (sem criptografia - apenas para demonstração)
- `tipo`: 'paciente' ou 'fisioterapeuta'
- `data_cadastro`: Data de criação do registro

### Estrutura da tabela `clinica`
- `id`: Chave primária
- `nome`: Nome da clínica
- `endereco`: Endereço completo
- `telefone`: Telefone de contato
- `descricao`: Descrição da clínica
- `data_cadastro`: Data de criação do registro

### Funções da API Disponíveis

- `verificarLogin($email, $senha)`: Autentica usuário
- `cadastrarUsuario($nome, $email, $senha, $tipo)`: Cria novo usuário
- `obterDadosClinica()`: Busca informações da clínica
- `obterUsuarios()`: Lista todos os usuários
- `obterUsuarioPorId($id)`: Busca usuário específico
- `atualizarUsuario($id, $dados)`: Atualiza dados do usuário
- `deletarUsuario($id)`: Remove usuário
- `testarConexao()`: Testa conectividade com a API

## 🔐 Segurança

⚠️ **Importante**: Este é um projeto de demonstração. Para uso em produção, implemente:

- Criptografia de senhas (password_hash)
- Validação e sanitização de dados
- Proteção contra SQL Injection (PDO já implementado)
- Sessões seguras
- HTTPS obrigatório

## 🎨 Personalização

### Cores
As cores principais podem ser alteradas no CSS:
- Primária: `#667eea`
- Secundária: `#764ba2`
- Sucesso: `#28a745`
- Aviso: `#ffc107`

### Logo e Nome
Altere o nome "FisioVida" nos arquivos HTML e PHP conforme necessário.

## 📱 Responsividade

O sistema é totalmente responsivo e funciona em:
- Desktop
- Tablet
- Smartphone

## 🐛 Solução de Problemas

### Erro de Conexão com Banco
- Verifique as credenciais no `conexao.php` (URL e chave da API)
- Confirme se o Supabase está ativo
- Teste a conexão usando a função `testarConexao()`
- Verifique se a API REST está habilitada no Supabase
- Confirme se as tabelas foram criadas corretamente

### Páginas não Carregam
- Verifique se o servidor web está rodando
- Confirme se o PHP está habilitado
- Verifique os logs de erro do servidor

### Problemas no Vercel
- Configure as variáveis de ambiente (SUPABASE_URL e SUPABASE_KEY)
- Verifique se o PHP está habilitado no projeto
- Confirme se as credenciais da API estão corretas
- Verifique se o cURL está disponível no servidor

### Requisitos do Servidor
- PHP 7.4 ou superior
- Extensão cURL habilitada
- Acesso à internet para comunicação com a API do Supabase

## 📞 Suporte

Para dúvidas ou problemas:
1. Verifique este README
2. Consulte a documentação do Supabase
3. Verifique a documentação do Vercel

## 📄 Licença

Este projeto é de código aberto e pode ser usado livremente para fins educacionais e comerciais.

---

**Desenvolvido com ❤️ para a área da saúde**
