<?php

use PHPUnit\Framework\TestCase;
use App\Models\Cliente;

class ClienteTest extends TestCase
{
    protected $cliente;

    protected function setUp(): void
    {
        \App\Config\EnvLoader::load(__DIR__ . '/../../app/config/.env');

        $this->cliente = new Cliente();

        $clienteExistente = $this->cliente->findByEmail("test@example.com");
        if ($clienteExistente) {
            $this->cliente->delete($clienteExistente['id']);
        }

        $this->cliente->nome = "Test User";
        $this->cliente->email = "test@example.com";
        $this->cliente->senha_hash = password_hash("password", PASSWORD_DEFAULT);
        $this->cliente->telefone = "123456789";
        $this->cliente->endereco = "Test Address";
        $this->cliente->is_admin = false;

        $this->cliente->create();
    }

    public function testCreateCliente()
    {
        $novoCliente = new Cliente();
        $novoCliente->nome = "Another User";
        $novoCliente->email = "another@example.com";
        $novoCliente->senha_hash = password_hash("password", PASSWORD_DEFAULT);
        $novoCliente->telefone = "987654321";
        $novoCliente->endereco = "Another Address";
        $novoCliente->is_admin = false;

        $result = $novoCliente->create();
        $this->assertTrue($result);
    }

    public function testFindClienteByEmail()
    {
        $cliente = $this->cliente->findByEmail("test@example.com");

        $this->assertNotNull($cliente, "Cliente não encontrado.");
        $this->assertEquals("test@example.com", $cliente['email']);
    }

    public function testUpdateCliente()
    {
        $cliente = $this->cliente->findByEmail("test@example.com");
        $this->assertNotNull($cliente, "Cliente não encontrado para atualização.");

        $this->cliente->id = $cliente['id'];
        $this->cliente->nome = "Updated Name";
        $this->cliente->email = "updated@example.com";
        $this->cliente->senha_hash = password_hash("newpassword", PASSWORD_DEFAULT);
        $this->cliente->telefone = "111111111";
        $this->cliente->endereco = "Updated Address";

        $result = $this->cliente->update();
        $this->assertTrue($result);
        $updatedCliente = $this->cliente->readOne($cliente['id']);
        $this->assertEquals("Updated Name", $updatedCliente['nome']);
        $this->assertEquals("updated@example.com", $updatedCliente['email']);
    }

    public function testDeleteCliente()
    {
        $cliente = $this->cliente->findByEmail("test@example.com");
        $this->assertNotNull($cliente, "Cliente não encontrado para exclusão.");

        $result = $this->cliente->delete($cliente['id']);
        $this->assertTrue($result);
        $deletedCliente = $this->cliente->findByEmail("test@example.com");
        $this->assertNull($deletedCliente, "Cliente não foi excluído corretamente.");
    }

    public function testReadClientes()
    {
        $clientes = $this->cliente->read();
        $this->assertNotEmpty($clientes, "Nenhum cliente encontrado na leitura.");
    }
}
