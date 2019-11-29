<table width="100%" class="table-bordered" border="1">
  <thead>
  <tr>
    <th colspan="2">Disciplina</th>
    <th colspan="2">1º Bimestre</th>
    <th colspan="2">2º Bimestre</th>
    <th colspan="2">3º Bimestre</th>
    <th colspan="2">4º Bimestre</th>
    <th>Média</th>
    <th>T.Faltas</th>
  </tr>
  <tr>
    <th colspan="2"></th>
    <th>
      Nota
    </th>
    <th>
      Falta
    </th>
    <th>
      Nota
    </th>
    <th>
      Falta
    </th>
    <th>
      Nota
    </th>
    <th>
      Falta
    </th>
    <th>
      Nota
    </th>
    <th>
      Falta
    </th>
    <th>
      Nota
    </th>
    <th>
      Falta
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach($classroom->disciplines as $discipline)
    <tr>
      <td colspan="2">{{ $discipline->name }}</td>
      @for($i = 1; $i <= $part; $i++)
        <td>{{ $grade["grade$i"] ?? 0 }}</td>
        <td>{{ $grade["absences$i"] ?? 0 }}</td>
      @endfor
      @if($part < 4)
        @foreach(range($part+1, 4) as $bimester)
          <td>0</td>
          <td>0</td>
        @endforeach
      @endif
      <td>
        {{ $grade->averageGrade($part) }}
      </td>
      <td>
        {{ $grade->totalAbsences($part) }}
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
