<?php

require_once '../app/Config/database.php';

class Usuario
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
     * Cria um novo usuário no banco de dados.
     *
     * @param array $dados Associativo contendo 'nome', 'email', e 'senha'.
     * @return bool Retorna true se o usuário foi criado com sucesso, false caso contrário.
     */
    public function criar($dados)
    {
        // Validação simples dos dados
        if (empty($dados['nome']) || empty($dados['email']) || empty($dados['senha'])) {
            return false; // Dados incompletos
        }

        // Gera o hash da senha
        $senhaHash = password_hash($dados['senha'], PASSWORD_BCRYPT);

        // Prepara a instrução SQL
        $stmt = $this->conn->prepare("INSERT INTO Usuarioos (nome, email, senha) VALUES (?, ?, ?)");
        
        if (!$stmt) {
            die("Erro na preparação da instrução: " . $this->conn->error);
        }

        // Bind dos parâmetros
        $stmt->bind_param("sss", $dados['nome'], $dados['email'], $senhaHash);

        // Executa a instrução SQL e retorna o resultado
        $result = $stmt->execute();
        $stmt->close();
        
        return $result; // Retorna o resultado da execução
    }

    /**
     * Obtém informações do usuário com base no ID fornecido.
     *
     * @param int $usuarioId ID do usuário a ser buscado.
     * @return array|false Retorna um array com os dados do usuário se encontrado, false caso contrário.
     */
    public function obterPorId($usuarioId)
    {
        if ($usuarioId <= 0) {
            return false; // ID inválido
        }

        // Prepara a instrução SQL
        $stmt = $this->conn->prepare("SELECT id, nome, email, criado_em FROM Usuarioos WHERE id = ?");
        
        if (!$stmt) {
            die("Erro na preparação da instrução: " . $this->conn->error);
        }

        // Bind dos parâmetros
        $stmt->bind_param("i", $usuarioId);

        // Executa a instrução SQL
        $stmt->execute();

        // Obtém o resultado
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();
        
        return $usuario; // Retorna os dados do usuário ou false se não encontrado
    }
}
