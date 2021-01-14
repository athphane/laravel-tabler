@php
    $name = isset($name) ? $name : 'name';
    $title = isset($title) ? $title : \Illuminate\Support\Str::title(str_replace('_', ' ', $name));
    $placeholder = isset($placeholder) ? $placeholder : $title;
    $hide_errors_list = isset($hide_errors_list);

    $attribs = $attribs ?? [];

    $attribs = array_merge([
        'class' => add_error_class($errors->has($name)) . ' select2-basic',
        'data-placeholder' => $placeholder,
        'required' => !empty($required),
        'data-disabled' => !empty($disabled),
    ], $attribs);
@endphp

<div class="mb-3">
    {!! Form::label($name, $title, ['class' => 'form-label']) !!}
    {!! Form::select($name, $values, $selected_value, $attribs) !!}

    @if(! $hide_errors_list)
        @include('errors._list', ['error' => $errors->get($name)])
    @endif
</div>
