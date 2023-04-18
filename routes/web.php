<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

# 기본 라우트 생성하기
// Route::get('foo', function () {
//     return 'hello';
// });

# URL 세그먼트가 있는 라이우트 생성
// Route::get('foo/{name}', function ($name) {
//     return 'Hello '.$name;
// });

# 다양한 요청 메소드
/*기본 HTTP 메소드 매핑*/
// Route::get($uri, $action);
// Route::post($uri, $action);
// Route::put($uri, $action);
// Route::patch($uri, $action);
// Route::delete($uri, $action);
// Route::options($uri, $action); 

/*다수의 HTTP 메소드의 한 번에 매핑해야할 때는 match 메소드를 사용합니다.*/
// Route::match(['get', 'post'], '/', $action);

/*모든 HTTP 메소드의 매핑해야할 때는 any 메소드를 사용합니다.*/
// Route::any('foo', $action);

# 리다이렉트 라우트
// Route::redirect('/here', '/there', 301);

# 뷰 라우트
// Route::view('/foo', $action);
// Route::view('/foo', $action, ['name' => 'roadJeong']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');