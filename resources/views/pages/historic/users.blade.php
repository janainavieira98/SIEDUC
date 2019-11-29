@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      'Gerar Boletim: Aluno' => url()->current()
    ]
  ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">Gerar Boletim</span>
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
        <thread>
          <tr>
            <th class="text-uppercase">Aluno</th>
            <th class="text-uppercase">RG</th>
            <th class="text-uppercase">CPF</th>
            <th class="text-uppercase">{{ __('Actions') }}</th>
          </tr>
        </thread>
        <tbody>
        @if($records->count())
          @foreach($records as $record)
            <tr>
              <td>{{ $record['name'] }}</td>
              <td>{{ $record['rg'] }}</td>
              <td>{{ $record['cpf'] }}</td>
              <td>
                <a href="{{ route('reports.historicUser', $record) }}" target="_blank"
                   class="btn btn-success">
                  <span class="fas fa-eye"/> Ver Historico
                </a>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="8">
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
