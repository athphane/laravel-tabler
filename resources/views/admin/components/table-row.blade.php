@php
    $row_id = $row_id ?? ($model ?? '').'-'.($model_id ?? rand()).'-row';
@endphp
<tr id="{{ $row_id }}">
    <td>
        @php
            $checkbox_id = $row_id.'-check';
        @endphp
        <div class="col-auto">
            <input id="{{ $checkbox_id }}" class="form-check-input" data-check="{{ $model ?? '' }}" name="{{ $model ?? '' }}[]" value="{{ $model_id ?? '' }}" type="checkbox" />
        </div>
    </td>
    {{ $columns ?? '' }}
</tr>
