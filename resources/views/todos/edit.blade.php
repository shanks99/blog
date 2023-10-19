{{-- layout 으로 --}}
@extends('layouts.app')

{{-- 아래 html 을 @yield('content') 에 보낸다고 생각하시면 됩니다. --}}
@section('content')
    <div class="container">
        <h2 class="mt-4 mb-3">todo Edit</h2>

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

        <form action="{{ route('todos.update', $todo) }}" method="post">
            {{-- 라라벨은 CSRF로 부터 보호하기 위해 데이터를 등록할 때의 위조를 체크 하기 위해 아래 코드가 필수 --}}
            @csrf
            {{-- 라라벨 patch 메소드 사용 --}}
            @method('patch')
            <div class="mb-3">
                {{ $todo->user_id }}
            </div>
            <div class="mb-3">
                {{-- <label for="content" class="form-label">Content</label> --}}
                <textarea rows="10" cols="40" name="content" class="form-control" id="name" autocomplete="off">{{ $todo->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('todos.index') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
@endsection
