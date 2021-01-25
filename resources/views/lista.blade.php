@extends('index')

@section('content')
<table class="table table-bordered" id="szervizkonyvek_table" >
    <thead>
        <tr>
          <th scope="col">Tulajdonos neve</th>
          <th scope="col">Autó megnevezése</th>
          <th scope="col">Garancia állapota</th>
          <th scope="col">Autó életkora</th>
          <th scope="col">Szervíz kezdete</th>
          <th scope="col">Szervíz vége</th>
          <th scope="col">Módosítás</th>
          <th scope="col">Törlés</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($szervizkonyvek as $konyv)
              <tr>
                <td>{{$konyv->nev}}</td>
                <td>{{$konyv->marka}} {{$konyv->tipus}}</td>

                <td>
                  @if ($konyv->garancialis == 0)
                      Nem garanciális
                  @else
                      Garanciális
                  @endif
                </td>

                <td>{{$konyv->kategoria}}</td>
                <td>{{$konyv->szerviz_kezdete}}</td>

                <td>
                  @if ($konyv->szerviz_vege == null)
                    <form action="{{action('App\Http\Controllers\ListaController@szerviz_befejezes',$konyv->id)}}" method="POST">
                      @csrf
                      <input type="hidden" name="hiddenEndId" value="{{$konyv->id}}">
                      <button type="submit" class="btn btn-success">Befejezés</button>
                    </form>
                  @else
                  {{$konyv->szerviz_vege}}
                  @endif
                </td>

                <td>
                  <a class="btn btn-warning" role="button" href="{{route('modositas',$konyv->id)}}">Módosítás</a>
                </td>

                <td>
                  <form action="{{action('App\Http\Controllers\ListaController@destroy',$konyv->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Törlés</button>
                  </form>
                </td>
              </tr>
          @endforeach
      </tbody>
</table>
@endsection