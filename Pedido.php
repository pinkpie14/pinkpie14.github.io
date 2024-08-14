<?php

require_once '../app/Config/database.php';

class Pedido
{
    private $conn;

    public function __construct()
    {
        $dbConfig = require '../app/Config/database.php';
        $this->conn = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database']);

        // Verifica se a conexão foi estabelecida com sucesso
        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }
    }

    /**
     * Cria um novo pedido no banco de dados.
     *
     * @param array $dados Associativo contendo 'usuario_id', 'status', e 'total'.
     * @return bool Retorna true se o pedido foi criado com sucesso, false caso contrário.
     */
    public function criar($dados)
    {
        // Valida os dados
        if (empty($dados['usuario_id']) || $dados['total'] <= 0) {
            return false; // Dados inválidos
        }

        // Prepara a instrução SQL
        $stmt = $this->conn->prepare("INSERT INTO Pedidos (usuario_id, status, total) VALUES (?, ?, ?)");

        if (!$stmt) {
            die("Erro na preparação da instrução: " . $this->conn->error);
        }

        // Bind dos parâmetros
        $stmt->bind_param("isd", $dados['usuario_id'], $dados['status'], $dados['total']);

        // Executa a instrução SQL e retorna o resultado
        $resultado = $stmt->execute();
        $stmt->close();
        
        return $resultado; // Retorna o resultado da execução
    }
}
