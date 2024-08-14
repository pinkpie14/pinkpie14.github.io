<?php

require_once '../app/Models/Usuario.php';

header('Content-Type: application/json');

$usuarioId = isset($_GET['usuarioId']) ? intval($_GET['usuarioId']) : 0;

if ($usuarioId <= 0) {
    echo json_encode(['error' => 'ID do usuário não fornecido ou inválido.']);
    exit();
}

// Cria uma instância da classe Usuario
$usuario = new Usuario();

// Obtém os dados do usuário pelo ID
$dadosUsuario = $usuario->obterPorId($usuarioId);

if ($dadosUsuario) {
    echo json_encode($dadosUsuario);
} else {
    echo json_encode(['error' => 'Usuário não encontrado.']);
}
