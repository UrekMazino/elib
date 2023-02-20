<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
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
        $totalRecords = App\Models\View_borrowed_book::count();
        $totalRecordswithFilter = App\Models\View_borrowed_book::select('count(*) as allcount')->where('title_statement', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = App\Models\View_borrowed_book::orderBy($columnName,$columnSortOrder)
            ->where('title_statement', 'like', '%' .$searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $title_statement = formatTitle1($record->title_statement);
            $fullname = $record->fullname."<br>".$record->contactnum."<br>".$record->email;
            $contactnum = $record->contactnum;
            $email = $record->email;
            $consortia_id = $record->consortia_id;
            $status = $record->status;
            $request_at_string = $record->request_at_string;
            $approved_at_string = $record->approved_at_string;
            $returned_at_string = $record->returned_at_string;
            $approved_by = $record->approved_by;
            $total_days = $record->total_days;
            
 
            $data_arr[] = array(
                "id" => $id,
                "title_statement" => $title_statement,
                "fullname" => $fullname,
                "contactnum" => $contactnum,
                "email" => $email,
                "consortia_id" => $consortia_id,
                "status" => $status,
                "request_at_string" => $request_at_string,
                "approved_at_string" => $approved_at_string,
                "returned_at_string" => $returned_at_string,
                "approved_by" => $approved_by,
                "total_days" => $total_days,
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

    public function action()
    {
        switch(request()->borrowed_action)
        {
            case 1:
                $borrowed = App\Models\Barrowed_book::where('id',request()->borrowed_id)
                            ->update([
                               'status' => 'Borrowed',
                               'approved_at' => date('Y-m-d H:i:s'),  
                               'approved_by' => Auth::user()->name     
                            ]);
                break;
            case 2:
                $borrowed = App\Models\Barrowed_book::where('id',request()->borrowed_id)->delete();
                break;
            case 3:
                $borrowed = App\Models\Barrowed_book::where('id',request()->borrowed_id)
                            ->update([
                               'status' => 'Returned',
                               'returned_at' => date('Y-m-d H:i:s'),  
                               'update_return_by' => Auth::user()->name     
                            ]);
                break;
        }

        return redirect('admin/borrowed');
    }
}
