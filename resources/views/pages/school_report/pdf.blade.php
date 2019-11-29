<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Boletim Escolar Bimestre {{ $part }}</title>
  <style>
    .table-bordered {
      border-collapse: collapse;
    }

    table {
      padding: 0;
      margin: 0;
    }

    main {
      margin-top: 0.5cm;
    }

    header {
      text-align: center;
    }

  </style>
</head>
<body>
<header>
  <h1>SIEDUC</h1>
  <p>Boletim Escolar</p>
</header>
<aside>
  <div>
    <b>NOME:</b><span> {{ $user->name }}</span>
  </div>
  <div>
    <b>CPF:</b><span> {{ $user->cpf }}</span>
  </div>
  <div>
    <b>RG:</b><span> {{ $user->rg }}</span>
  </div>
  <div>
    <b>Série: </b>
    <span>{{ $classroom->grade }}</span>
    <b style="margin-left: 0.5cm">Ano: </b>
    <span>{{ $classroom->year }}</span>
  </div>
</aside>
<main>
  @include('components.school_report', [
    'classroom' => $classroom,
    'grades' => $grades
  ])
</main>
</body>
</html>
