<?php

use PHPUnit\Framework\TestCase;
use App\Models\Produto;

class ProdutoTest extends TestCase
{
    protected $produto;

    protected function setUp(): void
    {
        \App\Config\EnvLoader::load(__DIR__ . '/../../app/config/.env');

        $this->produto = new Produto();

        $produtos = $this->produto->read();
        foreach ($produtos as $p) {
            if ($p['nome'] === "Test Product") {
                $this->produto->delete($p['id']);
            }
        }

        $this->produto->nome = "Test Product";
        $this->produto->descricao = "This is a test product.";
        $this->produto->preco = 100.50;
        $this->produto->quantidade = 10;
        $this->produto->categoria_id = 1;

        $this->produto->create();
    }

    public function testCreateProduto()
    {
        $novoProduto = new Produto();
        $novoProduto->nome = "Another Product";
        $novoProduto->descricao = "Another test product.";
        $novoProduto->preco = 200.00;
        $novoProduto->quantidade = 5;
        $novoProduto->categoria_id = 2;

        $result = $novoProduto->create();
        $this->assertTrue($result);
    }

    public function testReadProdutos()
    {
        $produtos = $this->produto->read();
        $this->assertNotEmpty($produtos, "Nenhum produto encontrado.");
    }

    public function testReadOneProduto()
    {
        $produtos = $this->produto->read();
        $this->assertNotEmpty($produtos, "Nenhum produto encontrado.");

        $produto = reset($produtos);
        $produtoLido = $this->produto->readOne($produto['id']);

        $this->assertNotNull($produtoLido, "Produto não encontrado.");
        $this->assertEquals($produto['id'], $produtoLido['id']);
    }

    public function testUpdateProduto()
    {
        $produtos = $this->produto->read();
        $this->assertNotEmpty($produtos, "Nenhum produto encontrado para atualização.");

        $produto = reset($produtos);

        $this->produto->id = $produto['id'];
        $this->produto->nome = "Updated Product";
        $this->produto->descricao = "Updated description.";
        $this->produto->preco = 150.00;
        $this->produto->quantidade = 20;
        $this->produto->categoria_id = $produto['categoria_id'];

        $result = $this->produto->update();
        $this->assertTrue($result);
        $updatedProduto = $this->produto->readOne($produto['id']);
        $this->assertEquals("Updated Product", $updatedProduto['nome']);
        $this->assertEquals(150.00, $updatedProduto['preco']);
    }

    public function testDeleteProduto()
    {
        $produtos = $this->produto->read();
        $this->assertNotEmpty($produtos, "Nenhum produto encontrado para exclusão.");
        $produto = reset($produtos);
        $result = $this->produto->delete($produto['id']);
        $this->assertTrue($result);

        $deletedProduto = $this->produto->readOne($produto['id']);
        $this->assertNull($deletedProduto, "Produto não foi excluído corretamente.");
    }
}
