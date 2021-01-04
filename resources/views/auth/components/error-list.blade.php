@if ($errors->any())
    <div class="mb-4">
        <div class="font-weight-medium text-danger">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
