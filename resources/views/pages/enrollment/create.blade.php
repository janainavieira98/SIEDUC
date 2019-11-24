@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      'Matriculas' => route('matriculas.index'),
      'Cadastrar Matriculas' => url()->current()
    ]
  ])

  @component('components.card')
    @slot('header')
      <span class="text-capitalize">Cadastrar Matricula</span>
    @endslot

    <form slot="body" action="{{ route('matriculas.store') }}" method="post">
      @csrf


      <div class="form-group row">
        <label for="user_id"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('user') }}</label>

        <div class="col-lg-10">
          <div>
            <select
              id="user_id"
              type="text"
              class="form-control @error('user_id') is-invalid @enderror"
              name="user_id"
              required>
              @foreach($users as $user)
                <option
                  class="text-capitalize"
                  value="{{ $user['id'] }}"
                  {{ old('user_id') == $user['id'] ? 'selected' : '' }}>
                  {{ $user['name'] }}
                </option>
              @endforeach
            </select>
          </div>

          @component('components.errors', ['errorKey' => 'user_id'])
          @endcomponent

        </div>
      </div>

      <div class="form-group row">
        <label for="classroom_id"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('classroom') }}</label>

        <div class="col-lg-10">
          <div>
            <select
              id="classroom_id"
              type="text"
              class="form-control @error('classroom_id') is-invalid @enderror"
              name="classroom_id"
              required>
              @foreach($classrooms as $classroom)
                <option
                  class="text-capitalize"
                  value="{{ $classroom['id'] }}"
                  {{ old('classroom_id') == $classroom['id'] ? 'selected' : '' }}>
                  {{ $classroom['description'] }}
                </option>
              @endforeach
            </select>
          </div>

          @component('components.errors', ['errorKey' => 'classroom_id'])
          @endcomponent

        </div>
      </div>

      <div class="form-group row">
        <label for="enrollment_type_slug"
               class="col-lg-2 col-form-label text-md-left text-capitalize">Tipo de Matricula</label>

        <div class="col-lg-10">
          <div>
            <select
              id="enrollment_type_slug"
              type="text"
              class="form-control @error('enrollment_type_slug') is-invalid @enderror"
              name="enrollment_type_slug"
              required>
              @foreach($enrollmentTypes as $enrollment_type)
                <option
                  class="text-capitalize"
                  value="{{ $enrollment_type['slug'] }}"
                  {{ old('enrollment_type_slug') == $enrollment_type['slug'] ? 'selected' : '' }}>
                  {{ __($enrollment_type['description']) }}
                </option>
              @endforeach
            </select>
          </div>

          @component('components.errors', ['errorKey' => 'enrollment_type_slug'])
          @endcomponent

        </div>
      </div>

      <div class="form-group row">
        <label for="roll_id" class="col-lg-2 col-form-label text-md-left text-capitalize">Número da Chamada</label>

        <div class="col-lg-10">
          <div>
            <input
              id="roll_id"
              type="text"
              class="form-control @error('roll_id') is-invalid @enderror"
              name="roll_id"
              value="{{ old('roll_id') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'roll_id'])
          @endcomponent
        </div>
      </div>

      <div class="form-group row">
        <label for="date" class="col-lg-2 col-form-label text-md-left text-capitalize">Data de Matricula</label>

        <div class="col-lg-10">
          <div>
            <input
              id="date"
              type="date"
              class="form-control @error('date') is-invalid @enderror"
              name="date"
              value="{{ old('date') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'date'])
          @endcomponent
        </div>
      </div>

      <div class="text-right">
        <a href="{{ route('matriculas.index') }}" class="btn btn-danger text-capitalize">{{ __('back') }}</a>
        <button type="submit" class="btn btn-primary text-capitalize">{{ __('register') }}</button>
      </div>
    </form>
  @endcomponent
@endsection
