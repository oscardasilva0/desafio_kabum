Projeto CRUD de Endereços

Informações de Login

    Usuário único: oscar@email.com
    Senha: a1234567

Descrição

Este projeto é um CRUD completo para gerenciar endereços, utilizando PHP 8.2, MySQL 8.0.36 e o template SB Admin 2 da StartBootstrap.

Etapas do Projeto

1. Front-End

    Template utilizado: SB Admin 2 da StartBootstrap (https://startbootstrap.com/templates/admin-dashboard)

2. Back-End

    Linguagem: PHP 8.2
    Banco de dados: MySQL 8.0.36-0ubuntu0.20.04.1 (estrutura no arquivo db/arquivo.sql)
    Funcionalidades CRUD (Create, Read, Update, Delete) para endereços implementadas.
    Validação de entrada para garantir a segurança e integridade dos dados.

3. Integração

    Integração do front-end com o back-end para permitir interação com a API e o banco de dados.

4. Servidor

    Configuração do Nginx (arquivo conf.nginx).

Documentação da API CRUD de Endereços

Projeto

API CRUD para gerenciar endereços, implementada em PHP 8.2.

Recursos

A API disponibiliza recursos para gerenciamento de clientes e seus endereços:

Clientes:

    Listar todos os clientes.
    Obter um cliente específico por ID.
    Inserir um novo cliente.
    Editar um cliente existente.
    Deletar um cliente.

Endereços:

    Listar todos os endereços.
    Obter um endereços específico por ID.
    Inserir um novo endereços.
    Editar um endereços existente.
    Deletar um endereços.



Endereços de API
Rota	Método	Descrição
/auth/login	POST	Autentica um usuário e retorna um token de acesso.
/clientes	GET	Lista todos os clientes.
/clientes/{id}	GET	Obter um cliente específico por ID.
/clientes	POST	Inserir um novo cliente.
/clientes/{id}	PUT	Editar um cliente existente.
/clientes/{id}	DELETE	Deletar um cliente.
/enderecos/{cliente_id}	GET	Lista todos os endereços de um cliente.
/enderecos/{cliente_id}/{id}	GET	Obter um endereço específico por ID.
/enderecos/{cliente_id}	POST	Inserir um novo endereço para um cliente.
/enderecos/{cliente_id}/{id}	PUT	Editar um endereço existente.
/enderecos/{cliente_id}/{id}	DELETE	Deletar um endereço.
