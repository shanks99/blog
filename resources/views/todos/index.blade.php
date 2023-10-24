@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mt-4 mb-3">todo List</h2>

            @can('create',App\Models\Todo::class)
            <a href="{{ route('todos.create') }}">
                <button type="button" class="btn btn-dark" style="float: right;">Create</button>
            </a>
            @endcan

            <ul class="list-group">
                @foreach ($todos as $key => $todo)
                    <li class="list-group-item">
                        <p>
                            <a href="{{ route('todos.show', $todo->id) }}">{{ Str::limit($todo->content, 20, '...') }}</a>
                        </p>
                        <div>
                            {{ $todo->created_at->format('Y-m-d') }} |
                            <span>댓글 {{ $todo->comments_count }}</span>
                            @if ($todo->recent_comments_exists)
                            [New]
                            @endif
                        </div>
                        <x-todo-button-group :todo=$todo />
                    </li>
                @endforeach
            </ul>

            {{-- 라라벨 기본 지원 페이지네이션 --}}
            {{ $todos->links() }}
        </div>
    </div>
@endsection
