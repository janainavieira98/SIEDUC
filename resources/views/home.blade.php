@extends('layouts.page')

@section('page_content')
  @component('components.card')
    @slot('header')
      Bem Vindo
    @endslot

    Olá, seja bem vindo ao sistema
  @endcomponent
@endsection
