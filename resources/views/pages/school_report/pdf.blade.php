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

  </style>
</head>
<body>
<header>
  <h1>SIEDUC</h1>
  <p>Boletim Escolar</p>
</header>
<aside>
  <div>
    <span>Nome:</span> <span>{{ $user->name }}</span>
  </div>
  <table>
    <tbody>
    <tr>
      <td>
        <span>Série: </span>
        <span>{{ $classroom->grade }}</span>
      </td>
      <td>
        <span>Ano: </span>
        <span>{{ $classroom->year }}</span>
      </td>
    </tr>
    </tbody>
  </table>
</aside>
<main>
  @include('components.school_report', [
    'classroom' => $classroom,
    'grade' => $grade
  ])
</main>
</body>
</html>
