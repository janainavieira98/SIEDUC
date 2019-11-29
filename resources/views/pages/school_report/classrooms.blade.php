@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      'Gerar Boletim: Classe' => url()->current()
    ]
  ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">Gerar Boletim: Escolher Classe</span>
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
            <th class="text-uppercase">{{ __('grade') }}</th>
            <th class="text-uppercase">{{ __('team') }}</th>
            <th class="text-uppercase">{{ __('period') }}</th>
            <th class="text-uppercase">{{ __('time duration') }}</th>
            <th class="text-uppercase">{{ __('year') }}</th>
            <th class="text-uppercase">{{ __('start date') }}</th>
            <th class="text-uppercase">{{ __('end date') }}</th>
            <th class="text-uppercase">{{ __('Actions') }}</th>
          </tr>
        </thread>
        <tbody>
        @if($records->count())
          @foreach($records as $record)
            <tr>
              <td>{{ $record['grade'] }}</td>
              <td>{{ $record['description'] }}</td>
              <td>{{ $record['period']['description'] }}</td>
              <td>{{ $record['start_hour'] }} - {{ $record['end_hour'] }}</td>
              <td>{{ $record['year'] }}</td>
              <td>{{ \Carbon\Carbon::parse($record['start_date'])->format('d/m') }}</td>
              <td>{{ \Carbon\Carbon::parse($record['end_date'])->format('d/m') }}</td>
              <td>
                <a href="{{ route('reports.schoolReportUsers', $record) }}" class="btn btn-success">
                  <span class="fas fa-eye"/> Ver Usuários
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
