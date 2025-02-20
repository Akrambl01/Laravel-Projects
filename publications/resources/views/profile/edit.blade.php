<x-master>
    @section('title')
        Modifier Profile
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

    <h3>Modifier Profile</h3>
    <form method="POST" action="{{ route('profiles.update', $profile->id) }}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom complet</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $profile->name)}}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $profile->email) }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" value="{{ old("password") }}" class="form-control @error('password') is-invalid @enderror"> 
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="bio" id="description" class="form-control @error('bio') is-invalid @enderror">{{ old("bio" ,$profile->bio) }}</textarea>
            @error('bio')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" value="{{ old("image", $profile->image) }}" class="form-control @error('image') is-invalid @enderror"> 
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-grid my-2">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
</x-master>