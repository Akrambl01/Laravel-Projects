
@section('title')
{{$profile->name}}
@endsection

<x-master title="Profiles">
    <div class="row">
        <h2>Profile</h2>
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
    <div class="row my-2">
        <p>Publications</p>
        @foreach ($profile->publications as $publication)
        <x-publication :canUpdate="$publication->profile_id === auth()->user()->id" :publication="$publication"/> 
        @endforeach
    </div>

</x-master>