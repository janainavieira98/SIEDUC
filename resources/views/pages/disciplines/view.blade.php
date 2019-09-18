@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('Disciplines') => route('disciplinas.index'),
      __('View :entity', ['entity' => __('Discipline')]) => url()->current(),
    ]
  ])

  @component('components.card')
    @slot('header')
      <span class="text-capitalize">{{ __('View :entity', ['entity' => __('Discipline')]) }}</span>
    @endslot

    <div>
      <div class="form-group row">
        <label for="name" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('code') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="code"
              type="text"
              class="form-control "
              name="code"
              value="{{ $discipline['code'] }}"
              disabled
              readonly
            />
          </div>

        </div>
      </div>

      <div class="form-group row">
        <label for="name" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('name') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="name"
              type="text"
              class="form-control"
              name="name"
              value="{{ $discipline['name'] }}"
              disabled
              readonly
              required
            />
          </div>
        </div>
      </div>

      <div class="text-right">
        <a href="{{ route('disciplinas.index') }}" class="btn btn-danger text-capitalize">{{ __('back') }}</a>
      </div>
    </div>
  @endcomponent
@endsection
