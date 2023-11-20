{{-- layout 으로 --}}
@extends('layouts.app')

{{-- 아래 html 을 @yield('content') 에 보낸다고 생각하시면 됩니다. --}}
@section('content')
    <div class="container">
        <h2 class="mt-4 mb-3">Board View</h2>

        <div class="mt-4">
            <h1 class="p-3">{!! nl2br($board->title) !!}</h1>
        </div>

        <div class="content mt-4 d-flex justify-content-end">
            {{ $board->user->name }} |
            {{ $board->created_at->format('Y-m-d') }} |
            댓글 : {{ $board->board_replys_count }}
        </div>

        <div class="content mt-4 rounded-3 border border-secondary">
            <div class="p-3">{!! nl2br($board->content) !!}</div>
        </div>

        <div class="content mt-4 d-flex justify-content-end">
            <a href="{{ route('boards.index') }}" class="btn btn-dark">목록</a>&nbsp;

            @can('update', $board)
            <a href="{{ route('boards.edit', $board) }}" class="btn btn-warning">수정</a>&nbsp;
            @endcan

            @can('delete', $board)
            <form action="{{ route('boards.destroy', $board->id) }}" method="post" style="display: inline;">
                {{-- delete method와 csrt 처리 필요 --}}
                @method('delete')
                @csrf
                <button type="submit" onclick="return confirm('정말로 삭제 하시겠습니까?');"
                    class="btn btn-danger">삭제</button>
            </form>
            @endcan
        </div>

        <!-- 댓글 영역 시작 -->
        <div class="content mt-4">
            <!-- Create Form 시작 -->
            {{-- 유효성 검사에 걸렸을 경우 --}}
            @if ($errors->any())
                <div class="alert alert-warning" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('board_replys.store') }}" method="post">
                @csrf
                <input type="hidden" name="board_id" id="board_id" value="{{ $board->id }}" />
                <input type="hidden" name="reply_id" id="reply_id" value="" />
                <div class="mb-3">
                    <textarea rows="2" cols="40" name="comment" class="form-control" id="comment" autocomplete="off"></textarea>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">댓글 등록</button>
                </div>
            </form>
            <!-- Create Form 끝 -->

            <!-- List 시작 -->
            <ul class="list-group mt-4">
                @foreach ($board->board_replys as $reply)
                    <li class="list-group-item">
                        <p>
                            {{ $reply->comment }}
                        </p>
                        <div class="d-flex justify-content-end">
                            {{ $reply->created_at->diffForHumans() }} |
                            {{ $reply->user->name }} |

                            <button type="button" class="btn btn-primary btn-sm">답변</button>&nbsp;

                            @can('update', $reply)
                            <a href="{{ route('board_replys.edit', $reply) }}" class="btn btn-warning btn-sm">수정</a>&nbsp;
                            @endcan

                            @can('delete', $reply)
                            <form action="{{ route('board_replys.destroy', $reply->id) }}" method="post" style="display: inline;">
                                {{-- delete method와 csrt 처리 필요 --}}
                                @method('delete')
                                @csrf
                                <button type="submit" onclick="return confirm('정말로 삭제 하시겠습니까?');" class="btn btn-danger btn-sm">삭제</button>
                            </form>
                            @endcan
                        </div>
                    </li>
                @endforeach
            </ul>
            <!-- List 끝 -->
        </div>
        <!-- 댓글 영역 끝 -->
    </div>
@endsection
