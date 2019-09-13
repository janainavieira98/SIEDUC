@component('mail::message')
# Ola, seja bem vindo

O SiEduc é um sistema de gestão acadêmica que veio pra facilitar a sua vida.

Abaixo está o link para fazer login na sua conta

consulte a secretaria para saber qual a senha utilizada no cadastro.

@component('mail::button', ['url' => route('login')])
  Acessar Painel
@endcomponent

Bom, estamos ansiosos para começar, espero te ver de novo em breve

Atensiosamente,<br>
{{ config('app.name') }}
@endcomponent
