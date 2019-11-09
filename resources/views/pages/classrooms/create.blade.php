@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('classrooms') => route('classes.index'),
      __('Create :entity', ['entity' => __('classroom')]) => url()->current(),
    ]
  ])

  @component('components.card')
    @slot('header')
      <span class="text-capitalize">{{ __('Create :entity', ['entity' => __('classroom')]) }}</span>
    @endslot

    <form action="{{ route('classes.store') }}" method="post">
      @csrf

      <div class="form-group row">
        <label for="grade" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('grade') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="grade"
              type="text"
              class="form-control @error('grade') is-invalid @enderror"
              name="grade"
              value="{{ old('grade') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'grade'])
          @endcomponent
        </div>
      </div>

      <div class="form-group row">
        <label for="description" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('team') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="description"
              type="text"
              class="form-control @error('description') is-invalid @enderror"
              name="description"
              value="{{ old('description') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'description'])
          @endcomponent
        </div>
      </div>

      <div class="form-group row">
        <label for="period_slug"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('period') }}</label>

        <div class="col-lg-10">
          <div>
            <select
              id="period_slug"
              type="text"
              class="form-control @error('period_slug') is-invalid @enderror"
              name="period_slug"
              required>
              @foreach($periods as $period)
                <option
                  class="text-capitalize"
                  value="{{ $period['slug'] }}"
                  {{ old('period_slug') == $period['slug'] ? 'selected' : '' }}>
                  {{ $period['description'] }}
                </option>
              @endforeach
            </select>
          </div>

          @component('components.errors', ['errorKey' => 'period_slug'])
          @endcomponent

        </div>
      </div>

      <div class="form-group row">
        <label
          for="start_hour"
          class="col-lg-2 col-form-label text-md-left text-capitalize">
          {{ __('start hour') }}
        </label>

        <div class="col-lg-10">
          <div>
            <masked-input
              :mask="[/\d/,/\d/,':',/\d/,/\d/]"
              guide
              id="start_hour"
              type="text"
              value="{{ old('start_hour') }}"
              class="form-control @error('start_hour') is-invalid @enderror"
              name="start_hour"
              required
              autocomplete="start_hour"
            />
          </div>

          @component('components.errors', ['errorKey' => 'start_hour'])
          @endcomponent

        </div>
      </div>

      <div class="form-group row">
        <label
          for="end_hour"
          class="col-lg-2 col-form-label text-md-left text-capitalize">
          {{ __('end hour') }}
        </label>

        <div class="col-lg-10">
          <div>
            <masked-input
              :mask="[/\d/,/\d/,':',/\d/,/\d/]"
              guide
              id="end_hour"
              type="text"
              value="{{ old('end_hour') }}"
              class="form-control @error('end_hour') is-invalid @enderror"
              name="end_hour"
              required
              autocomplete="end_hour"
            />
          </div>

          @component('components.errors', ['errorKey' => 'end_hour'])
          @endcomponent

        </div>
      </div>



      <div class="form-group row">
        <label
          for="year"
          class="col-lg-2 col-form-label text-md-left text-capitalize">
          {{ __('year') }}
        </label>

        <div class="col-lg-10">
          <div>
            <masked-input
              :mask="[/\d/,/\d/,/\d/,/\d/]"
              guide
              id="year"
              type="text"
              value="{{ old('year') }}"
              class="form-control @error('year') is-invalid @enderror"
              name="year"
              required
              autocomplete="year"
            />
          </div>

          @component('components.errors', ['errorKey' => 'year'])
          @endcomponent

        </div>
      </div>

      <div class="form-group row">
        <label for="start_date" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('start date') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="start_date"
              type="date"
              class="form-control @error('start_date') is-invalid @enderror"
              name="start_date"
              value="{{ old('start_date') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'start_date'])
          @endcomponent
        </div>
      </div>

      <div class="form-group row">
        <label for="end_date" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('end date') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="end_date"
              type="date"
              class="form-control @error('end_date') is-invalid @enderror"
              name="end_date"
              value="{{ old('end_date') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'end_date'])
          @endcomponent
        </div>
      </div>

      <div class="form-group row">
        <label for="weekdays"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('weekdays') }}</label>

        <div class="col-lg-10">
          <div>
            <select-multiple
              name="weekdays[]"
              id="weekdays"
              value-key="slug"
              label-key="description"
              :selected="{{ json_encode(old('weekdays', [])) }}"
              :options="{{ $weekDays }}"></select-multiple>
          </div>

          @component('components.errors', ['errorKey' => 'weekdays'])
          @endcomponent

        </div>
      </div>


      <div class="form-group row">
        <label for="max_users" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('max users') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="max_users"
              type="number"
              class="form-control @error('max_users') is-invalid @enderror"
              name="max_users"
              value="{{ old('max_users') }}"
              required
            />
          </div>

          @component('components.errors', ['errorKey' => 'max_users'])
          @endcomponent
        </div>
      </div>

      <div class="text-right">
        <a href="{{ route('classes.index') }}" class="btn btn-danger text-capitalize">{{ __('back') }}</a>
        <button type="submit" class="btn btn-primary text-capitalize">{{ __('register') }}</button>
      </div>
    </form>
  @endcomponent
@endsection
