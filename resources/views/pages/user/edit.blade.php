@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
      __('users') => route('usuarios.index'),
      __('Edit :entity', ['entity' => __('user')]) => url()->current(),
    ]
  ])

  @component('components.card')
    @slot('header')
      <span class="text-capitalize">{{ __('Edit :entity', ['entity' => __('user')]) }}</span>
    @endslot

    <form method="POST" action="{{ route('usuarios.update', $user) }}">
      @csrf
      @method('PUT')

      <div class="form-group row">
        <label for="name" class="col-lg-2 col-form-label text-md-left text-capitalize">{{ __('name') }}</label>

        <div class="col-lg-10">
          <div>
            <input
              id="name"
              type="text"
              class="form-control @error('name') is-invalid @enderror"
              name="name"
              value="{{ old('name', $user['name']) }}"
              required
              autocomplete="email"
            />
          </div>

          @component('components.errors', ['errorKey' => 'name'])
          @endcomponent
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
              name="email"
              value="{{ old('email', $user['email']) }}"
              required
              autocomplete="email"
            />
          </div>

          @component('components.errors', ['errorKey' => 'email'])
          @endcomponent
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
                  name="cpf"
                  value="{{ old('cpf', $user['cpf']) }}"
                  required
                  autocomplete="cpf"
                />
              </div>

              @error('cpf')
              <div class="text-danger">
                {{ $message }}
              </div>
              @enderror
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
                  value="{{ old('rg', $user['rg']) }}"
                  required
                  autocomplete="rg"
                />
              </div>

              @component('components.errors', ['errorKey' => 'rg'])
              @endcomponent

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
                  value="{{ old('mobile_number', $user['phone']['mobile_number']) }}"
                  required
                  autocomplete="mobile_number"
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
                  value="{{ old('home_number', $user['phone']['home_number']) }}"
                  class="form-control @error('home_number') is-invalid @enderror"
                  name="home_number"
                  required
                  autocomplete="home_number"
                />
              </div>

              @component('components.errors', ['errorKey' => 'home_number'])
              @endcomponent

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
                  value="{{ old('cep', $user['address']['cep']) }}"
                  required
                  autocomplete="cep"
                />
              </div>

              @component('components.errors', ['errorKey' => 'cep'])
              @endcomponent

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
                  value="{{ old('address', $user['address']['address']) }}"
                  required
                  autocomplete="address"
                />
              </div>

              @component('components.errors', ['errorKey' => 'address'])
              @endcomponent

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
                  value="{{ old('city', $user['address']['city']) }}"
                  required
                  autocomplete="city"
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
                  value="{{ old('neighborhood', $user['address']['neighborhood']) }}"
                  required
                  autocomplete="neighborhood"
                />
              </div>

              @component('components.errors', ['errorKey' => 'neighborhood'])
              @endcomponent

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
              required>
              @foreach($roles as $role)
                <option class="text-capitalize"
                        value="{{ $role['id'] }}" {{ old('role', $user['role']['id']) == $role['id'] ? 'selected' : '' }}>{{ $role['name'] }}
                </option>
              @endforeach
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
              required>
              @foreach($genders as $gender)
                <option class="text-capitalize"
                        value="{{ $gender['id'] }}" {{ old('gender', $user['gender']['id']) == $gender['id'] ? 'selected' : '' }}>{{
                  $gender['name'] }}
                </option>
              @endforeach
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
              type="date"
              class="form-control @error('birthday') is-invalid @enderror"
              name="birthday"
              value="{{ old('birthday', $user['birthday']->format('Y-m-d')) }}"
              required
              autocomplete="birthday"
            />
          </div>

          @component('components.errors', ['errorKey' => 'birthday'])
          @endcomponent
        </div>
      </div>

      <div class="text-right">
        <a href="{{ route('usuarios.index') }}" class="btn btn-danger text-capitalize">{{ __('back') }}</a>
        <button class="btn btn-primary text-capitalize">{{ __('save') }}</button>
      </div>
    </form>
  @endcomponent
@endsection
