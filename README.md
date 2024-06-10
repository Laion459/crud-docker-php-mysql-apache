## Employee CRUD with Docker

This repository contains the source code for an Employee CRUD (Create, Read, Update, Delete) system, developed in PHP with MySQL database and using Docker for an isolated and consistent development environment.

### Introduction

My name is Leonardo Dario Borges and this project is a development test, showcasing my skills in PHP programming and web development.

### Objective

The objective of this project is to develop a complete Employee CRUD, which allows:

* **Create** new employee records, with the fields: name, birthdate, CPF, email, and marital status.
* **Read** all registered employee records.
* **Update** existing employee data.
* **Delete** employee records.

The project also includes validations to ensure data integrity, such as:

* **CPF Validation:** Checks if the provided CPF is valid and unique.
* **Email Validation:** Checks if the provided email is valid and unique.

### Differential

This project utilizes Docker for development, providing the following benefits:

* **Isolated Environment:** Creates an independent development environment from the local system, ensuring consistency and avoiding version conflicts.
* **Easy Configuration:** Simplifies the configuration of the development environment, including the MySQL database and web server.
* **Portability:** Allows the project to be easily transferred to other machines without the need for additional configurations.

### Installation and Execution

1. **Docker Installation:** Download and install Docker on your system ([https://www.docker.com/]).
2. **Clone the repository:** Clone this repository to your local machine.
3. **Build Docker Images:** Open the terminal in the project folder and run the command `docker-compose build`.
4. **Start Docker Services:** Run the command `docker-compose up -d` to start the MySQL and PHP services in the background.
5. **Access the Application:** Open your browser and access the address `http://localhost:8080` to access the CRUD application.

### Project Structure

The project is organized as follows:

* **docker-compose.yml:** Defines the Docker services for MySQL and the PHP server.
* **src:** Folder containing the source code of the PHP application.
* **src/Dockerfile:** Defines the Docker image for the PHP server.
* **src/database:** Folder containing the initialization scripts for the MySQL database.
* **src/index.php:** The main page of the application, listing the employees.
* **src/create.php:** Page to add new employees.
* **src/read.php:** Page to search for employees by CPF or email.
* **src/update.php:** Page to edit employee data.
* **src/delete.php:** PHP file that processes the request to delete an employee.
* **src/employee.php:** PHP class to manage CRUD operations for employees.
* **src/db.php:** PHP class to connect to the MySQL database.
* **src/validate.php:** PHP class to validate CPF and email.

### Files

The project consists of the following files:

* **docker-compose.yml:** Configures Docker services (MySQL and PHP).
* **src/Dockerfile:** Defines the Docker image of the PHP server.
* **src/index.php:** The main page of the application.
* **src/create.php:** Form to add new employees.
* **src/read.php:** Form to search for employees.
* **src/update.php:** Form to edit employee data.
* **src/delete.php:** PHP file that processes the request to delete employees.
* **src/employee.php:** PHP class to manage employees.
* **src/db.php:** PHP class to connect to the MySQL database.
* **src/validate.php:** PHP class to validate CPF and email.

### Observations

* This project is just a simple example of Employee CRUD and can be expanded to meet more complex requirements.

* Valid CPFs so you can test them:
* **168.995.350-09
* **111.444.777-35
* **123.456.789-09
* **987.654.321-00
* **935.411.347-80
* **357.951.852-61
* **111.222.333-96
* **222.333.444-78
* **333.444.555-10
* **444.555.666-88

### Acknowledgement

I appreciate the opportunity to present this project. I hope this test demonstrates my knowledge and skills in web development. 























## CRUD de Funcionários com Docker

Este repositório contém o código fonte para um sistema CRUD (Create, Read, Update, Delete) de funcionários, desenvolvido em PHP com banco de dados MySQL e utilizando Docker para um ambiente de desenvolvimento isolado e consistente.

### Apresentação

Meu nome é Leonardo Dario Borges e este projeto é um teste de desenvolvimento, demonstrando minhas habilidades em programação PHP e desenvolvimento web.

### Objetivo

O objetivo deste projeto é desenvolver um CRUD de funcionários completo, que permita:

* **Criar** novos registros de funcionários, com os campos: nome, data de nascimento, CPF, e-mail e estado civil.
* **Ler** todos os registros de funcionários cadastrados.
* **Atualizar** os dados de funcionários existentes.
* **Deletar** registros de funcionários.

O projeto também inclui validações para garantir a integridade dos dados, como:

* **Validação de CPF:** Verifica se o CPF fornecido é válido e único.
* **Validação de e-mail:** Verifica se o e-mail fornecido é válido e único.

### Diferencial

Este projeto utiliza Docker para o desenvolvimento, proporcionando os seguintes benefícios:

* **Ambiente isolado:** Cria um ambiente de desenvolvimento independente do sistema local, garantindo consistência e evitando conflitos de versões.
* **Facilidade de configuração:** Simplifica a configuração do ambiente de desenvolvimento, incluindo o banco de dados MySQL e o servidor web.
* **Portabilidade:** Permite que o projeto seja facilmente transferido para outras máquinas sem a necessidade de configurações adicionais.

### Instalação e Execução

1. **Instalação do Docker:** Baixe e instale o Docker em seu sistema ([https://www.docker.com/]).
2. **Clone o repositório:** Clone este repositório para sua máquina local.
3. **Construção das imagens Docker:** Abra o terminal na pasta do projeto e execute o comando `docker-compose build`.
4. **Inicialização dos serviços Docker:** Execute o comando `docker-compose up -d` para iniciar os serviços MySQL e PHP em segundo plano.
5. **Acesse o aplicativo:** Abra o navegador e acesse o endereço `http://localhost:8080` para acessar o aplicativo CRUD.

### Estrutura do Projeto

O projeto é organizado da seguinte forma:

* **docker-compose.yml:** Define os serviços Docker para o MySQL e o servidor PHP.
* **src:** Pasta contendo o código fonte do aplicativo PHP.
* **src/Dockerfile:** Define a imagem Docker para o servidor PHP.
* **src/database:** Pasta contendo os scripts de inicialização do banco de dados MySQL.
* **src/index.php:** Página principal do aplicativo, listando os funcionários.
* **src/create.php:** Página para adicionar novos funcionários.
* **src/read.php:** Página para pesquisar funcionários por CPF ou e-mail.
* **src/update.php:** Página para editar dados de funcionários.
* **src/delete.php:** Arquivo PHP que processa a requisição para deletar um funcionário.
* **src/employee.php:** Classe PHP para gerenciar as operações CRUD dos funcionários.
* **src/db.php:** Classe PHP para conectar ao banco de dados MySQL.
* **src/validate.php:** Classe PHP para validar CPF e email.

### Arquivos

O projeto é composto pelos seguintes arquivos:

* **docker-compose.yml:** Configura os serviços Docker (MySQL e PHP).
* **src/Dockerfile:** Define a imagem Docker do servidor PHP.
* **src/index.php:** Página principal do aplicativo.
* **src/create.php:** Formulário para adicionar novos funcionários.
* **src/read.php:** Formulário para pesquisar funcionários.
* **src/update.php:** Formulário para editar dados de funcionários.
* **src/delete.php:** Arquivo PHP que processa a requisição de exclusão de funcionários.
* **src/employee.php:** Classe PHP para gerenciar funcionários.
* **src/db.php:** Classe PHP para conectar ao banco de dados MySQL.
* **src/validate.php:** Classe PHP para validar CPF e email.

### Observações

* Este projeto é apenas um exemplo simples de CRUD de funcionários, e pode ser expandido para atender a requisitos mais complexos.

* CPFs válidos para que você possa testá-los:
* **168.995.350-09
* **111.444.777-35
* **123.456.789-09
* **987.654.321-00
* **935.411.347-80
* **357.951.852-61
* **111.222.333-96
* **222.333.444-78
* **333.444.555-10
* **444.555.666-88

### Agradecimento

Agradeço pela oportunidade de apresentar este projeto. Espero que este teste demonstre meu conhecimento e minhas habilidades em desenvolvimento web.#   c r u d - d o c k e r - p h p - m y s q l - a p a c h e  
 