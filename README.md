# AUTOSYS

Projeto para Desenvolvimento Web P2

**AUTOSYS** é um sistema web desenvolvido para empresas de autopeças automotivas. O sistema permite que usuários visualizem os produtos disponíveis e, ao se registrarem, façam pedidos de compra. Administradores têm o controle total para gerenciar produtos e usuários, incluindo funções de cadastro, edição, visualização e exclusão de itens e contas de usuário.

## Objetivos do Projeto
O projeto visa facilitar a gestão de produtos e clientes de distribuidores de autopeças automotivas. Principais funcionalidades:

- **Usuários Cadastrados**: Acesso ao catálogo e possibilidade de fazer pedidos, edição de informações e exclusão de contas.
- **Administração de Produtos e Clientes**: O administrador pode gerenciar completamente o cadastro, visualização, edição e exclusão de produtos e usuários.

### Público-Alvo
Distribuidores de autopeças, mecânicas e consumidores em geral interessados em comprar autopeças automotivas.

## Tecnologias Utilizadas
- **Frontend**: Bootstrap
- **Backend**: PHP, PHPUnit
- **Banco de Dados**: MySQL
- **Bibliotecas**: SweetAlert
- **Gerenciador de Dependências**: Composer
- **Linguagens**: PHP, JavaScript

## Diagrama ER
<img src="Diagrama AUTOSYS.png" alt="Diagrama ER">
## Estrutura de Rotas
O projeto utiliza um sistema de roteamento centralizado no arquivo `Router.php`, com definições de rotas GET e POST. Abaixo está a documentação de cada rota disponível.

---

## Endpoints e Rotas do AUTOSYS

### Estrutura Geral das Rotas

| Método | Endpoint                    | Controlador e Método              | Descrição                                                 |
|--------|------------------------------|-----------------------------------|-----------------------------------------------------------|
| `GET`  | `/` ou `/home`              | `HomeController::index`           | Página inicial do site                                    |
| `GET`  | `/clientes`                 | `ClienteController::index`        | Exibe lista de clientes                                   |
| `GET`  | `/produtos`                 | `ProdutoController::index`        | Exibe lista de produtos                                   |
| `GET`  | `/vendas`                   | `VendaController::index`          | Exibe lista de vendas                                     |
| `GET`  | `/produtos/json`            | `ProdutoController::json`         | Exibe lista de produtos no formato JSON                   |
| `GET`  | `/vendas/json`              | `VendaController::json`           | Exibe lista de vendas no formato JSON                     |
| `GET`  | `/clientes/json`            | `ClienteController::json`         | Exibe lista de clientes no formato JSON                   |
| `GET`  | `/vendas/create`            | `VendaController::showCreateForm` | Exibe formulário para cadastrar venda                     |
| `GET`  | `/produtos/create`          | `ProdutoController::showCreateForm` | Exibe formulário para cadastrar produto                   |
| `GET`  | `/clientes/create`          | `ClienteController::showCreateForm` | Exibe formulário para cadastrar cliente                   |
| `GET`  | `/clientes/edit/{id}`       | `ClienteController::showEditForm` | Exibe formulário de edição de um cliente                  |
| `GET`  | `/produtos/edit/{id}`       | `ProdutoController::showEditForm` | Exibe formulário de edição de um produto                  |
| `GET`  | `/vendas/edit{id}`          | `VendaController::showEditForm`   | Exibe formulário de edição de uma venda                   |
| `POST` | `/clientes/update/{id}`     | `ClienteController::update`       | Atualiza informações de um cliente                        |
| `POST` | `/clientes/delete/{id}`     | `ClienteController::delete`       | Exclui um cliente                                         |
| `POST` | `/clientes/store`           | `ClienteController::create`       | Salva um novo cliente                                     |
| `POST` | `/produtos/store`           | `ProdutoController::create`       | Salva um novo produto                                     |
| `POST` | `/produtos/update/{id}`     | `ProdutoController::update`       | Atualiza informações de um produto                        |
| `POST` | `/produtos/delete/{id}`     | `ProdutoController::delete`       | Exclui um produto                                         |
| `POST` | `/vendas/store`             | `VendaController::create`         | Salva uma nova venda                                      |
| `POST` | `/vendas/update/{id}`       | `VendaController::update`         | Atualiza informações de uma venda                         |
| `POST` | `/vendas/delete/{id}`       | `VendaController::delete`         | Exclui uma venda                                          |                                |

## API Endpoints - ProdutoController e ClienteController

Esta seção detalha a configuração e uso dos endpoints relacionados aos recursos de produtos e clientes no sistema AUTOSYS.

### ProdutoController

Controlador responsável pelo gerenciamento dos produtos. Abaixo estão os endpoints disponíveis:

#### 1. Criar Produto

- **URL**: `/produtos/create`
- **Método HTTP**: `POST`
- **Parâmetros**:
  - `nome` (string): Nome do produto
  - `descricao` (string): Descrição detalhada do produto
  - `preco` (float): Preço do produto
  - `quantidade` (int): Quantidade em estoque
  - `categoria` (string): Categoria do produto
- **Exemplo de Requisição**:
  ```json
  {
    "nome": "Filtro de Óleo",
    "descricao": "Filtro de óleo para motores 1.6",
    "preco": 29.99,
    "quantidade": 50,
    "categoria": "Filtros"
  }
# API de Produtos

## Endpoints

### 1. Criação de Produto
- **Método HTTP:** POST
- **URL:** `/produtos`
- **Parâmetros:** Dados do produto a ser criado (como `nome`, `descricao`, `preco`, `quantidade`, `categoria`)
- **Resposta:** Confirmação de criação do produto.

---

### 2. Listar Produtos
- **Método HTTP:** GET
- **URL:** `/produtos`
- **Parâmetros:** Nenhum
- **Resposta:** Array de produtos com suas propriedades:
  - `id`: ID do produto
  - `nome`: Nome do produto
  - `descricao`: Descrição do produto
  - `preco`: Preço do produto
  - `quantidade`: Quantidade disponível
  - `categoria`: Categoria do produto

---

### 3. Obter Produto Específico
- **Método HTTP:** GET
- **URL:** `/produtos/{id}`
- **Parâmetros:**
  - `id` (int): ID do produto desejado
- **Resposta:** Dados do produto solicitado.

---

## 4. Atualizar Produto

**Método HTTP:** `POST`  
**URL:** `/produtos/update`

### Parâmetros:
- **id** (int): ID do produto a ser atualizado.
- **dados** (objeto): Informações a serem atualizadas no produto.

### Resposta:
- **Confirmação de atualização.**

---

## 5. Excluir Produto

**Método HTTP:** `POST`  
**URL:** `/produtos/delete`

### Parâmetros:
- **id** (int): ID do produto a ser excluído.

### Resposta:
- **Confirmação de exclusão do produto.**

## By Pantaroto ##