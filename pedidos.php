<?php

require_once '../app/Models/Pedido.php';

header('Content-Type: application/json');

$pedidoId = isset($_GET['pedidoId']) ? $_GET['pedidoId'] : '';

if (empty($pedidoId)) {
    echo json_encode(['error' => 'ID do pedido não fornecido.']);
    exit();
}

$pedido = new Pedido();
$dados = $pedido->rastrear($pedidoId);

if ($dados) {
    echo json_encode($dados);
} else {
    echo json_encode(['error' => 'Pedido não encontrado.']);
}
