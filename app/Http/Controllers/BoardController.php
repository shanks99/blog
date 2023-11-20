<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Models\Board;
use Auth;
use Illuminate\Support\Carbon;

class BoardController extends Controller
{
    public function __construct(board $board) {
        $this->middleware("auth", ["except"=> ["index","show"]]); // 회원만 이용 가능 (단, 일부는 허용)
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boards = board::
            with("user")
            ->withCount("board_replys") // 댓글수
            ->withExists(["board_replys as recent_board_replys_exists"=> function($query){
                $query->where("created_at",">", Carbon::now()->subDays());
            }]) // [New] 표시
            ->orderBy('id','asc')
            ->paginate(5);

        // return $boards;
        return view("boards.index", compact("boards"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("boards.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoardRequest $request)
    {
        $validate = $request->validated();

        $board = board::create([
            'user_id' => Auth::user()->id,
            'title' => $validate['title'],
            'content' => $validate['content'],
        ]);

        return redirect()->route('boards.show', compact('board'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
        $board->load("user");
        $board->load("board_replys.user"); // 다중 호출이 되어 미리 불러옴
        $board->loadCount('board_replys'); // 연관된 댓글 카운트

        return view('boards.show', compact('board'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        return view('boards.edit', compact('board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
        $validate = $request->validated();

        board::where("id", $board->id)->update([
            "title"=> $validate["title"],
            "content"=> $validate["content"],
        ]);

        return redirect()->route("boards.show", compact("board"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        $board->delete();

        return redirect()->route("boards.index");
    }
}
