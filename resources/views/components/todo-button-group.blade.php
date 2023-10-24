<div>
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
