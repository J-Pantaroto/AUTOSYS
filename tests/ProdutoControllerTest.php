<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\ProdutoController;
use App\Models\Produto;

class ProdutoControllerTest extends TestCase
{
    protected $produtoController;

    protected function setUp(): void
    {
        $this->produtoController = new ProdutoController();
    }

    /** @test */
    public function testCreateProduto()
    {
        $_POST = [
            'nome' => 'Produto Teste',
            'descricao' => 'descricao teste',
            'preco' => 99.99,
            'quantidade' => 10,
            'categoria' => 1
        ];

        $output = $this->produtoController->create();
        $this->assertStringContainsString('Produto criado com sucesso', $output);
    }

    /** @test */
    public function testReadAllProdutos()
    {
        $output = $this->produtoController->read();
        $this->assertIsArray(json_decode($output, true));
    }

    /** @test */
    public function testReadOneProduto()
    {
        $produtoMock = $this->createMock(Produto::class);
        $produtoMock->method('readOne')->willReturn([
            'id' => 1,
            'nome' => 'Produto Teste',
            'descricao' => 'produto teste',
            'preco' => 99.99,
            'quantidade' => 10,
            'categoria' => 1
        ]);

        $output = $this->produtoController->readOne(1);
        $produtoData = json_decode($output, true);

        $this->assertEquals('Produto Teste', $produtoData['nome']);
        $this->assertEquals(99.99, $produtoData['preco']);
    }

    /** @test */
    public function testUpdateProduto()
    {
        $_POST = [
            'nome' => 'Produto att',
            'descricao' => 'desc atualizada',
            'preco' => 199.99,
            'quantidade' => 5,
            'categoria' => 2
        ];

        $produtoMock = $this->createMock(Produto::class);
        $produtoMock->method('update')->willReturn(true);

        $output = $this->produtoController->update(1);
        $this->assertStringContainsString('Produto atualizado com sucesso', $output);
    }

    /** @test */
    public function testDeleteProduto()
    {
        $produtoMock = $this->createMock(Produto::class);
        $produtoMock->method('delete')->willReturn(true);
        
        $output = $this->produtoController->delete(1);
        $this->assertStringContainsString('Produto excluído com sucesso', $output);
    }
}
