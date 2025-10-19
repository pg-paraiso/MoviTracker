-- Script SQL para criar as tabelas no Supabase (PostgreSQL)
-- Execute este script no editor SQL do Supabase

-- Tabela de usuários
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo VARCHAR(20) NOT NULL CHECK (tipo IN ('paciente', 'fisioterapeuta')),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela da clínica
CREATE TABLE clinica (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco TEXT NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    descricao TEXT,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir dados iniciais da clínica
INSERT INTO clinica (nome, endereco, telefone, descricao) VALUES 
('Clínica FisioVida', 'Rua das Flores, 123 - Centro', '(11) 99999-9999', 'Clínica especializada em fisioterapia e reabilitação física');

-- Inserir usuários de exemplo (opcional)
INSERT INTO usuarios (nome, email, senha, tipo) VALUES 
('João Silva', 'joao@email.com', '123456', 'paciente'),
('Dr. Maria Santos', 'maria@email.com', '123456', 'fisioterapeuta');
