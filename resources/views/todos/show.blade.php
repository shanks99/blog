{{-- layout 으로 --}}
@extends('layouts.app')

{{-- 아래 html 을 @yield('content') 에 보낸다고 생각하시면 됩니다. --}}
@section('content')
    <div class="container">
        <h2 class="mt-4 mb-3">todo View: {{ $user->name }}</h2>
        <p class="pt-2 text-right">
            {{ $todo->created_at->format('Y-m-d') }} |
            <span>댓글 {{ $todo->comments_count }}</span>
        </p>

        <div class="content mt-4 rounded-3 border border-secondary">
            <div class="p-3">{!! nl2br($todo->content) !!}</div>
        </div>
        <x-todo-button-group :todo=$todo />

        <!-- 댓글 영역 시작 -->
        <div>
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

            <form action="{{ route('comments.store') }}" method="post">
                @csrf
                <input type="hidden" name="todo_id" id="todo_id" value="{{ $todo->id }}" />
                <div class="mb-3">
                    <textarea rows="2" cols="40" name="body" class="form-control" id="body" autocomplete="off"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">댓글 등록</button>
            </form>
            <!-- Create Form 끝 -->

            <!-- List 시작 -->
            <ul class="list-group">
                @foreach ($todo->comments as $comment)
                    <li class="list-group-item">
                        <p>
                            {{ $comment->body }}
                        </p>
                        <div>
                            {{ $comment->created_at->diffForHumans() }}
                            {{ $comment->user->name }}
                        </div>
                    </li>
                @endforeach
            </ul>
            <!-- List 끝 -->
        </div>
        <!-- 댓글 영역 끝 -->
    </div>
@endsection
