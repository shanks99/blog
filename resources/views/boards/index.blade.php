@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mt-4 mb-3">Board List</h2>

            @can('create',App\Models\Board::class)
            <div class="d-flex justify-content-end p-3">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('boards.create') }}'">등록</button>
            </div>
            @endcan

            <ul class="list-group">
                @foreach ($boards as $key => $board)
                    <li class="list-group-item">
                        <p>
                            <a href="{{ route('boards.show', $board->id) }}">{{ Str::limit($board->title, 50, '...') }}</a>
                        </p>
                        <div class="row justify-content-end p-1">
                            {{ $board->created_at->format('Y-m-d') }} |
                            {{ $board->user->name }}
                        </div>
                    </li>
                @endforeach
            </ul>

            {{-- 라라벨 기본 지원 페이지네이션 --}}
            <div class="d-flex justify-content-center p-3">
                {{ $boards->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
