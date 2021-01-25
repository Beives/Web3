@extends('index')

@section('content')
<div class="card">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <div class="card-header text-center">
            Hozzáadás
        </div>
        <div class="card-body">
            <form action="{{route('hozzaad')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tulajdonos neve</label>
                    <input type="text" name="name" placeholder="Tulajdonos"  class="form-control @error('name') border border-danger  @enderror"  value="{{old('name')}}">
    
                    @error('name')
                        <div>
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="autoMarka">Autó márka</label>
                    <input type="text" name="autoMarka" placeholder="Márka"  class="form-control @error('autoMarka') border border-danger  @enderror"  value="{{old('autoMarka')}}">

                    <label for="autoTipus">Autó típusa</label>
                    <input type="text" name="autoTipus" placeholder="Típus"  class="form-control @error('autoTipus') border border-danger  @enderror"  value="{{old('autoTipus')}}">
    
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
                            <option value="1">Garancialis</option>
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
                            <input class="form-check-input" type="radio" name="radios" id="Radios" value="{{$eletkor->id}}">
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
                    @if (stripos($_SERVER['HTTP_USER_AGENT'], 'Firefox') != false)
                        <div class="@error('szervizkezdet') border border-danger  @enderror">
                            <label for="szervizkezdet">Szervíz kezdete</label>
                            <input type="date" onchange="concat()" name="szervizdatum" id="szervizdatum" required value="{{old('szervizdatum')}}">
                            <input type="time" onchange="concat()" name="szervizora" id="szervizora" required value="{{old('szervizora')}}">

                            <input type="hidden" name="szervizkezdet" id="szervizkezdet" value="{{old('szervizora')}}">

                            <script>
                                function concat(){
                                    document.getElementById("szervizkezdet").value =document.getElementById("szervizdatum").value +" "+ document.getElementById("szervizora").value+":00";
                                }
                            </script>

                        </div>
                    @else
                        <div class="@error('szervizkezdet') border border-danger  @enderror">
                            <label for="szervizkezdet">Szervíz kezdete</label>
                            <input type="datetime-local" name="szervizkezdet">
                        </div>
                    @endif
                    @error('szervizkezdet')
                        <div class="bg-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Hozzáadás</button>
                </div>
            </form>
        </div>
    </div>
@endsection