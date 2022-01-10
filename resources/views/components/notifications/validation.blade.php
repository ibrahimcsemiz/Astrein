@if ($errors->any())
    <div role="alert" class="mb-2">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            {{ __('Whoops! Something went wrong.') }}
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif
