<x-master>
    @section('title')
     Publications
    @endsection
    <h3>Publications</h3>
    <div class="container w-75 mx-auto">
    <div class="row">
        @foreach ($publications as $publication)
        <div class="card my-2 bg-light">
            <div class="card-body ">
                <a href="{{ route('publications.edit', $publication->id) }}" class="btn btn-sm btn-primary float-end">Edit</a>
                <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm float-end btn-danger mx-2">Delete</button>
                </form>
                <blockquote class="blockquote mb-0">
                    <p><strong>{{ $publication->titre }}</strong></p>
                    <p>{{ $publication->body }}</p>
                    @isset($publication->image)
                    <footer class="blockquote-footer">
                        <img class="img-fluid" src="{{ asset('storage/'.$publication->image) }}" alt="{{ $publication->titre }}" style="width: 200px">
                    </footer>
                    @endisset
                    
                </blockquote>
            </div>
        </div>    
        @endforeach
    </div>
    </div>
    
    {{$publications->links()}}
</x-master>