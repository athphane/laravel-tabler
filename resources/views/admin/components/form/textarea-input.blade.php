@php
    $name = isset($name) ? $name : 'name';
    $title = isset($title) ? $title : \Illuminate\Support\Str::title($name);
    $placeholder = isset($placeholder) ? $placeholder : $title;
    $rows = isset($rows) ? $rows : 4;

@endphp

<div class="mb-3">
    {!! Form::label($name, $title, ['class' => 'form-label']) !!}
    {!! Form::textarea($name, old($name), [
        'class' => add_error_class($errors->has($name)),
        'placeholder' => $placeholder,
        'rows' => $rows,
        'required' => isset($required),
        'disabled' => !empty($disabled),
    ]) !!}
</div>
