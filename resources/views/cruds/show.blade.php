{{-- layout 으로 --}}
@extends('layouts.app')

{{-- 아래 html 을 @yield('content') 에 보낸다고 생각하시면 됩니다. --}}
@section('content')
    <div class="container">
        <h2 class="mt-4 mb-3">Crud View: {{ $crud->name }}</h2>
        <p class="pt-2 text-right">{{ $crud->created_at }}</p>

        <div class="content mt-4 rounded-3 border border-secondary">
            <div class="p-3">{{ $crud->content }}</div>
        </div>
    </div>
@endsection
