# Projeto 1 - Web-Servidor

Repositório referente à entrega do projeto 1 da disciplina web-servidor UTFPR utilizando PHP

## Integrantes

- Igor Eduardo da Silva

&#9745; Criar validação de login</br>
&#9745; Criar página de avião </br>
&#9744; Criar mock de avião

- Murilo Vozniaki Correia

&#9745; Inicialização de arquitetura MVC</br>
&#9745; Criar entidades</br>
&#9744; Criar página de vôo</br>
&#9744; Criar mock de vôos

- Gabriel Augusto do Nascimento

&#9745; Criar página de tickets</br>
&#9745; Criar mock de tickets</br>
&#9745; Criar página home</br>
&#9745; Definir padrão de UI


## Instalação e uso do projeto

### Ferramentas necessárias

- PHP 8+
- MySql 8.3.0

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

```bash
  mysql -u root -p x-airlines < /infra/mock/dump-x-airlines-202411011534.sql;
```

