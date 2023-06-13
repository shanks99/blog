<?php

namespace App\Http\Controllers;

use App\Models\crud;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    ## Init
    private $crud;

    public function __construct(crud $crud) {
        // Laravel 의 IOC(Inversion of Control) 입니다
        // 일단은 이렇게 모델을 가져오는 것이 추천 코드라고 생각하시면 됩니다.
        $this->crud = $crud;
    }

    ## List
    public function index() {
        // cruds 의 데이터를 최신순으로 페이징을 해서 가져옵니다.
        $cruds = $this->crud->latest()->paginate(10);

        // crud/index.blade 에 $crud 를 보내줍니다
        return view('cruds.index', compact('cruds')); //
    }

    ## Write
    public function create() {
        // 등록
        return view('cruds.create');
    }

    public function store(Request $request)
    {
        // Request 에 대한 유효성 검사, 다양한 종류가 있기에 공식문서를 보시는 걸 추천드립니다.
        // 유효성에 걸린 에러는 errors 에 담깁니다.
        $validataedData = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',
        ]);

        $crud = new Crud;
        $crud->name = $validataedData['name'];
        $crud->content = $validataedData['content'];
        $crud->save();

        return redirect()->route('cruds.index');
    }

    ## Read
    // Crud 전체로 받는 방법
    public function show(Crud $crud) {
        return view('cruds.show', compact('crud'));
    }
    // id만 받는 방법
    /*
    public function show($id) {
        $crud = Crud::find($id);
        return view('cruds.show', compact('crud'));
    }
    */

    ## Modify
    public function edit(Crud $crud) {
        return view('cruds.edit', compact('crud'));
    }

    public function update(Request $request, Crud $crud) {
        $validataedData = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required'
        ]);

        // $crud는 수정할 모델 값이므로 바로 업데이트 해줍시다
        $crud->name = $validataedData['name'];
        $crud->content = $validataedData['content'];
        $crud->update();

        return redirect()->route('cruds.index', $crud);
    }

    ## Delete
    public function destroy(Crud $crud) {
        $crud->delete();
        return redirect()->route('cruds.index');
    }
}
