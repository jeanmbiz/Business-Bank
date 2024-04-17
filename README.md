# Business Bank

#### Trata-se de um Back-end que simula uma instituição financeira, com diversas regras de negócio, podendo criar contas de usuário e admin, fazer depósito, transferência de valores, entre outras funcionalidades.

#### Deploy está diponível no render até dia 02/04/2024, baixe o arquivo insomnia para utilizar as rotas:
[Arquivo Insomnia](/public/files/Insomnia_2024-03-02.json)

## Diagrama do Projeto

![diagrama](/public/files/diagram.png)

## Regras de Negócio:

#### Usuários

-   É possível criar usuários comuns e administradores, com validações de informações;

#### Login

-   Ao realizar o login é validado se credenciais estão corretas e se usuário está ativo na plataforma;

#### Rotas Usuários Administradores

-   Listar todos os usuários da plataforma, com acesso a todos os dados;
-   Excluir qualquer usuário da plataforma;
-   Estornar/Excluir depósito;
-   Estornar/Excluir Transferência;

#### Rotas Usuários Logados

-   Fazer transferência
-   Verificar seu saldo;
-   Extrato de todas as suas transações;
-   Editar dados do próprio usuário;
-   Deletar o próprio usuário;

#### Rotas Usuários Anônimos (Não autenticados)
-   Fazer depósito para qualquér usuário da plataforma através do cpf;

## Instalação

### Para executar o projeto localmente, siga as etapas abaixo:

#### 1.1 Clone o repositório:

```
git clone git@github.com:jeanmbiz/Business-Bank.git
```

#### 1.2 Acesse o diretório do projeto:

#### 1.3 Execute o Docker Compose para construir e iniciar os contêineres:

```
docker-compose up -d
```

#### 1.4 Acesse o shell do container, para instalar as dependências do Laravel:

```
composer install
```

#### 1.5 Configure o banco de dados criando arquivo .env com base no arquivo .env.example:

#### 1.6 Executar as migrações do Laravel no Shell:

```
php artisan migrate
```

## Bibliotecas e Frameworks utilizados

-   Laravel Framework 10.10
-   Tymon JWT Auth
-   Laravel Sail
-   Spatie Laravel Ignition
-   Laravel Sanctum
-   Docker Compose
