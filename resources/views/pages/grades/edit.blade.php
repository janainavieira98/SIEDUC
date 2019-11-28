@extends('layouts.page')

@section('page_content')
  @include('components.breadcrumbs', [
    'items' => [
      __('Home') => route('home'),
     'Notas e Faltas: Classe' => route('grades.classrooms', request()->route('classroom')),
     'Notas e Faltas: Disciplina' => route('grades.disciplines', request()->route('discipline')),
     'Notas e Faltas: Alunos' => route('grades.grades', [request()->route('classroom'), request()->route('discipline')]),
     'Atualizar Notas e Faltas' => url()->current()
    ]
  ])

  @foreach($errors->all() as $error)
    {{ $error }}
  @endforeach

  @component('components.card')
    @slot('header')
      <span class="text-capitalize">Cadastrar Notas e Faltas</span>
    @endslot

    <form action="{{ route('grades.update', [request()->route('classroom'), request()->route('discipline'), request()->route('user')]) }}"
          method="post">
      @csrf
      @method('PUT')

      <div class="form-group row">
        <label for="user_id"
               class="col-lg-2 col-form-label text-md-left text-capitalize">Aluno</label>

        <div class="col-lg-10">
          <input type="text" class="form-control" readonly value="{{ $user->name }}">
        </div>
      </div>

      @for($i = 1; $i <= 4; $i++)
        <div class="form-group row">
          <label for="absences{{ $i }}" class="col-lg-2 col-form-label text-md-left text-capitalize">Faltas
            Bimestre {{ $i }}</label>

          <div class="col-lg-10">
            <div>
              <input
                id="absences{{ $i }}"
                type="number"
                class="form-control @error("absences$i") is-invalid @enderror"
                name="absences{{ $i }}"
                value="{{ old("absences$i", $grade["absences$i"]) }}"
              />
            </div>

            @component('components.errors', ['errorKey' => "absences$i"])
            @endcomponent
          </div>
        </div>
      @endfor

      @for($i = 1; $i <= 4; $i++)
        <div class="form-group row">
          <label for="grade{{ $i }}" class="col-lg-2 col-form-label text-md-left text-capitalize">Nota
            Bimestre {{ $i }}</label>

          <div class="col-lg-10">
            <div>
              <input
                id="grade{{ $i }}"
                type="number"
                class="form-control @error("grade$i") is-invalid @enderror"
                name="grade{{ $i }}"
                value="{{ old("grade$i", $grade["grade$i"]) }}"
              />
            </div>

            @component('components.errors', ['errorKey' => "grade$i"])
            @endcomponent
          </div>
        </div>
      @endfor

      <div class="form-group row">
        <label for="approved" class="col-lg-2 col-form-label text-md-left text-capitalize">Situação</label>
        <div class="col-lg-5">
          <label>
            <input type="radio" value="0" name="approved" id="approved_false" {{ old('approved', $grade->approved) ? '' : 'checked' }}>
            <span class="ml-2">Reprovado ou Incompleto</span>
          </label>
        </div>
        <div class="col-lg-5">
          <label>
            <input type="radio" value="1" name="approved" id="approved_true" {{ old('approved', $grade->approved) ? 'checked' : '' }}>
            <span class="ml-2">Aprovado</span>
          </label>
        </div>
      </div>
      <div class="row">
        <div class="col-12">

          @component('components.errors', ['errorKey' => 'approved'])
          @endcomponent
        </div>
      </div>

      <div class="text-right">
        <a href="{{ route('grades.grades', [request()->route('classroom'), request()->route('discipline')]) }}"
           class="btn btn-danger text-capitalize">{{ __('back') }}</a>
        <button type="submit" class="btn btn-primary text-capitalize">Salvar</button>
      </div>
    </form>
  @endcomponent
@endsection
