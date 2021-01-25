@extends('index')

@section('content')
<div class="card">
        @foreach ($szervizkonyv as $adatok)
        <div class="card-header text-center">
            Módosítás
        </div>
        <div class="card-body">
            <form action="{{route('modositas',$adatok->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tulajdonos neve</label>
                    <input type="text" name="name" placeholder="Tulajdonos"  class="form-control @error('name') border border-danger  @enderror"  value="{{$adatok->nev}}">
    
                    @error('name')
                        <div>
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="autoMarka">Autó márka</label>
                    <input type="text" name="autoMarka" placeholder="Márka"  class="form-control @error('autoMarka') border border-danger  @enderror"  value="{{$adatok->marka}}">

                    <label for="autoTipus">Autó típusa</label>
                    <input type="text" name="autoTipus" placeholder="Típus"  class="form-control @error('autoTipus') border border-danger  @enderror"  value="{{$adatok->tipus}}">
    
                    @error('auto')
                        <div>
                            {{$message}}
                        </div>
                    @enderror
                </div> 
                
                <div class="form-check form-check-inline">

                    <div class="@error('garancia') border border-danger  @enderror">
                        <select name="garancialis">
                            <option value="0">Nem garancialis</option>
                            <option
                            @if ($adatok->garancialis == 1)
                                selected
                            @endif
                            value="1">Garancialis</option>
                        </select>
                    </div>

                    @error('garancia')
                        <div>
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="border @error('radios') border-danger  @enderror">
                    <p>Autó életkora</p>
                    @foreach ($eletkorok as $eletkor)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radios" id="Radios" value="{{$eletkor->id}}" 
                            @if ($eletkor->kategoria == $adatok->kategoria)
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="radios">{{$eletkor->kategoria}}</label>
                        </div>
                    @endforeach
                    
                    @error('radios')
                        <div>
                            {{$message}}
                        </div>
                    @enderror
                </div>
                

                <div class="form-control">
                    <label for="szervizkezdet">Szerviz kezdete</label>
                    <input type="text" name="szervizkezdet" value="{{$adatok->szerviz_kezdete}}">
                    @error('szervizkezdet')
                        <div class="bg-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Módosítás</button>
                </div>
            </form>
        </div>
        @endforeach
</div>
@endsection