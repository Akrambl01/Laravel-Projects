<h1>name: {{$name}}</h1>
<h1>age: {{$age}}</h1>
<p>this is global variables for all views => {{$global}}</p>


<form method="POST" action="{{route("admin.store")}}">
    @csrf
    <input type="text" name="" id="">
    <input type="text" name="" id="">
</form>