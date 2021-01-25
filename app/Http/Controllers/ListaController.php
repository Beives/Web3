<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Szervizkonyv;

class ListaController extends Controller
{
    public function index()
    {
        $szervizkonyvek = DB::table('szervizkonyv')
        ->join('auto','szervizkonyv.auto','=','auto.id')
        ->join('auto_eletkor', 'auto.kor','=','auto_eletkor.id')
        ->join('user_cars','auto.id','=','user_cars.auto')
        ->join('users', 'user_cars.user','=','users.id')
        ->select('szervizkonyv.id','users.nev','auto.marka','auto.tipus','szervizkonyv.garancialis','auto_eletkor.kategoria','szervizkonyv.szerviz_kezdete','szervizkonyv.szerviz_vege')
        ->get();

        return view('lista',compact('szervizkonyvek'));
    }
    public function destroy($id){
        $konyv = Szervizkonyv::find($id);
        $konyv->delete();
        return redirect()->route('lista');
    }
    public function szerviz_befejezes($id){
        DB::table('szervizkonyv')->where('id',$id)->update(['szerviz_vege' => Carbon::now()]);
        return redirect()->route('lista');
    }
}
