@unless(empty($error))
    <ul class="invalid-feedback">
        @foreach($error as $error_text)
            <li>{{ $error_text }}</li>
        @endforeach
    </ul>
@endunless
