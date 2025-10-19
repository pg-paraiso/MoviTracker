<?php
// Arquivo de conexão com o banco de dados Supabase via API REST

// Configurações do Supabase
$supabase_url = 'https://cquouycbgollahpievpa.supabase.co'; // Substitua pela URL do seu projeto Supabase
$supabase_key = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImNxdW91eWNiZ29sbGFocGlldnBhIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NjA5MDU1OTksImV4cCI6MjA3NjQ4MTU5OX0.cyBVnvEOR2Gurr49w2tyXhd3-Px1q5fLaTbyUKW8CSk'; // Substitua pela chave anônima do seu projeto Supabase

// Função para fazer requisições à API do Supabase
function fazerRequisicao($endpoint, $method = 'GET', $data = null) {
    global $supabase_url, $supabase_key;
    
    $url = $supabase_url . '/rest/v1/' . $endpoint;
    
    $headers = [
        'apikey: ' . $supabase_key,
        'Authorization: Bearer ' . $supabase_key,
        'Content-Type: application/json',
        'Prefer: return=representation'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    } elseif ($method === 'PATCH') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    } elseif ($method === 'DELETE') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code >= 200 && $http_code < 300) {
        return json_decode($response, true);
    } else {
        error_log("Erro na API Supabase: HTTP $http_code - $response");
        return false;
    }
}

// Função para verificar login
function verificarLogin($email, $senha) {
    $resultado = fazerRequisicao("usuarios?email=eq.$email&senha=eq.$senha&select=*");
    
    if ($resultado && count($resultado) > 0) {
        return $resultado[0];
    }
    
    return false;
}

// Função para cadastrar usuário
function cadastrarUsuario($nome, $email, $senha, $tipo) {
    $dados = [
        'nome' => $nome,
        'email' => $email,
        'senha' => $senha,
        'tipo' => $tipo
    ];
    
    $resultado = fazerRequisicao('usuarios', 'POST', $dados);
    
    if ($resultado && count($resultado) > 0) {
        return true;
    }
    
    return false;
}

// Função para obter dados da clínica
function obterDadosClinica() {
    $resultado = fazerRequisicao("clinica?select=*&order=id.desc&limit=1");
    
    if ($resultado && count($resultado) > 0) {
        return $resultado[0];
    }
    
    return false;
}

// Função para obter todos os usuários (útil para administração)
function obterUsuarios() {
    return fazerRequisicao("usuarios?select=*");
}

// Função para obter usuário por ID
function obterUsuarioPorId($id) {
    $resultado = fazerRequisicao("usuarios?id=eq.$id&select=*");
    
    if ($resultado && count($resultado) > 0) {
        return $resultado[0];
    }
    
    return false;
}

// Função para atualizar dados do usuário
function atualizarUsuario($id, $dados) {
    $resultado = fazerRequisicao("usuarios?id=eq.$id", 'PATCH', $dados);
    
    if ($resultado && count($resultado) > 0) {
        return true;
    }
    
    return false;
}

// Função para deletar usuário
function deletarUsuario($id) {
    $resultado = fazerRequisicao("usuarios?id=eq.$id", 'DELETE');
    
    return $resultado !== false;
}

// Função para testar conexão
function testarConexao() {
    $resultado = fazerRequisicao("usuarios?select=count");
    return $resultado !== false;
}
?>
