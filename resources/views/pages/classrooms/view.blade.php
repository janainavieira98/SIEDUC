@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('classrooms') => route('classes.index'),
      __('View :entity', ['entity' => __('classroom')]) => url()->current(),
    ]
  ])

  @component('components.card')
    @slot('header')
      <span class="text-capitalize">{{ __('View :entity', ['entity' => __('classroom')]) }}</span>
    @endslot

    <div>
      <div class="form-group row">
        <label for="grade" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('grade') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="grade"
              readonly
              type="text"
              class="form-control @error('grade') is-invalid @enderror"
              value="{{ $classroom->grade }}"
            />
          </div>
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
              readonly
              value="{{ $classroom['description'] }}"
            />
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="period_slug"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('period') }}</label>

        <div class="col-lg-10">
          <div>
            <input type="text" class="form-control" readonly value="{{ $classroom['period']['description'] }}">
          </div>
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
              value="{{ $classroom['start_hour'] }}"
              class="form-control @error('start_hour') is-invalid @enderror"
              readonly
            />
          </div>
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
              readonly
              value="{{ $classroom['end_hour'] }}"
              class="form-control @error('end_hour') is-invalid @enderror"
            />
          </div>
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
              readonly
              value="{{ $classroom['year'] }}"
              class="form-control @error('year') is-invalid @enderror"
            />
          </div>
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
              value="{{ $classroom['start_date'] }}"
              readonly
            />
          </div>
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
              value="{{ $classroom['end_date'] }}"
              readonly
            />
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="weekdays"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('weekdays') }}</label>

        <div class="col-lg-10">
          @if(count($classroom['weekdays']) > 0)
            <ul>
              @foreach($classroom['weekdays'] as $weekday)
                <li class="text-capitalize">{{ $weekday['description'] }}</li>
              @endforeach
            </ul>
          @else
            <p>{{ __('none day selected') }}</p>
          @endif
        </div>
      </div>


      <div class="form-group row">
        <label for="max_users" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('max users') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="max_users"
              type="number"
              readonly
              class="form-control @error('max_users') is-invalid @enderror"
              value="{{ $classroom['max_users'] }}"
            />
          </div>
        </div>
      </div>

      <div class="text-right">
        <a href="{{ route('classes.index') }}" class="btn btn-danger text-capitalize">{{ __('back') }}</a>
      </div>
    </div>
  @endcomponent
@endsection
