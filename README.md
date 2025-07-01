# 🚀 API Desafio Backend

API RESTful para gerenciamento de clientes, produtos e favoritos, desenvolvida com Laravel e arquitetura modular.

### O porque de algumas escolhas:
##### Estrutura simples apenas com casos de uso
 A principal ideia é adotar uma abordagem simples para implementar e manter o código, especialmente no contexto de um microsserviço que atenda aos requisitos solicitados. Já trabalhei em projetos complexos nos quais o uso inadequado e excessivo de repositórios, serviços e outras camadas trouxe, a longo prazo, uma enorme complexidade ao código e dificuldades de manutenção, devido ao acoplamento indevido entre as estruturas. Como um dos objetivos era garantir escalabilidade, a proposta de simplificar tanto a arquitetura quanto a manutenção, facilitando especialmente o trabalho de desenvolvedores menos experientes se mostrou muito atraente.

##### Modularidade até certo ponto
Como o projeto tem uma estrutura simples, e os requisitos solicitaram escala foi focado em seguir uma direção mais modular separando o contexto de cada dominio da aplicação, por mais que elas se cruzem em algumas etapas como em **Favoritos** que utilizam produtos e clientes. Aqui foi seguido um conceito mais parecido com o DDD, dado o tamanho do projeto e minha ideia inicial de não complexidade não segui a risca o DDD como um todo.

##### Autenticação e autorização
Decidi usar aqui na verdade algo para mostrar que há no projeto, dado o tamanho do projeto e pensando que seria usado num cenário de microsserviços há N maneiras de criarmos a autenticação e autorização. O porque não considerei o Cliente como sendo um usuário: Foi uma decisão que norteou o desenvolvimento do começo ao fim, imaginando um cenário onde este serviço se conecta com outros não vejo a necessidade de ele possuir para cada cliente uma autenticação. Outro serviço ficaria responsável por controlar isso, para evitar que cada serviço tenha seus próprios métodos de autenticação e etc. Então segui para demonstrar utilizando o **Sanctum**, imaginando que cada serviço tenha seu "usuário" com suas permissões para acessar este serviço de Favoritagem.

## 📋 Índice
- [Sobre o Projeto](#sobre-o-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Arquitetura](#arquitetura)
- [Funcionalidades](#funcionalidades)
- [Instalação e Configuração](#instalação-e-configuração)
- [Uso da API](#uso-da-api)
- [Documentação](#Documentação)
- [Testes](#testes)
- [Estrutura do Projeto](#estrutura-do-projeto)

## 🎯 Sobre o Projeto

Esta API foi desenvolvida como parte de um desafio técnico, implementando um sistema completo de gerenciamento com:

- **Autenticação e Autorização**: Sistema de usuários com permissões granulares
- **Gestão de Clientes**: CRUD completo para clientes
- **Produtos**: Integração com API externa para listagem e busca de produtos
- **Favoritos**: Sistema de favoritos por cliente
- **Arquitetura Modular**: Organização em módulos independentes

## 🛠 Tecnologias Utilizadas

### Backend
- **PHP 8.2+** - Linguagem principal
- **Laravel 12** - Framework PHP
- **Laravel Octane** - Servidor de alta performance com Swoole
- **Laravel Sanctum** - Autenticação via tokens
- **PostgreSQL** - Banco de dados principal
- **Redis** - Cache e sessões

### Infraestrutura
- **Docker & Docker Compose** - Containerização

### Desenvolvimento
- **PHPUnit** - Testes automatizados
- **OpenAPI/Swagger** - Documentação da API

## 🏗 Arquitetura

O projeto segue uma arquitetura modular organizada em módulos independentes:

```
core/
├── Auth/          # Autenticação e autorização
├── Customers/     # Gestão de clientes
├── Products/      # Integração com produtos
├── Favorites/     # Sistema de favoritos
└── Shared/        # Componentes compartilhados
```

Cada módulo contém:
- **Controllers** - Controladores da API
- **Cases** - Lógica de negócio
- **Payloads** - DTOs de entrada/saída
- **Tests** - Testes unitários
- **Exceptions** - Tratamento de erros

## ⚡ Funcionalidades

### 🔐 Autenticação e Autorização
- Criação de usuários com permissões específicas
- Autenticação via token Sanctum
- Sistema de permissões granulares (13 permissões disponíveis)
- Middleware de verificação de acesso

### 👥 Gestão de Clientes
- **CRUD Completo**: Criar, listar, atualizar e deletar clientes
- **Soft Delete**: Exclusão lógica com recuperação
- **Validação**: Validação robusta de dados
- **Testes**: Cobertura completa de testes

### 📦 Produtos
- **Listagem**: Busca paginada de produtos
- **Detalhes**: Informações detalhadas por produto
- **Integração Externa**: Comunicação com API de produtos
- **Cache**: Otimização de performance

### ❤️ Favoritos
- **Adicionar/Remover**: Gerenciamento de favoritos por cliente
- **Listagem**: Favoritos paginados por cliente
- **Verificação**: Verificação de existência de favoritos
- **Integração**: Conecta clientes com produtos externos

## 🚀 Instalação e Configuração

### Pré-requisitos
- Docker e Docker Compose

### 2. Configure o ambiente
```bash
cp env.example .env
```

### 3. Inicie os containers
```bash
docker-compose up -d
docker compose exec -it -u user php bash
```

### 4. Configure o projeto
```bash
composer install
art key:generate
art migrate
```

## 📖 Uso da API

### Autenticação

A API utiliza dois tipos de autenticação:

1. **Bearer Token** - Para operações autenticadas
2. **API Token** (X-API-TOKEN) - Para operações base

### Endpoints Principais

#### Autenticação
```http
POST /api/auth/create_user
POST /api/auth/authenticate
```

#### Clientes
```http
GET    /api/customers
POST   /api/customers
GET    /api/customers/{id}
PUT    /api/customers/{id}
DELETE /api/customers/{id}
```

#### Produtos
```http
GET /api/products
GET /api/products/{id}
```

#### Favoritos
```http
GET    /api/favorites
POST   /api/favorites
DELETE /api/favorites/{id}
GET    /api/favorites/check/{productId}
```

### Exemplo de Uso

#### 1. Criar Usuário
```bash
curl -X POST http://localhost/api/auth/create_user \
  -H "Content-Type: application/json" \
  -H "X-API-TOKEN: your-api-token" \
  -d '{
    "name": "João Silva",
    "email": "joao@example.com",
    "accesses": [
      "customers.show",
      "customers.store",
      "customers.update",
      "customers.delete",
      "favorites.index",
      "favorites.store",
      "favorites.delete",
      "products.index",
      "products.show"
    ]
  }'
```

#### 2. Autenticar e Gerar Token
```bash
curl -X POST http://localhost/api/auth/authenticate \
  -H "Content-Type: application/json" \
  -H "X-API-TOKEN: your-api-token" \
  -d '{
    "email": "joao@example.com"
  }'
```

#### 3. Usar Token para Operações Autenticadas
```bash
# Listar produtos
curl -X GET http://localhost/api/products \
  -H "Authorization: Bearer 1|abc123def456ghi789..."

# Criar cliente
curl -X POST http://localhost/api/customers \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer 1|abc123def456ghi789..." \
  -d '{
    "name": "Maria Santos",
    "email": "maria@example.com",
  }'

# Adicionar favorito
curl -X POST http://localhost/api/favorites \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer 1|abc123def456ghi789..." \
  -d '{
    "product_id": 123,
    "customer_id": 1
  }'
```

### Permissões Disponíveis

O sistema possui as seguintes permissões que podem ser atribuídas aos usuários:

- **Usuários**: `users.show`, `users.store`
- **Clientes**: `customers.show`, `customers.store`, `customers.update`, `customers.delete`
- **Favoritos**: `favorites.index`, `favorites.show`, `favorites.store`, `favorites.update`, `favorites.delete`
- **Produtos**: `products.index`, `products.show`

## 📚 Documentação

### OpenAPI/Swagger
A documentação completa da API está disponível em:
- **Swagger UI**: redoc-static.html
- **OpenAPI Spec**: `docs.openapi.yml`

### Diagrama do Banco de Dados
- **DBML**: `database.dbml`
- **Visualização**: `DBML.png`

## 🧪 Testes

### Executar todos os testes
```bash
docker-compose exec php composer test
```

### Executar testes específicos
```bash
docker-compose exec php php artisan test --filter=CustomerTest
```

### Cobertura de Testes
O projeto inclui testes para:
- ✅ Criação de usuários
- ✅ Gestão de clientes (CRUD completo)
- ✅ Sistema de favoritos
- ✅ Integração com produtos
- ✅ Validações e exceções

## 📁 Estrutura do Projeto

```
desafio-Backend/
├── app/                    # Models e configurações Laravel
├── core/                   # Módulos da aplicação
│   ├── Auth/              # Autenticação
│   ├── Customers/         # Gestão de clientes
│   ├── Products/          # Integração de produtos
│   ├── Favorites/         # Sistema de favoritos
│   └── Shared/            # Componentes compartilhados
├── database/              # Migrações, seeders e factories
├── docker/                # Configurações Docker
├── docs.openapi.yml       # Documentação OpenAPI
├── database.dbml          # Esquema do banco
└── docker-compose.yaml    # Orquestração de containers
```

### Desenvolvimento
```bash
# Iniciar ambiente de desenvolvimento
docker-compose up -d

# Acessar container PHP
docker-compose exec -it -u user php bash

# Executar migrations
docker-compose exec php php artisan migrate


```
