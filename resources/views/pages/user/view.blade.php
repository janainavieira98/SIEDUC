@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('users') => route('usuarios.index'),
      __('View :entity', ['entity' => __('user')]) => url()->current(),
    ]
  ])

  @component('components.card')
    @slot('header')
      <span class="text-capitalize">{{ __('View :entity', ['entity' => __('user')]) }}</span>
    @endslot

    <div>
      <div class="form-group row">
        <label for="name" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('name') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="name"
              type="text"
              class="form-control"
              value="{{ $name }}"
              disabled
              readonly
            />
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label
          for="email"
          class="col-lg-2 col-form-label text-md-left text-capitalize">
          {{ __('email') }}
        </label>

        <div class="col-lg-10">
          <div>
            <input
              id="email"
              type="email"
              class="form-control @error('email') is-invalid @enderror"
              value="{{ $email }}"
              readonly
              disabled
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label
              for="cpf"
              class="col-lg-4 col-form-label text-md-left text-capitalize">
              {{ __('CPF') }}
            </label>

            <div class="col-lg-8">
              <div>
                <masked-input
                  :mask="[/\d/,/\d/,/\d/,'.',/\d/,/\d/,/\d/,'.',/\d/,/\d/,/\d/,'-',/\d/,/\d/]"
                  guide
                  id="cpf"
                  type="text"
                  class="form-control @error('cpf') is-invalid @enderror"
                  value="{{ $cpf }}"
                  disabled
                  readonly
                />
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label
              for="rg"
              class="col-lg-4 col-form-label text-md-left text-capitalize">
              {{ __('RG') }}
            </label>

            <div class="col-lg-8">
              <div>
                <masked-input
                  :mask="[/\d/,/\d/,'.',/\d/,/\d/,/\d/,'.',/\d/,/\d/,/\d/,'-',/\d/]"
                  guide
                  id="rg"
                  type="text"
                  class="form-control @error('rg') is-invalid @enderror"
                  name="rg"
                  value="{{ $rg }}"
                  readonly
                  disabled
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label
              for="mobile_number"
              class="col-lg-4 col-form-label text-md-left text-capitalize">
              {{ __('mobile number') }}
            </label>

            <div class="col-lg-8">
              <div>
                <phone-input
                  id="mobile_number"
                  type="text"
                  class="form-control @error('mobile_number') is-invalid @enderror"
                  name="mobile_number"
                  value="{{ $phone['mobile_number'] }}"
                  readonly
                  disabled
                />
              </div>

              @component('components.errors', ['errorKey' => 'mobile_number'])
              @endcomponent

            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label
              for="home_number"
              class="col-lg-4 col-form-label text-md-left text-capitalize">
              {{ __('home number') }}
            </label>

            <div class="col-lg-8">
              <div>
                <masked-input
                  :mask="['(', /\d/,/\d/,')',' ',/\d/,/\d/,/\d/,/\d/,'-',/\d/,/\d/,/\d/,/\d/]"
                  guide
                  id="home_number"
                  type="text"
                  value="{{ $phone['home_number'] }}"
                  class="form-control @error('home_number') is-invalid @enderror"
                  name="home_number"
                  readonly
                  disabled
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label
              for="cep"
              class="col-lg-4 col-form-label text-md-left text-capitalize">
              {{ __('cep') }}
            </label>

            <div class="col-lg-8">
              <div>
                <masked-input
                  :mask="[/\d/,/\d/,/\d/,/\d/,/\d/,'-',/\d/,/\d/,/\d/]"
                  guide
                  id="cep"
                  type="text"
                  class="form-control @error('cep') is-invalid @enderror"
                  name="cep"
                  value="{{ $address['cep'] }}"
                  readonly
                  disabled
                />
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label for="address"
                   class="col-lg-4 col-form-label text-md-left text-capitalize">{{ __('address') }}</label>

            <div class="col-lg-8">
              <div>
                <input
                  id="address"
                  type="text"
                  class="form-control @error('address') is-invalid @enderror"
                  name="address"
                  value="{{ $address['address'] }}"
                  readonly
                  disabled
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label for="city"
                   class="col-lg-4 col-form-label text-md-left text-capitalize">{{ __('city') }}</label>

            <div class="col-lg-8">
              <div>
                <input
                  id="city"
                  type="text"
                  class="form-control @error('city') is-invalid @enderror"
                  name="city"
                  value="{{ $address['city'] }}"
                  readonly
                  disabled
                />
              </div>

              @component('components.errors', ['errorKey' => 'city'])
              @endcomponent

            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="form-group row">
            <label for="neighborhood"
                   class="col-lg-4 col-form-label text-md-left text-capitalize">{{ __('neighborhood') }}</label>

            <div class="col-lg-8">
              <div>
                <input
                  id="neighborhood"
                  type="text"
                  class="form-control @error('neighborhood') is-invalid @enderror"
                  name="neighborhood"
                  value="{{ $address['neighborhood'] }}"
                  readonly
                  disabled
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="role"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('role') }}</label>

        <div class="col-lg-10">
          <div>
            <select
              id="role"
              type="text"
              class="form-control @error('role') is-invalid @enderror"
              name="role"
              disabled
              readonly
              required>
              <option disabled selected>{{ $role['name'] }}</option>
            </select>
          </div>

          @component('components.errors', ['errorKey' => 'role'])
          @endcomponent

        </div>
      </div>

      <div class="form-group row">
        <label for="gender"
               class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('gender') }}</label>

        <div class="col-lg-10">
          <div>
            <select
              id="gender"
              type="text"
              class="form-control @error('gender') is-invalid @enderror"
              name="gender"
              readonly
              disabled
              required>
              <option selected disabled>{{ $gender['name'] }}</option>
            </select>
          </div>

          @component('components.errors', ['errorKey' => 'gender'])
          @endcomponent

        </div>
      </div>

      <div class="form-group row">
        <label for="birthday" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('birthday') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="birthday"
              type="text"
              class="form-control @error('birthday') is-invalid @enderror"
              name="birthday"
              value="{{ $birthday }}"
              readonly
              disabled
            />
          </div>
        </div>
      </div>

      <div class="text-right">
        <a href="{{ route('usuarios.index') }}" class="btn btn-danger text-capitalize">{{ __('back') }}</a>
      </div>
    </div>
  @endcomponent
@endsection
