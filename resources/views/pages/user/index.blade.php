@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      $page_title ?? __('users') => url()->current()
    ]
  ])

  @component('components.card')
    @slot('header')
      <div
        class="d-flex flex-column flex-md-row justify-content-center justify-content-between align-items-center align-items-md-baseline">
        <span class="text-capitalize mb-2 mb-md-0">{{ $page_title ?? __('users') }}</span>

        <div>
          @hasSection('new_link')
            @yield('new_link')
          @else
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary text-uppercase font-weight-bold">
              <span class="fas fa-plus"/> {{ $new_label ?? __('New :entity', ['entity' => __('user')]) }}
            </a>
          @endif
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
            <th>{{ __('status') }}</th>
            <th>{{ __('role') }}</th>
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
              <td>{{ __($user['status'] ? 'active' : 'inactive') }}</td>
              <td class="text-capitalize">{{ __($user['role']['name']) }}</td>
              <td>
                <a href="{{ route($view_route ?? 'usuarios.show', $user) }}" class="btn btn-success">
                  <span class="fas fa-eye"/> {{ __('View') }}
                </a>
                <a href="{{ route($edit_route ?? 'usuarios.edit', $user) }}" class="btn btn-primary">
                  <span class="fas fa-edit"/> {{ __('Edit') }}
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

    <div class="text-center">
      {{ $users->appends(request()->query())->links() }}
    </div>
  @endcomponent
@endsection
