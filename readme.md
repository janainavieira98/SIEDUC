# Instruções de Instalação

## Copiar arquivo .env

\* windows

`copy .env.example .env`

\* linux

`cp .env.example .env`

### Preencha o arquivo .env com as informações sobre banco de dados e sobre o usuario administrador

Instalar dependencias do projeto

`composer install`

Criar chave secreta da aplicação

`php artisan key:generate`

Rodar migrations pra criar o banco de dados

`php artisan migrate`

Criar usuário administrador (preencha as informações no .env)

`php artisan create-admin`


Detalhes:
- As configurações de envio de email devem ser feitas antes de criar qualquer usuário no sistema 
pois estes dependem do envio de email de confirmação, e também a redefinição de senha depende do envio de emails
- Não deve-se executar o comando `php artisan migrate:fresh` em um banco de produção então por favor tome cuidado
- O sistema utiliza estilos criados com `sass` que depois são compilados pra `css`, para isso é necessario instalar o `node.js`
e executar os comandos `npm install` e `npm run production` para gerar o css final
