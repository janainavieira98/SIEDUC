<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Historico Escolar</title>
  <style>
    .bordered-table {
      border-collapse: collapse;
      text-align: center;
    }

    header {
      text-align: center;
    }

    main {
      margin-top: 0.5cm;
    }
  </style>
</head>
<body>
<header>
  <h1>SIEDUC</h1>
  <p>HISTORICO ESCOLAR</p>
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
</aside>
<main>

  <table class="bordered-table" border="1" width="100%">
    <thead>
    <tr>
      <th rowspan="2">COMPONENTS CURRICULARES</th>
      <th>ANO</th>
      @for($i = $firstYear; $i <= $firstYear + 2; $i++)
        <th>
          {{ $i }}
        </th>
      @endfor
      <th rowspan="2" style="padding-left: 10px">CARGA HORÁRIA</th>
    </tr>
    <tr>
      <th>SÉRIE</th>
      @for($i = 1; $i <= 3; $i++)
        <th>
          {{ $firstClassroom[0]['classroom']['grade'] + $i }}
        </th>
      @endfor
    </tr>
    </thead>
    <tbody>
    @foreach($records as $disciplineGrades)
      @php
        $disciplineGradeInfo = $disciplineGrades[array_key_first($disciplineGrades)];
        $discipline = $disciplineGradeInfo['discipline'];
      @endphp
      <tr>
        <td colspan="2">
          {{ $discipline['name'] }}
        </td>
        @for($i = $firstYear; $i <= $firstYear+2; $i++)
          @if(isset($disciplineGrades[$i]))
            @php
              $yearInfo = $disciplineGrades[$i];
              $averageGrade=$yearInfo['averageGrade'];
            @endphp
            <td>{{ $averageGrade }}</td>
          @else
            <td>0</td>
          @endif
        @endfor
        <td>{{ $years * $discipline['timeload'] }}</td>
      </tr>
    @endforeach
    {{--    @foreach($records as $discipline)--}}
    {{--      <tr>--}}
    {{--        <td colspan="2">{{ $discipline['discipline']['name'] }}</td>--}}
    {{--        @for($i = $firstYear; $i <= $firstYear+2; $i++)--}}
    {{--          @if(!!$classroom)--}}
    {{--            <td>{{ $classroom['averageGrade'] }}</td>--}}
    {{--          @else--}}
    {{--            <td>0</td>--}}
    {{--          @endif--}}
    {{--        @endfor--}}
    {{--        <td>{{ $discipline['years'] * 1000 }}h</td>--}}
    {{--      </tr>--}}
    {{--    @endforeach--}}
    </tbody>
  </table>
</main>
</body>
</html>
