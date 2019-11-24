@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('register class') => url()->current()
    ]
  ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">{{ __('classroom') }}</span>

        <div>
          <a href="{{ route('classes.create') }}" class="btn btn-primary text-uppercase font-weight-bold">
            <span class="fas fa-plus"/> {{ __('Create :entity', ['entity' => __('classroom')]) }}
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
        @if($classrooms->count())
          @foreach($classrooms as $classroom)
            <tr>
              <td>{{ $classroom['grade'] }}</td>
              <td>{{ $classroom['description'] }}</td>
              <td>{{ $classroom['period']['description'] }}</td>
              <td>{{ $classroom['start_hour'] }} - {{ $classroom['end_hour'] }}</td>
              <td>{{ $classroom['year'] }}</td>
              <td>{{ \Carbon\Carbon::parse($classroom['start_date'])->format('d/m') }}</td>
              <td>{{ \Carbon\Carbon::parse($classroom['end_date'])->format('d/m') }}</td>
              <td>
                <a href="{{ route('classes.show', $classroom) }}" class="btn btn-success">
                  <span class="fas fa-eye"/> {{ __('View') }}
                </a>
                <a href="{{ route('classes.edit', $classroom) }}" class="btn btn-primary">
                  <span class="fas fa-edit"/> {{ __('Edit') }}
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

    {{ $classrooms->appends(request()->query())->links() }}
  @endcomponent
@endsection
