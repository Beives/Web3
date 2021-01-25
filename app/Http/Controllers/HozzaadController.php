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
            
        if(!(User::where('nev','=',$request->name)->exists())){
            User::create([
                'nev' => $request -> name
            ]);
            }else{
                $userId = (User::select('id')->where('nev','=',$request->name)->first())->id;
            }
            
        if (!(Auto::where('marka','=',$request->autoMarka)->where('tipus','=',$request->autoTipus)->where('kor','=',$request->radios)->exists() )) {
            Auto::create([
                'marka' => $request -> autoMarka,
                'tipus' => $request -> autoTipus,
                'kor' => $request -> radios
            ]);
        } else {
            $autoId = (Auto::select('id')->where('marka','=',$request->autoMarka)->where('tipus','=',$request->autoTipus)->where('kor','=',$request->radios)->first())->id;
        }
        
        Szervizkonyv::create([
            'garancialis' => $request -> garancia,
            'szerviz_kezdete' => $request -> szervizkezdet,
            'auto' => $autoId
        ]);

        if(!(User_cars::where('auto','=',$autoId)->where('user','=',$userId)->exists())){
            User_cars::create([
                'auto' => $autoId,
                'user' => $userId
            ]);
        }
        return redirect('hozzaad')->with('status','Sikeres hozzáadás');
    }
}
