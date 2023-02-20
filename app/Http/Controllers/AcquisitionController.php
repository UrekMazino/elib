<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MeiliSearch\Client;
use App;
use Auth;

class AcquisitionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        return view('admin.catalog');
    }

    public function uncatalog()
    {
        return view('admin.uncatalog');
    }

    public function catalogjson(Request $request)
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
        $totalRecords = App\Models\View_holding::count();
        $totalRecordswithFilter = App\Models\View_holding::select('count(*) as allcount')
        ->where('title_statement', 'like', '%' .$searchValue . '%')
        ->Orwhere('joint_authors', 'like', '%' .$searchValue . '%')
        ->whereNotNull('catalog_date')->count();

        // Fetch records
        $records = App\Models\View_holding::orderBy($columnName,$columnSortOrder)
            ->where('title_statement', 'like', '%' .$searchValue . '%')
            ->orWhere('joint_authors', 'like', '%' .$searchValue . '%')
            ->whereNotNull('catalog_date')
            ->select('holdings_id','title_statement','material','joint_authors','id','catalog_date','catalog_status','CreatedBy','created_at','consortia')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $holdings_id = $record->holdings_id;
            $title_statement = formatTitle1($record->title_statement);
            $material = $record->material;
            $joint_authors = $record->joint_authors;
            $catalog_date = $record->catalog_date;
            $catalog_status = $record->catalog_status;
            $CreatedBy = $record->CreatedBy;
            $created_at = $record->created_at;
            $consortia = $record->consortia;
            
 
            $data_arr[] = array(
                "id" => $id,
                "holdings_id" => $holdings_id,
                "title_statement" => $title_statement,
                "material" => $material,
                "joint_authors" => $joint_authors,
                "catalog_date" => $catalog_date,
                "catalog_status" => $catalog_status,
                "CreatedBy" => $CreatedBy,
                "created_at" => $created_at,
                "consortia" => $consortia,
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

    public function uncatalogjson(Request $request)
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
        $totalRecords = App\Models\View_holding_uncatalog::count();
        $totalRecordswithFilter = App\Models\View_holding_uncatalog::select('count(*) as allcount')
        ->where('title_statement', 'like', '%' .$searchValue . '%')
        ->count();

        // Fetch records
        $records = App\Models\View_holding_uncatalog::orderBy($columnName,$columnSortOrder)
            ->whereNull('catalog_date')
            ->where('title_statement', 'like', '%' .$searchValue . '%')
            ->select('holdings_id','title_statement','material','joint_authors','id','catalog_date','catalog_status','CreatedBy','created_at','consortia')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $holdings_id = $record->holdings_id;
            $title_statement = formatTitle1($record->title_statement);
            $material = $record->material;
            $joint_authors = $record->joint_authors;
            $catalog_date = $record->catalog_date;
            $catalog_status = $record->catalog_status;
            $CreatedBy = $record->CreatedBy;
            $created_at = $record->created_at;
            $consortia = $record->consortia;
            
 
            $data_arr[] = array(
                "id" => $id,
                "holdings_id" => $holdings_id,
                "title_statement" => $title_statement,
                "material" => $material,
                "joint_authors" => $joint_authors,
                "catalog_date" => $catalog_date,
                "catalog_status" => $catalog_status,
                "CreatedBy" => $CreatedBy,
                "created_at" => $created_at,
                "consortia" => $consortia,
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

    public function index2()
    {
        return view('admin.acquisition-new');
    }

    public function create()
    {
        //$path = disk('s3')->request()->file('formCover')->store('coverpage');
        //return request()->file('formCover');

        $lastid = App\Models\Holding::orderBy('id', 'DESC')->first();
        $holdingsid = "PCRD-".($lastid['id'] + 1);

        $holding = new App\Models\Holding;
        
        //REQUIRED FIELD
        $holding->holdings_id  = $holdingsid;
        $holding->material_type_id  = request()->material_id;
        $holding->title_statement  = request()->title_statement;
        $holding->accession_number  = request()->accession_number;
        $holding->circulation_number  = request()->circulation_number;
        $holding->CreatedBy = Auth::user()->name;
        $holding->copy_number  = request()->copy_number;


        //OPTIONAL
        $holding->ISSN  = request()->issn;
        $holding->ISSN  = request()->issn;
        $holding->classifications_system  = request()->classifications_system;
        $holding->classification_number  = request()->classification_number;
        $holding->author_number  = request()->author_number;
        $holding->copyright_date  = request()->copyright_date;
        $holding->title_remainder  = request()->title_remainder;
        $holding->statement_responsibility  = request()->statement_responsibility;
        $holding->edition_statement  = request()->edition_statement;
        $holding->edition_statement_remainder  = request()->edition_statement_remainder;
        $holding->imprint  = request()->imprint;
        $holding->type_of_imprint  = request()->type_of_imprint;
        $holding->edition_statement_remainder  = request()->edition_statement_remainder;
        $holding->publication_place  = request()->publication_place;
        $holding->publisher  = request()->publisher;
        $holding->publication_date  = request()->publication_date;
        $holding->extent  = request()->extent;
        $holding->other_physical  = request()->other_physical;
        $holding->dimension  = request()->dimension;
        $holding->frequency  = request()->frequency;
        $holding->volume  = request()->volume;
        $holding->issue_number  = request()->issue_number;
        $holding->series_statement_id  = request()->series_statement_id;
        $holding->bibliography  = request()->bibliography;
        $holding->date_acquired  = request()->date_acquired;
        $holding->user_restriction  = request()->user_restriction;
        $holding->item_status  = request()->item_status;
        $holding->temporary_location  = request()->temporary_location;
        $holding->nonpublic_note  = request()->nonpublic_note;
        
        
        $holding->consortia_id   = 16;
        
        $holding->save();

        //AUTHOR
        $author = new App\Models\Author;
        $author->holdings_id  = $holdingsid;
        $author->AuthorTag = request()->author_type;
        $author->author_name2 = request()->author_name;
        $author->CreatedBy = Auth::user()->name;
        $author->numeration = request()->numeration;
        $author->title_and_words = request()->title_and_words;
        $author->relator_term = request()->relator_term;
        $author->date_associated = request()->date_associated;
        $author->fuller_form = request()->fuller_form;
        $author->affiliation = request()->affiliation;
        $author->save();

        //ADDITIONAL AUTHOR
        if(isset(request()->add_author_check))
        {
            $author = new App\Models\Author;
            $author->holdings_id  = $holdingsid;
            $author->AuthorTag = request()->author_type2;
            $author->author_name2 = request()->author_name2;
            $author->CreatedBy = Auth::user()->name;
            $author->numeration = request()->numeration2;
            $author->title_and_words = request()->title_and_words2;
            $author->relator_term = request()->relator_term2;
            $author->date_associated = Authrequest()->ate_associated2;
            $author->fuller_form = request()->fuller_form2;
            $author->affiliation = request()->affiliation2;
            $author->save();
        }

        //CORPORATE AUTHOR
        if(isset(request()->cauthor_type))
        {
            $cauthor = new App\Models\Corporate_author;
            $cauthor->holdings_id  = $holdingsid;
            $cauthor->author_type = request()->cauthor_type;
            $cauthor->author_name = request()->cauthor_name;
            $cauthor->subordinate_unit = request()->subordinate_unit;
            $cauthor->location_meeting = request()->location_meeting;
            $cauthor->date_of_meeting = request()->date_of_meeting;
            $cauthor->number_of_part = request()->number_of_part;
            $cauthor->save();
        }

        //ADD CORPORATE AUTHOR
        if(isset(request()->cauthor_type2))
        {
            $cauthor = new App\Models\Corporate_author;
            $cauthor->holdings_id  = $holdingsid;
            $cauthor->author_type = request()->cauthor_type2;
            $cauthor->author_name = request()->cauthor_name2;
            $cauthor->subordinate_unit = request()->subordinate_unit2;
            $cauthor->location_meeting = request()->location_meeting2;
            $cauthor->date_of_meeting = request()->date_of_meeting2;
            $cauthor->number_of_part = request()->number_of_part2;
            $cauthor->save();
        }

        //COVER PHOTO
        if(isset(request()->formCover))
        {
            $frontpage_path = request()->file('formCover')->store(
                'frontpages', 'public'
            );
    
            $frontpage = new App\Models\Frontpage;
            $frontpage->holdings_id  = $holdingsid;
            $frontpage->FrontPageLocation = $frontpage_path;
            $frontpage->save();
        }
        


        //PDF
        if(isset(request()->formPDF))
        {
            $pdf_path = request()->file('formPDF')->store(
                'pdf/upload', 'public'
            );

            $pdf = new App\Models\Multimedia;
            $pdf->holdings_id  = $holdingsid;
            $pdf->FileLocation = $pdf_path;
            $pdf->save();
        }

        return redirect('admin/catalog');
    }

    public function editview()
    {
        return view('admin.acquisition-edit');
    }

    public function delete()
    {
        //return request()->action_holding_id;
        App\Models\Holding::where('id',request()->action_holding_id)->delete();
        return redirect(request()->url);
    }

    public function setas()
    {
        App\Models\Holding::where('id',request()->action_holding_id)
        ->update([
                    'catalog_date' => request()->catalog_date
                ]);
        return redirect(request()->url);
    }

}