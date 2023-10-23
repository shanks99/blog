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
                            {{ $todo->created_at->format('Y-m-d') }}
                            @can('update', $todo)
                            <a href="{{ route('todos.edit', $todo) }}" class="btn btn-warning">수정</a>
                            @endcan

                            @can('delete', $todo)
                            <form action="{{ route('todos.destroy', $todo->id) }}" method="post" style="display: inline;">
                                {{-- delete method와 csrt 처리 필요 --}}
                                @method('delete')
                                @csrf
                                <button type="submit" onclick="return confirm('정말로 삭제 하시겠습니까?');"
                                    class="btn btn-danger">삭제</button>
                            </form>
                            @endcan
                        </div>
                    </li>
                @endforeach
            </ul>

            {{-- 라라벨 기본 지원 페이지네이션 --}}
            {{ $todos->links() }}
        </div>
    </div>
@endsection
