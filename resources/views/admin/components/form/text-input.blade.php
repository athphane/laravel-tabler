@php
    $name = isset($name) ? $name : 'name';
    $title = isset($title) ? $title : \Illuminate\Support\Str::title($name);
    $placeholder = isset($placeholder) ? $placeholder : $title;
@endphp

<div class="mb-3">
    {!! Form::label($name, $title, ['class' => 'form-label']) !!}
    {!! Form::text($name, old($name), [
        'class' => add_error_class($errors->has($name)),
        'placeholder' => $placeholder,
        'required' => isset($required),
        'disabled' => !empty($disabled),
    ]) !!}
    @include('errors._list', ['error' => $errors->get($name)])
</div>
