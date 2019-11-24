@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
   'items' => [
     __('Home') => route('home'),
     __('Create :entity', ['entity' => __('Discipline')]) => route('disciplinas.index'),
     __('link disciplines') => url()->current()
   ]
 ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">{{ __('link disciplines') }}</span>

        <div>
          <a href="{{ route('vincular-disciplinas.create') }}" class="btn btn-primary text-uppercase font-weight-bold">
            <span class="fas fa-plus"/> {{ __('Create :entity', ['entity' => __('link')]) }}
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
        <thread>
          <tr>
            <td>{{ __('teacher') }}</td>
            <td>{{ __('Discipline') }}</td>
            <td>{{ __('Classroom') }}</td>
            <td>Dia</td>
            <td>Hora</td>
          </tr>
        </thread>
        <tbody>
        @if($records->count())
          @foreach($records as $record)
            <tr>
              <td>{{ $record->user->name }}</td>
              <td>{{ $record->discipline->name }}</td>
              <td>{{ $record->classroom->description }}</td>
              <td>{{ ucfirst($record->weekday->description) }}</td>
              <td>{{ $record->hour }}</td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="3">
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
