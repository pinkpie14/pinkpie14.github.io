-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS sistema_entregas;
USE sistema_entregas;

-- Tabela para usuários
CREATE TABLE IF NOT EXISTS Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    endereco VARCHAR(255),
    telefone VARCHAR(20),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para pedidos
CREATE TABLE IF NOT EXISTS Pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Pendente', 'Em Transporte', 'Entregue') NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
);

-- Tabela para feedback
CREATE TABLE IF NOT EXISTS Feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    pedido_id INT,
    nota INT CHECK (nota BETWEEN 1 AND 5),
    comentario TEXT,
    data_feedback TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(id)
);

-- Inserir um usuário de teste
INSERT INTO Usuarios (nome, email, senha) VALUES ('Maria Oliveira', 'maria@example.com', 'senha456');

-- Inserir um pedido de teste
INSERT INTO Pedidos (usuario_id, status, total) VALUES (1, 'Pendente', 150.00);

-- Inserir feedback de teste
INSERT INTO Feedback (usuario_id, pedido_id, nota, comentario) VALUES (1, 1, 4, 'Bom serviço, mas pode melhorar.');

-- Consultar usuários
SELECT * FROM Usuarios;

-- Consultar pedidos
SELECT * FROM Pedidos;

-- Consultar feedback
SELECT * FROM Feedback;

-- Tabela para notificações
CREATE TABLE IF NOT EXISTS notificacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir uma notificação de teste
INSERT INTO notificacoes (title, message) VALUES ('Pedido Enviado', 'Seu pedido foi enviado e está a caminho.');

-- Tabela para pedidos (possivelmente uma tabela adicional ou revisão)
CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedidoId VARCHAR(50) NOT NULL,
    cliente VARCHAR(100) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    produto VARCHAR(100) NOT NULL,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Adicionar uma nova coluna para a tabela pedidos
ALTER TABLE pedidos
ADD COLUMN nova_coluna VARCHAR(50);  -- Exemplo de adição de uma nova coluna

-- Tabela para usuários (corrigir nome da tabela se necessário)
CREATE TABLE IF NOT EXISTS Usuarioos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
