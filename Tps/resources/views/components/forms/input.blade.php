@props(['name', 'value'], ['value' => ''], ['label' => 'label'])

<div>
    <label for="{{$label}}">{{$label}}</label>
    <input type="text" name="{{ $name }}" id="{{ $label }}" value="{{ $value }}">
</div>