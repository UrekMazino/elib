<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','patron']);
    }

    public function index()
    {
       return view('opac.review',['holdings_id' => request()->holdings_id,'download_id' => request()->download_id]);
    }

    public function create()
    {
      //SAVE REVIEW
       $review = new App\Models\Rating;
       $review->holdings_id = request()->holdings_id;
       $review->user_id = Auth::user()->id;
       $review->rating = request()->rating_input;
       $review->remarks = request()->remarks;
       $review->save();

       //IF FOR REVIEW
       if(isset(request()->download_id))
       {
         App\Models\Download::where('id',request()->download_id)->update(['to_review' => date('Y-m-d')]);
       }

       return view('opac.thank-you',['message' => 'Thanks for your review!']);
    }

    // public function thanks()
    // {
    //    return view('opac.thank-you');
    // }
}
