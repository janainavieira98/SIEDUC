@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('Disciplines') => url()->current()
    ]
  ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">{{ __('disciplines') }}</span>

        <div>
          <a href="{{ route('disciplinas.create') }}" class="btn btn-primary text-uppercase font-weight-bold">
            <span class="fas fa-plus"/> {{ __('Create :entity', ['entity' => __('Discipline')]) }}
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
            <th class="text-uppercase">{{ __('code') }}</th>
            <th class="text-uppercase">{{ __('name') }}</th>
            <th class="text-uppercase">{{ __('Actions') }}</th>
          </tr>
        </thread>
        <tbody>
        @if($disciplines->count())
          @foreach($disciplines as $discipline)
            <tr>
              <td>{{ $discipline['code'] }}</td>
              <td>{{ $discipline['name'] }}</td>
              <td>
                <a href="{{ route('disciplinas.show', $discipline) }}" class="btn btn-success">
                  <span class="fas fa-eye"/> {{ __('View') }}
                </a>
                <a href="{{ route('disciplinas.edit', $discipline) }}" class="btn btn-primary">
                  <span class="fas fa-edit"/> {{ __('Edit') }}
                </a>
              </td>
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

    {{ $disciplines->appends(request()->query())->links() }}
  @endcomponent
@endsection
