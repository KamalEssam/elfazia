<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class generateCardController extends Controller
{
    public function getcardGenerator(Request $request){
        return view('charge_card_page.index');
    }
    public function test(){
        dd('test');
    }
}
