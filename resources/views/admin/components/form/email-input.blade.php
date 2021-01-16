@php
    $name = isset($name) ? $name : 'email';
    $title = isset($title) ? $title : \Illuminate\Support\Str::title(str_replace('_', ' ', $name));
    $placeholder = isset($placeholder) ? $placeholder : $title;
    $hide_errors_list = isset($hide_errors_list);

    $attribs = $attribs ?? [];

    $attribs = array_merge([
        'class' => add_error_class($errors->has($name)),
        'placeholder' => $placeholder,
        'required' => !empty($required),
        'disabled' => !empty($disabled),
    ], $attribs);

    $value = isset($value) ? $value : old($name);

@endphp

<div class="mb-3">
    {!! Form::label($name, $title, ['class' => 'form-label']) !!}
    {!! Form::email($name, $value, $attribs) !!}

    @if(! $hide_errors_list)
        @include('errors._list', ['error' => $errors->get($name)])
    @endif
</div>
