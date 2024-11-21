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
    $sqlCategorias = "
    CREATE TABLE IF NOT EXISTS categorias (
        id INT AUTO_INCREMENT PRIMARY KEY,
        descricao VARCHAR(100) NOT NULL
    )";
    $mysqli->query($sqlCategorias);
    $sqlProdutos = "
    CREATE TABLE IF NOT EXISTS produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100),
        descricao TEXT,
        preco DECIMAL(10,2),
        quantidade INT,
        categoria_id INT,
        data_adicionado DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (categoria_id) REFERENCES categorias(id)
    )";
    $mysqli->query($sqlProdutos);

    $sqlVendas = "
    CREATE TABLE IF NOT EXISTS vendas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_id INT NOT NULL,
        data_venda DATETIME NOT NULL,
        valor_total DECIMAL(10, 2) NOT NULL,
        data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (cliente_id) REFERENCES clientes(id)
        )";
    $mysqli->query($sqlVendas);
    $sqlItensVendas = "
    CREATE TABLE IF NOT EXISTS itensvenda (
        id INT AUTO_INCREMENT PRIMARY KEY,
        venda_id INT NOT NULL,
        produto_id INT NOT NULL,
        quantidade INT NOT NULL,
        subtotal DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (venda_id) REFERENCES vendas(id),
        FOREIGN KEY (produto_id) REFERENCES produtos(id)
    )";
    $mysqli->query($sqlItensVendas);
} catch (Exception $e) {
    echo "Erro ao configurar o banco de dados: " . $e->getMessage() . "\n";
}
