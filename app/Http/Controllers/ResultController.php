<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MeiliSearch\Client;
use App;
use Auth;

class ResultController extends Controller
{

    public function index(Request $request)
    {
        // $client = new Client('http://127.0.0.1:7700', 'pwd123');
        // $client->index('view_holdings')->updateFilterableAttributes(['consortia','title_statement','summary','material_type_id']);
        
        if(Auth::check() && Auth::user()->usertype == 'Administrator')
        {  
            return redirect('/admin/dashboard');
        }

        if($request['series_statement_id'] != 0)
        {
            $result = App\Models\View_holding::where('series_statement_id',$request['series_statement_id'])->paginate(12);
            // $result->index('view_holdings')->where('series_statement_id',$request['series_statement_id'])->paginate(12);
        }
        else
        {
            if($request['seachtype'])
            {
                if(count($request['seachtype']) == '1')
                {
                    if($request['seachtype'][0] == 'all-material')
                        $result = App\Models\View_holding::search($request['query'])->paginate(12);
                        // $result->index('view_holdings')->search($request['query'])->paginate(12);
                    else
                        $result = App\Models\View_holding::search($request['query'])->where('material_type_id',$request['seachtype'][0])->paginate(12);
                        // $result->index('view_holdings')->search($request['query'])->where('material_type_id',$request['seachtype'][0])->paginate(12);
                }
                else
                {
                    $result = App\Models\View_holding::search($request['query'])->whereIn('material_type_id',$request['seachtype'])->paginate(12);
                    // $result->index('view_holdings')->search($request['query'])->whereIn('material_type_id',$request['seachtype'])->paginate(12);
                }
            }
            else
            {
                $result = App\Models\View_holding::search($request['query'])->paginate(12);
            }
        }
        

        if($request['layout'] == 'list')
            return view('opac.search-result-list',['result' => $result,'layout' => 'list']);
        else
            return view('opac.search-result-grid',['result' => $result,'layout' => 'grid']);

    }

    public function search()
    {
        $result = App\Models\View_holding::search('Banana')->paginate(10);
        return $result;
    }
}
