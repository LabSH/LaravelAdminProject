<?php

use Illuminate\Support\Facades\Route;

// 라우트등록1(멤버)
    use App\Http\Controllers\MemberController; 
// 라우트등록3(구분)
    use App\Http\Controllers\GubunController; 
// 라우트등록4(제품)
    use App\Http\Controllers\ProductController; 
// 라우트등록5(매입)
    use App\Http\Controllers\JangbuiController; 
// 라우트등록6(매출)
    use App\Http\Controllers\JangbuoController; 
// 라우트등록7(제품선택창)
    use App\Http\Controllers\FindproductController; 
// 라우트등록8(기간)
    use App\Http\Controllers\GiganController;
// 라우트등록9(통계)
    use App\Http\Controllers\BestController;
// 라우트등록10(크로스탭)
    use App\Http\Controllers\CrosstabController;
// 라우트등록10(차트)
    use App\Http\Controllers\ChartController;
// 라우트등록11(login)
    use App\Http\Controllers\LoginController;

// 라우트등록12(사진)
use App\Http\Controllers\PictureController;
// 라우트등록13(ajax)
use App\Http\Controllers\AjaxController;

// 라우트등록14(worker)
use App\Http\Controllers\WorkerController;

use App\Http\Controllers\CoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can regis ter web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

// 라우트등록2(검색)
    Route::get('member', [MemberController::class,'index']);
// 라우트등록1(구분)
    Route::resource('member',MemberController::class);
// 라우트등록3(멤버)
    Route::resource('gubun',GubunController::class);
// 라우트등록4(제품)
    Route::get('product/jaego', [ProductController::class,'jaego']);
    Route::resource('product',ProductController::class);
// 라우트등록5(매입)
    Route::resource('jangbui',JangbuiController::class);
// 라우트등록6(매출)
    Route::resource('jangbuo',JangbuoController::class);
// 라우트등록7(제품선택창)
    Route::resource('findproduct',findproductController::class);
// 엑셀이용
    Route::get('gigan/excel',[GiganController::class,'excel']);
// 라우트등록8(기간)
    Route::resource('gigan',GiganController::class);
// 라우트등록9(통계)
    Route::resource('best',BestController::class);
// 라우트등록10(크로스탭)
    Route::resource('crosstab',CrosstabController::class);
// 라우트등록10(차트)
    Route::resource('chart',ChartController::class);
// 라우트등록10(login)
    Route::post('login/check',[LoginController::class,'check']);
//로그아웃
    Route::get('login/logout',[LoginController::class,'logout']);
// 사진
    Route::resource('picture',PictureController::class);
// ajax
    Route::resource('ajax',AjaxController::class);

// 라우트등록14(worker)
Route::resource('worker',WorkerController::class);

Route::resource('co',CoController::class);
