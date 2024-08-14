<?php

require_once '../app/Controllers/PedidoController.php';
require_once '../app/Controllers/UsuarioController.php';
require_once '../app/Controllers/FeedbackController.php';

// Verifica se a ação está definida e se é um método permitido
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($action) {
        case 'criarPedido':
            if ($method === 'POST') {
                $pedidoController = new PedidoController();
                if (method_exists($pedidoController, 'criar')) {
                    $pedidoController->criar();
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Método não encontrado.']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Método não permitido.']);
            }
            break;

        case 'rastrearPedido':
            if ($method === 'GET') {
                $pedidoController = new PedidoController();
                if (method_exists($pedidoController, 'rastrear')) {
                    class PedidoController {
                        public function rastrear(){
                            // implementação do método rastrear
                        }
                    }

                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Método não encontrado.']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Método não permitido.']);
            }
            break;

        case 'criarUsuario':
            if ($method === 'POST') {
                $usuarioController = new UsuarioController();
                if (method_exists($usuarioController, 'criar')) {
                    $usuarioController->criar();
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Método não encontrado.']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Método não permitido.']);
            }
            break;

        case 'enviarFeedback':
            if ($method === 'POST') {
                $feedbackController = new FeedbackController();
                if (method_exists($feedbackController, 'enviar')) {
                    $feedbackController->enviar();
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Método não encontrado.']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Método não permitido.']);
            }
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Ação desconhecida.']);
            break;
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Nenhuma ação foi especificada.']);
}
