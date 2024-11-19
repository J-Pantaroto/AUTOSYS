<?php
require_once 'DatabaseConnection.php';

try {
    $mysqli = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

    $dbName = $_ENV['DB_DATABASE'];
    $result = $mysqli->query("SHOW DATABASES LIKE '$dbName'");
    if ($result->num_rows === 0) {
        $mysqli->query("CREATE DATABASE $dbName");
        echo "Banco de dados '$dbName' criado com sucesso.\n";
    }

    $mysqli->select_db($dbName);

    $sqlClientes = "
    CREATE TABLE IF NOT EXISTS clientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        senha_hash VARCHAR(255),
        telefone VARCHAR(15),
        endereco VARCHAR(255),
        is_admin TINYINT(1) DEFAULT 0,
        data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $mysqli->query($sqlClientes);
    echo "Tabela 'clientes' verificada/criada.\n";

    $sqlProdutos = "
    CREATE TABLE IF NOT EXISTS produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        descricao TEXT,
        preco DECIMAL(10,2) NOT NULL,
        estoque INT NOT NULL,
        data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $mysqli->query($sqlProdutos);
    echo "Tabela 'produtos' verificada/criada.\n";

    $sqlVendas = "
    CREATE TABLE IF NOT EXISTS vendas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_id INT NOT NULL,
        data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        total DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (cliente_id) REFERENCES clientes(id)
    )";
    $mysqli->query($sqlVendas);
    echo "Tabela 'vendas' verificada/criada.\n";
    echo "Setup concluído com sucesso.\n";
} catch (Exception $e) {
    echo "Erro ao configurar o banco de dados: " . $e->getMessage() . "\n";
}
