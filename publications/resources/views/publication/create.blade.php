<x-master>
@section('title')
    Create Publications
@endsection

@if ($errors->any())
<x-alert type="danger">
    <h6>Errors: </h6>
    <ul>
        @foreach ($errors->all() as $error)
        <li> {{ $error }}</li>
        @endforeach
    </ul>
</x-alert>
@endif

<h3>Ajouter Publications</h3>
<form method="POST" action="{{ route('publications.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre') }}">
        @error('titre')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <input type="text" name="body" id="body" class="form-control @error('body') is-invalid @enderror" value="{{ old('body') }}">
        @error('body')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
        @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-grid my-2">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
</form>
</x-master>