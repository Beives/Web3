<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auto;
use App\Models\Auto_eletkor;
use App\Models\Szervizkonyv;
use App\Models\User_cars;
use App\Models\User;
use DB;

class ModositasController extends Controller
{
    public function index($id)
    {
        $szervizkonyv = DB::table('szervizkonyv')
        ->join('auto','szervizkonyv.auto','=','auto.id')
        ->join('auto_eletkor', 'auto.kor','=','auto_eletkor.id')
        ->join('user_cars','auto.id','=','user_cars.auto')
        ->join('users', 'user_cars.user','=','users.id')
        ->select('szervizkonyv.id','users.nev','auto.marka','auto.tipus','szervizkonyv.garancialis','auto_eletkor.kategoria','szervizkonyv.szerviz_kezdete','szervizkonyv.szerviz_vege')
        ->where('szervizkonyv.id','=',$id)
        ->first();
        $autok = Auto::get();
        $eletkorok = Auto_eletkor::get();

        return view('modosit',[
            'modositId' => $id,
            'autok' => $autok,
            'eletkorok' => $eletkorok,
            'szervizkonyv' => compact('szervizkonyv')
        ]);
    }
    public function store(Request $request, $id){
        DB::enableQueryLog();
        $this->validate($request, [
            'name' => 'required|max:25',
            'autoMarka' => 'required',
            'autoTipus' => 'required',
            'radios' => 'required',
            'szervizkezdet' => 'required'
        ]);
        $autoId = (DB::table('auto')->max('id'))+1;
        $userId = (DB::table('users')->max('id'))+1;
        if(!(User::where('nev','=',$request->name)->exists())){
            User::create([
                'nev' => $request -> name
            ]);
            }
        else{
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
        Szervizkonyv::where('id',$id)
        ->update([
            'garancialis' => $request -> garancialis,
            'szerviz_kezdete' => $request -> szervizkezdet,
            'auto' => $autoId
        ]);
        if(!(User_cars::where('auto','=',$autoId)->where('user','=',$userId)->exists())){
            User_cars::create([
                'auto' => $autoId,
                'user' => $userId
            ]);
        }
        return redirect(route('modositas',$id))->with('status','Sikeres modositas');
    }
}
