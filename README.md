# Projeto 2 - Web-Servidor

Repositório referente à entrega do projeto 1 da disciplina web-servidor UTFPR utilizando PHP

## Integrantes

- Igor Eduardo da Silva

&#9745; Criar validação de login</br>
&#9745; Criar página de avião </br>
&#9745; Criar página de relatório de vendas </br>
&#9745; Recriado controle de rotas utilizando Pecee SimpleRouter </br>

- Murilo Vozniaki Correia

&#9745; Inicialização de arquitetura MVC</br>
&#9745; Criar entidades</br>
&#9745; Criar página de vôo</br>
&#9745; Criar página controle de ocupações</br>
&#9745; Refatoração do banco de dados</br>

- Gabriel Augusto do Nascimento

&#9745; Criar página de tickets</br>
&#9745; Criar página home</br>
&#9745; Definir padrão de UI</br>
&#9745; Estilização do projeto</br>


## Instalação e uso do projeto

### Ferramentas necessárias

- PHP 8+
- MySql 8.3.0
- Composer

### Realizando restauração do banco de dados


Acessar o MySQL

```bash
  mysql -u root -p
```
Criar banco de dados x-airlines

```sql
  CREATE DATABASE `x-airlines`;
```

Alterar usuário e senha do banco de dados em infra/ConnectionDB

Restaurar banco de dados

```bash
  mysql -u root -p x-airlines < /infra/dump-x-airlines-202411011534.sql;
```

### Instalando dependências

Realizar a instalação das dependências usando o Composer

```bash
  composer install
```

Criar as arquivos do autoload
```bash
  composer dump-autoload
```

### Iniciando PHP

Iniciar servidor do PHP rodando em localhost na porta 8080(sugestão)
```bash
  php -S localhost:8080
```