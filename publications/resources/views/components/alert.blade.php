@props(['type'])

<div class="alert alert-{{$type}}" role="alert">
    <p>{{$slot}}</p>
</div>