<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auto;
use App\Models\Auto_eletkor;
use App\Models\Szervizkonyv;
use App\Models\User_cars;
use App\Models\User;
use DB;

class HozzaadController extends Controller
{
    public function index()
    {
        $autok = Auto::get();
        $eletkorok = Auto_eletkor::get();

        return view('felvitel',[
            'autok' => $autok,
            'eletkorok' => $eletkorok,
        ]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:25',
            'autoMarka' => 'required',
            'autoTipus' => 'required',
            'garancia' => 'required',
            'radios' => 'required',
            'szervizkezdet' => 'required'
        ]);
        $autoId = (DB::table('auto')->max('id'))+1;
        $userId = (DB::table('users')->max('id'))+1;

        if(!(User::where('nev','=',$request->name)->exist())){
            User::create([
                'nev' => $request -> name
            ]);
            }else{
                $userId = User::where('nev','=',$request->name)->select('id')->get();
            }

        if (!(Auto::where('marka','=',$request->autoMarka)->where('tipus','=',$request->autoTipus)->where('kor','=',$request->radios)->exist() )) {
            Auto::create([
                'marka' => $request -> autoMarka,
                'tipus' => $request -> autoTipus,
                'kor' => $request -> radios
            ]);
        } else {
            $autoId = Auto::where('marka','=',$request->autoMarka)->where('tipus','=',$request->autoTipus)->where('kor','=',$request->radios)->select('id')->get();
        }
        Szervizkonyv::create([
            'garancialis' => $request -> garancia,
            'szerviz_kezdete' => $request -> szervizkezdet,
            'auto' => $autoId
        ]);

        if(!(User_cars::where('auto','=',$autoId)->where('user','=',$userId)->exist())){
            User_cars::create([
                'auto' => $autoId,
                'user' => $userId
            ]);
        }
        return redirect('hozzaad')->with('status','Sikeres hozzáadás');
    }
}
