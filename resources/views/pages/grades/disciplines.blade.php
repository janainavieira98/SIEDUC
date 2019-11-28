@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      'Notas e Faltas: Classe' => route('grades.classrooms', request()->route('classroom')),
      'Notas e Faltas: Disciplina' => url()->current()
    ]
  ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">Escolher Disciplina</span>
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
            <th class="text-uppercase">{{ __('code') }}</th>
            <th class="text-uppercase">{{ __('name') }}</th>
            <th class="text-uppercase">{{ __('timeload') }}</th>
            <th class="text-uppercase">{{ __('Actions') }}</th>
          </tr>
        </thread>
        <tbody>
        @if($records->count())
          @foreach($records as $record)
            <tr>
              <td>{{ $record['code'] }}</td>
              <td>{{ $record['name'] }}</td>
              <td>{{ $record['timeload'] }} horas</td>
              <td>
                <a href="{{ route('grades.grades', [request()->route('classroom'), $record]) }}"
                   class="btn btn-success">
                  <span class="fas fa-eye"/> Visualizar Notas e Faltas
                </a>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="4">
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
