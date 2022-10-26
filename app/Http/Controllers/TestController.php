<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Test;

class TestController extends Controller
{
    public function index(){

        dd('test');

        //Eloquant(エロクアント)
        $values = Test::all();


        $count = Test::count();

        $first = Test::findOrFail(1);

        $whereAAA = Test::where('text', '=', 'AAA')->get();


        //クエリビルダ
        $queryBuilder = DB::table('tests')->where('text', '=', 'bbb')
        ->select('id', 'text')
        ->get();



        dd($queryBuilder);

        return view('tests.test', compact('values'));
    }
}
