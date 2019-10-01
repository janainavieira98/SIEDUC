@extends('pages.user.index', [
  'edit_route' => 'alunos.edit',
  'view_route' => 'alunos.show'
])

@section('new_link')
  <a href="{{ route('alunos.create') }}" class="btn btn-primary text-uppercase font-weight-bold">
    <span class="fas fa-plus"/> {{ $new_label ?? __('New :entity', ['entity' => __('user')]) }}
  </a>
@endsection
