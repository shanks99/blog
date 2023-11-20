<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardReplyRequest;
use App\Http\Requests\UpdateBoardReplyRequest;
use App\Models\BoardReply;
use Auth;

class BoardReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoardReplyRequest $request)
    {
        // Val
        $validate = $request->validated();

        $reply_deep = 0;
        $reply_re_sort = 1;

        // 댓글 deep, re_sort 구하기
        // -- deep
        if( !is_null($validate['reply_id'])) {
            $reply_parent_data = BoardReply::find($validate['reply_id']);
            $reply_deep = $reply_parent_data->deep + 1;
        }

        // -- re_sort
        $reply_deep_sort_data = BoardReply::
            where('board_id', $validate['board_id'])
            ->where('deep','=',$reply_deep)
            ->orderBy('re_sort','desc')->first();
        $reply_re_sort = $reply_deep_sort_data->re_sort + 1;

        BoardReply::create([
            'user_id'=> Auth::user()->id,
            'board_id'=> $validate['board_id'],
            'deep'=> $reply_deep,
            're_sort'=> $reply_re_sort,
            'comment'=> $validate['comment'],
        ]);

        return redirect()->back();
        // return redirect()->route('boards.show', [$validate['board_id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BoardReply $boardReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BoardReply $boardReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoardReplyRequest $request, BoardReply $boardReply)
    {
        $validate = $request->validated();

        BoardReply::where("id", $boardReply->id)->update([
            'content'=> $validate['content'],
        ]);

        return redirect()->back();
        // return redirect()->route('boards.show', [$validate['board_id']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BoardReply $boardReply)
    {
        $boardReply->delete();

        return redirect()->back();
    }
}
