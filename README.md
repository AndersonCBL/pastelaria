<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Projeto Pastelaria</h1>
    <h2>Descrição</h2>
    <p>Projeto de uma API para gerenciamento de uma pastelaria, incluindo funcionalidades para gerenciar clientes, produtos e pedidos.</p>
    <h2>Requisitos</h2>
    <ul>
        <li>Docker</li>
        <li>Docker Compose</li>
    </ul>
    <h2>Configuração do Ambiente</h2>
    <ol>
        <li>Clone o repositório:
            <pre><code>git clone https://github.com/AndersonCBL/pastelaria.git
cd pastelaria
            </code></pre>
        </li>
        <li>Copie o arquivo <code>.env.example</code> para <code>.env</code> e configure as variáveis de ambiente conforme necessário:
            <pre><code>cp .env.example .env
            </code></pre>
        </li>
        <li>Suba os containers Docker:
            <pre><code>docker-compose up -d
            </code></pre>
        </li>
        <li>Instale as dependências do Composer:
            <pre><code>docker-compose exec app composer install
            </code></pre>
        </li>
        <li>Gere a chave da aplicação:
            <pre><code>docker-compose exec app php artisan key:generate
            </code></pre>
        </li>
        <li>Execute as migrations e seeders:
            <pre><code>docker-compose exec app php artisan migrate --seed
            </code></pre>
        </li>
    </ol>
    <h2>Endpoints da API</h2>
    <h3>Clientes</h3>
    <ul>
        <li><strong>Criar Cliente</strong>
            <ul>
                <li>Método: <code>POST</code></li>
                <li>URL: <code>/api/customers</code></li>
                <li>Exemplo de Payload:
                    <pre><code>{
    "name": "João da Silva",
    "email": "joao@example.com",
    "phone": "11999999999",
    "birth_date": "1990-01-01",
    "address": "Rua das Flores, 123",
    "complement": "Apto 45",
    "neighborhood": "Centro",
    "cep": "01000-000"
}
                    </code></pre>
                </li>
            </ul>
        </li>
        <li><strong>Listar Clientes</strong>
            <ul>
                <li>Método: <code>GET</code></li>
                <li>URL: <code>/api/customers</code></li>
            </ul>
        </li>
        <li><strong>Atualizar Cliente</strong>
            <ul>
                <li>Método: <code>PUT</code></li>
                <li>URL: <code>/api/customers/{id}</code></li>
                <li>Exemplo de Payload:
                    <pre><code>{
    "name": "João da Silva Atualizado",
    "email": "joao_atualizado@example.com",
    "phone": "11988888888",
    "birth_date": "1990-01-01",
    "address": "Rua das Flores, 123",
    "complement": "Apto 45",
    "neighborhood": "Centro",
    "cep": "01000-000"
}
                    </code></pre>
                </li>
            </ul>
        </li>
        <li><strong>Excluir Cliente</strong>
            <ul>
                <li>Método: <code>DELETE</code></li>
                <li>URL: <code>/api/customers/{id}</code></li>
            </ul>
        </li>
    </ul>
    <h3>Produtos</h3>
    <ul>
        <li><strong>Criar Produto</strong>
            <ul>
                <li>Método: <code>POST</code></li>
                <li>URL: <code>/api/products</code></li>
                <li>Exemplo de Payload:
                    <ul>
                        <li><code>name</code>: <code>Pastel de Carne</code></li>
                        <li><code>price</code>: <code>10.50</code></li>
                        <li><code>photo</code>: Arquivo de imagem</li>
                        <li><code>product_type_id</code>: ID válido de um tipo de produto</li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><strong>Listar Produtos</strong>
            <ul>
                <li>Método: <code>GET</code></li>
                <li>URL: <code>/api/products</code></li>
            </ul>
        </li>
        <li><strong>Atualizar Produto</strong>
            <ul>
                <li>Método: <code>PUT</code></li>
                <li>URL: <code>/api/products/{id}</code></li>
                <li>Exemplo de Payload:
                    <ul>
                        <li><code>name</code>: <code>Pastel de Queijo Atualizado</code></li>
                        <li><code>price</code>: <code>13.00</code></li>
                        <li><code>photo</code>: Arquivo de imagem</li>
                        <li><code>product_type_id</code>: ID válido de um tipo de produto</li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><strong>Excluir Produto</strong>
            <ul>
                <li>Método: <code>DELETE</code></li>
                <li>URL: <code>/api/products/{id}</code></li>
            </ul>
        </li>
    </ul>
    <h3>Tipos de Produtos</h3>
    <ul>
        <li><strong>Listar Tipos de Produtos</strong>
            <ul>
                <li>Método: <code>GET</code></li>
                <li>URL: <code>/api/product_types</code></li>
            </ul>
        </li>
    </ul>
    <h3>Pedidos</h3>
    <ul>
        <li><strong>Criar Pedido</strong>
            <ul>
                <li>Método: <code>POST</code></li>
                <li>URL: <code>/api/orders</code></li>
                <li>Exemplo de Payload:
                    <pre><code>{
    "customer_id": 1,
    "product_ids": [1, 2]
}
                    </code></pre>
                </li>
            </ul>
        </li>
        <li><strong>Listar Pedidos</strong>
            <ul>
                <li>Método: <code>GET</code></li>
                <li>URL: <code>/api/orders</code></li>
            </ul>
        </li>
        <li><strong>Atualizar Pedido</strong>
            <ul>
                <li>Método: <code>PUT</code></li>
                <li>URL: <code>/api/orders/{id}</code></li>
                <li>Exemplo de Payload:
                    <pre><code>{
    "product_ids": [1, 3]
}
                    </code></pre>
                </li>
            </ul>
        </li>
        <li><strong>Excluir Pedido</strong>
            <ul>
                <li>Método: <code>DELETE</code></li>
                <li>URL: <code>/api/orders/{id}</code></li>
            </ul>
        </li>
    </ul>
    <h2>Testes</h2>
    <p>Para rodar os testes, execute o seguinte comando:</p>
    <pre><code>docker-compose exec app php artisan test
    </code></pre>
    <h2>Acesso ao Mailtrap</h2>
    <p>Para verificar se o pedido chegou no e-mail, siga os passos abaixo:</p>
    <ol>
        <li>Acesse o site do Mailtrap: <a href="https://mailtrap.io">https://mailtrap.io</a></li>
        <li>Faça login com as seguintes credenciais:
            <ul>
                <li><strong>E-mail:</strong> pastelariateste2025@gmail.com</li>
                <li><strong>Senha:</strong> 12345Teste!</li>
            </ul>
        </li>
        <li>Após fazer login, você será redirecionado para o dashboard do Mailtrap.</li>
        <li>No dashboard, clique na caixa de entrada (Inbox) que foi criada para este projeto.</li>
        <li>Você verá uma lista de e-mails recebidos. Clique no e-mail que deseja visualizar para ver os detalhes.</li>
    </ol>
</body>
</html>
