
@section('title')
{{$profile->name}}
@endsection

<x-master title="Profiles">
    <div class="row">
        <div class="card my-4 py-4">
            <img src="{{asset("storage/".$profile->image)}}" alt="img" class="card-img-top w-25 mx-auto">
            <div class="card-body text-center">
                <h4 class="card-title fw-bold">#{{$profile->id}} {{$profile->name}}</h4>
                <p class="card-text">{{$profile->created_at->format("d-m-Y")}}</p>
                <p class="card-text">Email <a href="mailto:{{$profile->email}}">{{ $profile->email}}</a></p>
                <p class="card-text">{{$profile->bio}}</p>
            </div>
        </div>
    </div>
<ul>
    <li>name: {{$profile->name}}</li>
    <li>email: {{$profile->email}}</li>
    <li>bio: {{$profile->bio}}</li>
</ul>


</x-master>