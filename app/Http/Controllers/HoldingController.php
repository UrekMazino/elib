<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

class HoldingController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->usertype == 'Administrator')
        {  
            return redirect('/admin/dashboard');
        }

        //SAVE VIEW
        saveView(request()->holding_id);

        $result = App\Models\View_holding::where('holdings_id',request()->holding_id)->first();

        return view('opac.full-description')->with('result',$result);
    }

    public function index2($holdingsid = null)
    {
        if(Auth::check() && Auth::user()->usertype == 'Administrator')
        {  
            return redirect('/admin/dashboard');
        }

        if($holdingsid){

            $result = App\Models\View_holding::where('holdings_id',request()->holdingsid)->first();

            //SAVE VIEW
            saveView($result['id']);

            return view('opac.full-description')->with('result',$result);
        }   
        else{
            return redirect('/home');
        }
            
    }
}
