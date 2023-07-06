@if (session('status'))
    <div class="bg-green-500 text-white text-center px-4 py-2">
        {{ session('status') }}
    </div>
@endif
