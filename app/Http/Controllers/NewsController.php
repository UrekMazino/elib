<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        return view('admin.news');
    }

    public function index2()
    {
        return view('admin.add-news');
    }

    public function create()
    {
        //COVER PHOTO
        $news_cover = request()->file('news_cover')->store(
            'news_cover', 'public'
        );

        $news = new App\Models\News;
        $news->news_title = request()->news_title;
        $news->news_cover = $news_cover;
        $news->news_body = request()->news_body;
        $news->created_by = Auth::user()->name;
        $news->save();

        return redirect('/admin/news');
    }

    public function json(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = App\Models\News::count();
        $totalRecordswithFilter = App\Models\News::select('count(*) as allcount')->where('news_title', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = App\Models\News::orderBy($columnName,$columnSortOrder)
            ->where('news_title', 'like', '%' .$searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $news_title = $record->news_title;
            $featured = $record->featured;
            $created_by = $record->created_by;
            $created_at = $record->created_at;
            
 
            $data_arr[] = array(
                "id" => $id,
                "news_title" => $news_title,
                "featured" => $featured,
                "created_by" => $created_by,
                "created_at" => $created_at,
            );
         }

         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
         );
 
         return response()->json($response); 

    }
}
