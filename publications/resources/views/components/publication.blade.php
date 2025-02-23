@props(['publication', 'canUpdate'])
<div class="card my-2 bg-light">
    <div class="card-body">
        {{-- instead of using @auth and canUpdate var that pass in props to check if the user can update the publication, we can use the @can directive  --}}
        @can('update', $publication)
        <a href="{{ route('publications.edit', $publication->id) }}" class="btn btn-sm btn-primary float-end">Edit</a>
        @endcan
        @can('delete', $publication)
        <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm float-end btn-danger mx-2" onclick="return confirm('Are you sure ?')">Delete</button>
        </form>
        @endcan
        <blockquote class="blockquote mb-0">
            <div class="container">
                <div class="row align-items-center ">
                    <div class="col-md-4 position-relative">
                        <img src="{{ asset('storage/'.$publication->profile->image) }}" alt="{{ $publication->profile->name }}" class="img-fluid rounded-circle" style="width: 100px">
                        <h4>{{ $publication->profile->name }}</h4>
                        <a href="{{route("profiles.show",$publication->profile->id)}}" class="stretched-link"></a>
                    </div>
                    <div class="col-8">
                        <p>{{ $publication->titre }}</p>
                    </div>
                </div>
            </div>
            <hr>
            <small class="text-muted" >{{ $publication->body }}</small>
            @isset($publication->image)
            <footer class="blockquote-footer">
                <img class="img-fluid" src="{{ asset('storage/'.$publication->image) }}" alt="{{ $publication->titre }}" style="width: 200px">
            </footer>
            @endisset
            
        </blockquote>
    </div>
</div>  