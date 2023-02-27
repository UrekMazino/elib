<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MeiliSearch\Client;
use App;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function dashboard()
    {
        return view('admin.index');
    }

    public function borrowed()
    {
        return view('admin.borrowed');
    }

    public function visit()
    {
        return view('admin.visits');
    }

    public function inquiry()
    {
        $list = App\Models\View_inquiry::get();
        return view('admin.inquiry',['list' => $list]);
    }

    public function inquiryjson()
    {
        $list = App\Models\View_inquiry::get();
        return $list;
    }

    public function patron()
    {
        return view('admin.patron');
    }

    public function report()
    {
        return view('admin.report');
    }

    public function reportprint()
    {

        //CHECK REPORT TYPE 
        switch (request()->typeReport) {
            case 1:
                    $table = 1;
                    if(request()->selectMaterial === ["0"])
                    {
                        $material = false;
                    }
                    else
                    {
                        $material = true;
                        $arrMaterial = request()->selectMaterial;
                    }

                    if(request()->selectSource === ["0"])
                    {
                        $source = false;
                    }
                    else
                    {
                        $source = true;
                        $arrSource = request()->selectSource;
                    }
                    

                    if($material && $source)
                    {
                        if(request()->keyword == '')
                            $list = App\Models\View_holding::whereIn('material_type_id',$arrMaterial)->whereIn('consortia',$arrSource)->get();
                        else
                            $list = App\Models\View_holding::search(request()->keyword)->whereIn('material_type_id',$arrMaterial)->whereIn('consortia',$arrSource)->get();
                    }
                    elseif(!$material && $source)
                    {
                        if(request()->keyword == '')
                            $list = App\Models\View_holding::whereIn('consortia',$arrSource)->get();
                        else
                            $list = App\Models\View_holding::search(request()->keyword)->whereIn('consortia',$arrSource)->get();
                    }
                    elseif($material && !$source)
                    {
                        if(request()->keyword == '')
                        $list = App\Models\View_holding::whereIn('material_type_id',$arrMaterial)->get();
                        else
                            $list = App\Models\View_holding::search(request()->keyword)->whereIn('material_type_id',$arrMaterial)->get();
                    }
                    elseif(!$material && !$source)
                    {
                        $list = App\Models\View_holding::search(request()->keyword)->get();
                    }
                    
            break;

            case 2:
                $table = 2;
                switch (request()->select_type) {
                    case 1:
                        $list = App\Models\User::whereDate('created_at',date("Y-m-d",strtotime(request()->filter_date_dt)))->get();
                    break;
                    case 2:
                        $list = App\Models\User::whereYear('created_at',request()->filter_month_year)->whereMonth('created_at',request()->filter_month_mon)->get();
                    break;
                    case 3:
                        $list = App\Models\User::whereYear('created_at',request()->filter_year_yr)->get();
                    break;
                    case 4:
                        $from = date("Y-m-d",strtotime(request()->start));
                        $end = date("Y-m-d",strtotime(request()->end));

                        $list = App\Models\User::whereBetween('created_at', [$from, $end])->get();
                    break;
                }
            break;

            case 4:
                $table = 3;
                switch (request()->select_type) {
                    case 1:
                        $list = App\Models\View_inquiry::whereDate('created_at',date("Y-m-d",strtotime(request()->filter_date_dt)))->get();
                    break;
                    case 2:
                        $list = App\Models\View_inquiry::whereYear('created_at',request()->filter_month_year)->whereMonth('created_at',request()->filter_month_mon)->get();
                    break;
                    case 3:
                        $list = App\Models\View_inquiry::whereYear('created_at',request()->filter_year_yr)->get();
                    break;
                    case 4:
                        $from = date("Y-m-d",strtotime(request()->start));
                        $end = date("Y-m-d",strtotime(request()->end));

                        $list = App\Models\View_inquiry::whereBetween('created_at', [$from, $end])->get();
                    break;
                }
            break;

            case 5:
                $table = 5;
                switch (request()->select_type) {
                    case 1:
                        $list = App\Models\View_inquiry::whereDate('created_at',date("Y-m-d",strtotime(request()->filter_date_dt)))->get();
                    break;
                    case 2:
                        $list = App\Models\View_inquiry::whereYear('created_at',request()->filter_month_year)->whereMonth('created_at',request()->filter_month_mon)->get();
                    break;
                    case 3:
                        $list = App\Models\View_inquiry::whereYear('created_at',request()->filter_year_yr)->get();
                    break;
                    case 4:
                        $from = date("Y-m-d",strtotime(request()->start));
                        $end = date("Y-m-d",strtotime(request()->end));

                        $list = App\Models\View_inquiry::whereBetween('created_at', [$from, $end])->get();
                    break;
                }
            break;
        }

        return view('admin.print-report',['table' => $table,'list' => $list]);
    }

    public function patronjson(Request $request)
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
        $totalRecords = App\Models\User::where('usertype','Patron')->count();
        $totalRecordswithFilter = App\Models\User::select('count(*) as allcount')->where('usertype','Patron')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = App\Models\User::orderBy($columnName,$columnSortOrder)
            ->where('usertype','Patron')
            ->where('name', 'like', '%' .$searchValue . '%')
            ->select('id','username','name','email','contactnum','location','created_at')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $username = $record->username;
            $name = $record->name;
            $email = $record->email;
            $contactnum = $record->contactnum;
            $location = $record->location;
            $created_at = date('Y-m-d H:i:s',strtotime($record->created_at));
            
 
            $data_arr[] = array(
                "id" => $id,
                "username" => $username,
                "name" => $name,
                "email" => $email,
                "contactnum" => $contactnum,
                "location" => $location,
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

    public function csfjson(Request $request)
    {
        $csfs = App\Models\Csf::orderBy('created_at', 'desc') ->select('id','user_id','rating1','rating2','rating3','rating4','rating5','rating6','rating7')->get();
        $r1 = $r2 = $r3 = $r4 = $r5 = $r6 = $r7 = ['o' => 0,'vs' => 0,'s' => 0,'us' => 0,'p' => 0];

        foreach($csfs as $csf) {
            // Tallying rating1's SQD
            if($csf->rating1 == 5) 
                $r1['o'] += 1;
            if($csf->rating1 == 4) 
                $r1['vs'] += 1;
            if($csf->rating1 == 3) 
                $r1['s'] += 1;
            if($csf->rating1 == 2) 
                $r1['us'] += 1;
            if($csf->rating1 == 1) 
                $r1['p'] += 1;
            
            // Tallying rating2's SQD
            if($csf->rating2 == 5) 
                $r2['o'] += 1;
            if($csf->rating2 == 4) 
                $r2['vs'] += 1;
            if($csf->rating2 == 3) 
                $r2['s'] += 1;
            if($csf->rating2 == 2) 
                $r2['us'] += 1;
            if($csf->rating2 == 1) 
                $r2['p'] += 1;

            // Tallying rating3's SQD
            if($csf->rating3 == 5) 
                $r3['o'] += 1;
            if($csf->rating3 == 4) 
                $r3['vs'] += 1;
            if($csf->rating3 == 3) 
                $r3['s'] += 1;
            if($csf->rating3 == 2) 
                $r3['us'] += 1;
            if($csf->rating3 == 1) 
                $r3['p'] += 1;

            // Tallying rating4's SQD
            if($csf->rating4 == 5) 
                $r4['o'] += 1;
            if($csf->rating4 == 4) 
                $r4['vs'] += 1;
            if($csf->rating4 == 3) 
                $r4['s'] += 1;
            if($csf->rating4 == 2) 
                $r4['us'] += 1;
            if($csf->rating4 == 1) 
                $r4['p'] += 1;

            // Tallying rating5's SQD
            if($csf->rating5 == 5) 
                $r5['o'] += 1;
            if($csf->rating5 == 4) 
                $r5['vs'] += 1;
            if($csf->rating5 == 3) 
                $r5['s'] += 1;
            if($csf->rating5 == 2) 
                $r5['us'] += 1;
            if($csf->rating5 == 1) 
                $r5['p'] += 1;

            // Tallying rating6's SQD
            if($csf->rating6 == 5) 
                $r6['o'] += 1;
            if($csf->rating6 == 4) 
                $r6['vs'] += 1;
            if($csf->rating6 == 3) 
                $r6['s'] += 1;
            if($csf->rating6 == 2) 
                $r6['us'] += 1;
            if($csf->rating6 == 1) 
                $r6['p'] += 1;

            // Tallying rating7's SQD
            if($csf->rating7 == 5) 
                $r7['o'] += 1;
            if($csf->rating7 == 4) 
                $r7['vs'] += 1;
            if($csf->rating7 == 3) 
                $r7['s'] += 1;
            if($csf->rating7 == 2) 
                $r7['us'] += 1;
            if($csf->rating7 == 1) 
                $r7['p'] += 1;
        }
        $response = ['r1' => $r1, 'r2' => $r2, 'r3' => $r3, 'r4' => $r4, 'r5' => $r5, 'r6' => $r6, 'r7' => $r7];

        return response()->json($response);
    }


}
