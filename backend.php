<?php
// backend.php

require_once '../app/Models/Pedido.php'; // Ajuste o caminho conforme necessário

header('Content-Type: application/json');

// Verifica se o ID do pedido foi fornecido
if (!isset($_GET['pedidoId'])) {
    echo json_encode([
        'error' => 'ID do pedido não fornecido'
    ]);
    exit;
}

$pedidoId = $_GET['pedidoId'];
$pedido = new Pedido();

// Obtém dados do pedido
$data = $pedido->rastrear($pedidoId);

// Verifica se o pedido foi encontrado
if ($data) {
    echo json_encode($data);
} else {
    echo json_encode([
        'error' => 'Pedido não encontrado'
    ]);
}
