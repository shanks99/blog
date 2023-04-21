<?php

namespace App\Http\Controllers;

use App\Models\crud;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    private $crud;

    public function __construct(crud $crud) {
        // Laravel 의 IOC(Inversion of Control) 입니다
        // 일단은 이렇게 모델을 가져오는 것이 추천 코드라고 생각하시면 됩니다.
        $this->crud = $crud;
    }

    public function index() {
        // cruds 의 데이터를 최신순으로 페이징을 해서 가져옵니다.
        $cruds = $this->crud->latest()->paginate(10);
        // crud/index.blade 에 $crud 를 보내줍니다
        return view('cruds.index', compact('cruds')); //
    }
}