@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('Disciplines') => route('disciplinas.index'),
      __('Create :entity', ['entity' => __('Discipline')]) => url()->current(),
    ]
  ])

  @component('components.card')
    @slot('header')
      <span class="text-capitalize">{{ __('Create :entity', ['entity' => __('Discipline')]) }}</span>
    @endslot

    <form action="{{ route('disciplinas.store') }}" method="post">
      @csrf

      <div class="form-group row">
        <label for="name" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('code') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="code"
              type="text"
              class="form-control @error('code') is-invalid @enderror"
              name="code"
              value="{{ old('code') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'code'])
          @endcomponent
        </div>
      </div>

      <div class="form-group row">
        <label for="name" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('name') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="name"
              type="text"
              class="form-control @error('name') is-invalid @enderror"
              name="name"
              value="{{ old('name') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'name'])
          @endcomponent
        </div>
      </div>

      <div class="form-group row">
        <label for="name" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('timeload') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="timeload"
              type="number"
              class="form-control @error('timeload') is-invalid @enderror"
              name="timeload"
              value="{{ old('timeload') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'timeload'])
          @endcomponent
        </div>
      </div>

      <div class="text-right">
        <a href="{{ route('disciplinas.index') }}" class="btn btn-danger text-capitalize">{{ __('back') }}</a>
        <button type="submit" class="btn btn-primary text-capitalize">{{ __('register') }}</button>
      </div>
    </form>
  @endcomponent
@endsection
