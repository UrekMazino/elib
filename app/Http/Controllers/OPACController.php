<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

use MeiliSearch\Client;


class OPACController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','patron']);
    }

    public function profile()
    {
        return view('opac.profile');
    }

    public function barrowed()
    {
        $list = App\Models\View_borrowed_book::where('user_id',Auth::user()->id)->where('status','!=','Returned')->get();

        $flag = true;
        if(count($list) == 0)
        {
            $flag = false;
        }

        return view('opac.barrowed',['list' => $list,'flag' => $flag]);
    }

    public function inquiries()
    {
        $list = App\Models\View_inquiry::where('user_id',Auth::user()->id)->paginate(5);
        $flag = true;
        if(count($list) == 0)
        {
            $flag = false;
        }

        return view('opac.inquiries',['list' => $list,'flag' => $flag]);
    }

    public function toReview()
    {

        $list = App\Models\View_to_review::where('user_id',Auth::user()->id)->whereNull('to_review')->paginate(5);

        $flag = true;
        if(count($list) == 0)
        {
            $flag = false;
        }

        //$list = App\Models\View_to_review::where('user_id',Auth::user()->id)->whereNull('to_review')->groupBy(['user_id','to_review'])->get();
        return view('opac.to-review',['list' => $list,'flag' => $flag]);
    }

}
