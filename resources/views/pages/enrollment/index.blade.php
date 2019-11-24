@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
   'items' => [
     __('Home') => route('home'),
     'Matriculas' => url()->current()
   ]
 ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">Matriculas</span>

        <div>
          <a href="{{ route('matriculas.create') }}" class="btn btn-primary text-uppercase font-weight-bold">
            <span class="fas fa-plus"/> Cadastrar Matricula
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
          <td>Registro de Matricula</td>
          <td>Numero da Chamada</td>
          <td>Aluno</td>
          <td>Classe</td>
          <td>Tipo de Matricula</td>
          <td>Ações</td>
        </tr>
        </thead>
        <tbody>
        @if($records->count())
          @foreach($records as $record)
            <tr>
              <td>{{ $record['id'] }}</td>
              <td>{{ $record['roll_id'] }}</td>
              <td>{{ $record['user']['name'] }}</td>
              <td>{{ $record['classroom']['description'] }}</td>
              <td>{{ __($record['enrollmentType']['description']) }}</td>
              <td>
                <form action="{{ route('matriculas.destroy', $record) }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button
                    class="btn btn-danger"
                    type="submit"
                    onclick="confirm('Tem certeza que deseja apagar esta matricula ?') || event.preventDefault()">
                    Apagar
                  </button>
                </form>
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
