<x-master>
    @section('title')
     Publications
    @endsection
    <h3>Publications</h3>
    <div class="row">

        @foreach ($publications as $publication)
        <div class="card my-2">
            <div class="card-header">
                <h5>{{ $publication->titre }}</h5>
            </div>
            <div class="card-body">
                <p>{{ $publication->body }}</p>
                <img src="{{ asset('storage/'.$publication->image) }}" alt="image" style="width: 200px">
            </div>
            <div class="card-footer">
                <a href="{{ route('publications.edit', $publication->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>    
        @endforeach
    </div>
    
    {{$publications->links()}}
</x-master>