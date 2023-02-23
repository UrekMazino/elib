<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return "hello";
// });

// Route::get('/search-result', function () {
//     return view('opac.search-result');
// });

// Route::get('/full-description', function () {
//     return view('opac.full-description');
// });

// Route::get('/dashboard', function () {
//     return view('admin.index');
// })->middleware(['auth'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index']);

require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return redirect('/home');
// });


//RESULTS
use App\Http\Controllers\ResultController;
//Route::post('/results', [ResultController::class, 'index']);
Route::get('/results', [ResultController::class, 'index']);



//FULL DESCRIPTION
use App\Http\Controllers\HoldingController;
Route::controller(HoldingController::class)->group(function () {
    Route::post('/full-description', 'index');
    Route::get('/full-description', 'index2');
    Route::get('/full-description/{holdingsid}', 'index2');
});

//OPAC
use App\Http\Controllers\OPACController;
Route::controller(OPACController::class)->group(function () {
    Route::get('/profile', 'profile');
    Route::get('/barrowed', 'barrowed');
    Route::get('/to-review', 'toReview');
    Route::get('/inquiries', 'inquiries');
});


use App\Http\Controllers\DownloadController;
Route::controller(DownloadController::class)->group(function () {
    Route::post('/download', 'index');
});

//INQUIRY
use App\Http\Controllers\InquiryController;
Route::controller(InquiryController::class)->group(function () {
    Route::post('/inquiry/submit', 'create');
    Route::post('/inquiry/reply', 'reply');
    Route::get('/inquiry/get/{id}', 'json1');
    Route::get('/inquiry/json/{id}', 'json2');
    Route::get('/inquiry/seen/{id}', 'seen');
});


//REVIEW
use App\Http\Controllers\ReviewController;
Route::controller(ReviewController::class)->group(function () {
    Route::post('/review', 'index');
    Route::post('/review/submit', 'create');
});


//VISIT
use App\Http\Controllers\VisitGuestController;
Route::controller(VisitGuestController::class)->group(function () {
    Route::post('/visit/guest', 'create');
});

use App\Http\Controllers\VisitController;
Route::controller(VisitController::class)->group(function () {
    Route::post('/visit/patron', 'create');
});

//ADMIN
use App\Http\Controllers\AdminController;
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/dashboard', 'dashboard');

    Route::get('/admin/borrowed', 'borrowed');
    Route::get('/admin/visits', 'visit');
    
    Route::get('/admin/inquiry', 'inquiry');
    Route::get('/admin/inquiry/json', 'inquiryjson');
    
    Route::get('/admin/patron', 'patron');

    Route::get('/admin/report', 'report');

    Route::post('/admin/print-report', 'reportprint');

    Route::get('/admin/patron/json', 'patronjson');
    Route::get('/admin/csf/json', 'csfjson');

});

//ADMIN
use App\Http\Controllers\AcquisitionController;
Route::controller(AcquisitionController::class)->group(function () {
        
    // Route::get('/admin/acquisition', 'index');
    Route::get('/admin/new-acquisition', 'index2');
    Route::post('/admin/acquisition/create', 'create');
    Route::post('/admin/edit-acquisition-view', 'editview');
    Route::post('/admin/delete-acquisition', 'delete');
    Route::post('/admin/set-as-acquisition', 'setas');

    Route::get('/admin/catalog', 'index');
    Route::get('/admin/catalog/json', 'catalogjson');

    Route::get('/admin/uncat', 'uncatalog');
    Route::get('/admin/uncatalog/json', 'uncatalogjson');

});

use App\Http\Controllers\BorrowController;
Route::controller(BorrowController::class)->group(function () {
        
    Route::get('/admin/borrowed/json', 'json');
    Route::post('/admin/borrowed/action', 'action');

});

use App\Http\Controllers\NewsController;
Route::controller(NewsController::class)->group(function () {
    
    Route::get('/admin/news', 'index');
    Route::get('/admin/news/add', 'index2');
    Route::post('/admin/news/create', 'create');
    Route::get('/admin/news/json', 'json');

});

use App\Http\Controllers\CsfController;
Route::controller(CsfController::class)->group(function () {
    
    Route::get('/csf', 'index');
    Route::get('/csf/system-review', 'create');
    Route::post('/csf/store', 'store');

});


// Route::get('list', function () {
//     $list = App\Models\Holding::where('title_statement','like','%$b%')->get();
//     foreach($list AS $lists){
//         $title = explode('$b',$lists->title_statement);
//         //$title = explode('$b',$title[]);
//         $remain = null;

//         if(isset($title[1]))
//         {
//             $title2 = explode('$c',$title[1]);

//             if(isset($title2[1]))
//             {
//                 $remain = $title2[0];
//                 echo $lists->title_statement." | Remainder : ".$title2[0]." - Responsibility : ".$title2[1]."<hr/>";
//             }   
//             else
//             {
//                 echo $lists->title_statement." | Remainder ".$title[1]." - Responsibility : N/A<hr/>";
//             }
                
//         }
//         else
//         {
//             $title2 = explode('$c',$title[1]);

//             if(isset($title2[1]))
//                 echo $lists->title_statement." | Remainder N/A - Responsibility : ".$title2[1]."<hr/>";
//             else
//                 echo $lists->title_statement." | Remainder N/A - Responsibility : N/A<hr/>";
//         }


//         App\Models\Holding::where('id',$lists->id)->update(['title_remainder' => $remain]);
//     }
// });

Route::get('update-copy', function () {
        $list = App\Models\Holdingcopy::whereNull('acquisition_modes')->where('AcquisitionMode',5)->get();
        foreach ($list as $key => $value) {
            $modes = null;

            switch ($value->AcquisitionMode) {
                case 1:
                        $modes = "Purchase";
                    break;
                case 2:
                        $modes = "Subscription";
                    break;
                case 3:
                        $modes = "Donation";
                    break;
                case 4:
                        $modes = "Complimentary";
                    break;
                case 5:
                        $modes = "Exchange";
                    break;
                case 6:
                        $modes = "Download";
                    break;
            
            }

            App\Models\Holdingcopy::where('HoldingsCopyID',$value->HoldingsCopyID)->update(['acquisition_modes' => $modes]);

        }
    });


Route::get('/status', function () {
    $status = ["status" => true];

    return $status;
});