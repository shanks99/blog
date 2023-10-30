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
    </div>
@endsection
