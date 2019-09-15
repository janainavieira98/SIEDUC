@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('users') => route('usuarios.index')
    ]
  ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">{{ __('users') }}</span>

        <div>
          <a href="{{ route('usuarios.create') }}" class="btn btn-primary text-uppercase font-weight-bold">
            <span class="fas fa-plus"/> {{ __('new user') }}
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
          <tr class="text-uppercase">
            <th>{{ __('name') }}</th>
            <th>{{ __('email') }}</th>
            <th>{{ __('cpf') }}</th>
            <th>{{ __('Actions') }}</th>
          </tr>
        </thread>
        <tbody>
        @if($users->count())
          @foreach($users as $user)
            <tr>
              <td>{{ $user['name'] }}</td>
              <td>{{ $user['email'] }}</td>
              <td>{{ $user['cpf'] }}</td>
              <td>
                <a href="{{ route('usuarios.show', $user) }}" class="btn btn-success">
                  <span class="fas fa-eye"/> {{ __('View') }}
                </a>
                <a href="{{ route('usuarios.edit', $user) }}" class="btn btn-primary">
                  <span class="fas fa-edit"/> {{ __('Edit') }}
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

    <div class="text-center">
      {{ $users->appends(request()->query())->links() }}
    </div>
  @endcomponent
@endsection
