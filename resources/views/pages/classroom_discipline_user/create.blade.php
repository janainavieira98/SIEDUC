@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('Create :entity', ['entity' => __('Discipline')]) => route('disciplinas.index'),
      __('link disciplines') => route('vincular-disciplinas.index'),
      __('Create :entity', ['entity' => __('link')]) => url()->current(),
    ]
  ])

  @component('components.card')
    @slot('header')
      <span class="text-capitalize">{{ __('Create :entity', ['entity' => __('link')]) }}</span>
    @endslot

    <form slot="body" action="{{ route('vincular-disciplinas.store') }}" method="post">
      @csrf

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
        <label for="discipline_id"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('Discipline') }}</label>

        <div class="col-lg-10">
          <div>
            <select
              id="discipline_id"
              type="text"
              class="form-control @error('discipline_id') is-invalid @enderror"
              name="discipline_id"
              required>
              @foreach($disciplines as $discipline)
                <option
                  class="text-capitalize"
                  value="{{ $discipline['id'] }}"
                  {{ old('discipline_id') == $discipline['id'] ? 'selected' : '' }}>
                  {{ $discipline['name'] }}
                </option>
              @endforeach
            </select>
          </div>

          @component('components.errors', ['errorKey' => 'discipline_id'])
          @endcomponent

        </div>
      </div>

      <div class="form-group row">
        <label for="user_id"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('teacher') }}</label>

        <div class="col-lg-10">
          <div>
            <select
              id="user_id"
              type="text"
              class="form-control @error('user_id') is-invalid @enderror"
              name="user_id"
              required>
              @foreach($teachers as $teacher)
                <option
                  class="text-capitalize"
                  value="{{ $teacher['id'] }}"
                  {{ old('user_id') == $teacher['id'] ? 'selected' : '' }}>
                  {{ $teacher['name'] }}
                </option>
              @endforeach
            </select>
          </div>

          @component('components.errors', ['errorKey' => 'user_id'])
          @endcomponent

        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label for="weekday_slug"
                   class="col-lg-4 col-form-label text-md-left text-capitalize">Dia</label>
            <div class="col-lg-8">
              <div>
                <select name="weekday_slug" class="form-control" id="weekday_slug">
                  @foreach($weekdays as $weekday)
                    <option
                      class="text-capitalize"
                      value="{{ $weekday['slug'] }}"
                      {{ old('weekday_slug') == $weekday['slug'] ? 'selected' : '' }}>
                      {{ $weekday['description'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              @component('components.errors', ['errorKey' => 'weekday_slug'])
              @endcomponent
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label for="hour"
                   class="col-lg-4 col-form-label text-md-left text-capitalize">Hora</label>
            <div class="col-lg-8">
              <masked-input
                type="text"
                name="hour"
                placeholder="Digite a hora aqui"
                class="form-control"
                value="{{ old('hour', '') }}"
                :mask="[/\d/,/\d/,':',/\d/,/\d/]"
                :guide="true"
              />
            </div>
            @component('components.errors', ['errorKey' => 'hour'])
            @endcomponent
          </div>
        </div>
      </div>

      <div class="text-right">
        <a href="{{ route('vincular-disciplinas.index') }}" class="btn btn-danger text-capitalize">{{ __('back') }}</a>
        <button type="submit" class="btn btn-primary text-capitalize">{{ __('register') }}</button>
      </div>
    </form>
  @endcomponent
@endsection
