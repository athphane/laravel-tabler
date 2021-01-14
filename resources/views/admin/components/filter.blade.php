<div class="card mb-4">
    <div class="card-body">
        <h4 class="card-title">{{ __('Filters') }}</h4>
        {{ $slot }}
        {!! Form::hidden('orderby', Request::input('orderby', old('orderby'))) !!}
        {!! Form::hidden('order',  Request::input('order', old('order'))) !!}
    </div>
</div>
