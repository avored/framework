<form {{ $attributes }} action="{{ $action }}" method="{{ (strtoupper($method) === 'GET') ? 'GET' : 'POST' }}">
    @csrf
    @if (strtoupper($method) === 'PUT')
        @method('put')
    @endif
    @if (strtoupper($method) === 'DELETE')
        @method('delete')
    @endif

    {{ $slot }}
</form>
