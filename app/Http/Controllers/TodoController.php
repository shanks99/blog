<?php

namespace App\Http\Controllers;

use App\Models\todo;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    ## Init
    private $todo;

    public function __construct(todo $todo) {
        $this->middleware("auth", ["except"=> ["index","show"]]); // 회원만 이용 가능 (단, 일부는 허용)

        $this->todo = $todo;
    }

    /*
     * List
    */
    public function index() {
        $todos = $this->todo->latest()->paginate(5);

        return view("todos.index", compact("todos"));
    }

    /*
     * create & store
    */
    public function create() {
        return view("todos.create");
    }

    public function store(Request $request) {
        $validate = $request->validate([
            "content"=> "required",
        ]);

        todo::create([
            "user_id"=> Auth::user()->id,
            "content"=> $validate['content'],
        ]);

        return redirect()->route("todos.index");
    }

    /*
     * show
    */
    public function show(Todo $todo) {
        $user = User::find($todo->user_id);

        return view("todos.show", compact(["todo","user"]));
    }

    /*
     * edit & update
    */
    public function edit(Todo $todo) {
        return view("todos.edit", compact("todo"));
    }

    public function update(Request $request, Todo $todo) {
        $this->authorize("update", $todo);

        $validate = $request->validate([
            "content"=> "required",
        ]);

        todo::where("id", $todo->id)->update([
            "content"=> $validate['content'],
        ]);

        return redirect()->route("todos.show", compact("todo"));
    }

    /*
     * destory
    */
    public function destroy(Todo $todo) {
        $this->authorize("delete", $todo);

        $todo->delete();

        return redirect()->route("todos.index");
    }
}
