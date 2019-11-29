@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
   'items' => [
     __('Home') => route('home'),
     'Notas e Faltas: Classe' => route('grades.classrooms'),
     'Notas e Faltas: Disciplina' => route('grades.disciplines', [request()->route('classroom')]),
     'Notas e Faltas: Alunos' => url()->current()
   ]
 ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">Notas e Faltas</span>

        <div>
          <a href="{{ route('grades.create', [request()->route('classroom'), request()->route('discipline')]) }}"
             class="btn btn-primary text-uppercase font-weight-bold">
            <span class="fas fa-plus"/> Cadastrar Notas e Faltas
          </a>
        </div>
      </div>
    @endslot

    <form action="{{ url()->current() }}" method="get" class="form-inline mb-3">
      <input
        type="text"
        class="form-control"
        name="search"
        placeholder="{{ __('Type something to search...') }}"
        value="{{ request()->query('search') }}"
      />

      <button class="btn btn-primary ml-2 text-uppercase font-weight-bold">{{ __('search') }}</button>
    </form>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <td>Usuario</td>
          <td>Classe</td>
          <td>Disciplina</td>
          <td>Situação</td>
          <td>Ações</td>
        </tr>
        </thead>
        <tbody>
        @if($records->count())
          @foreach($records as $record)
            <tr>
              <td>{{ $record['user']['name'] }}</td>
              <td>{{ $classroom->description }}</td>
              <td>{{ $discipline->name }}</td>
              <td>{{ $record['approved'] ? 'Aprovado' : 'Reprovado ou Incompleto' }}</td>
              <td>
                <a href="{{ route('grades.edit', [$classroom, $discipline, $record['user']['uuid']]) }}"
                   class="btn btn-success">
                  Editar
                </a>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="6">
              <div class="text-center">
                {{ __('no records found') }}
              </div>
            </td>
          </tr>
        @endif
        </tbody>
      </table>
    </div>

    {{ $records->appends(request()->query())->links() }}
  @endcomponent


@endsection
