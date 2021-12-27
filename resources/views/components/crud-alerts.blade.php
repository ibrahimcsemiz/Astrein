@if (session('status'))
    <div {{ $attributes }}>
        <div class="font-medium @if(session('status') == 'success') text-green-600 @else text-red-600 @endif">
            {!! __(session('message')) !!}
        </div>
    </div>
@endif
