
<!-- don't use this comment bc is show in browser in devtool  -->

{{-- use this for comment --}}

{{-- to include a file --}}
{{-- @include('partials.nav') --}}

{{-- to call layout page and extend content  --}}
{{-- @extends('layouts.master') --}}



<x-master>

{{-- to add content to the layout page --}}
@section('title') Acceuil @endsection
<h3>Home</h3>


{{-- to include a component and pass props --}}
{{-- <x-users-table nom="akram" /> --}}
{{-- if props is a variable --}}
{{-- <x-users-table :users="$users" /> --}}

</x-master>
{{-- @empty($langs)
    <p>There are no languages</p>
@else
    <p>Cours :</p>
    <table border="1" width="70%">
        <tr>
            <th>Languages</th>
        </tr>
        @foreach ($langs as $lang)
        <tr>
            <td>{{$lang}}</td>
        </tr>
        @endforeach
    </table>
@endempty --}}
    