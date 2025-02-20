<x-master>
    @section('title')
        Se connecter
    @endsection
    <h3>Login </h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">login</label>
            <input type="text" name="login" id="login" value="{{ old("login") }}" class="form-control  @error('login') is-invalid @enderror " >
            @error('login')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control"> 
        
        </div>
        <div class="d-grid my-2">
            <button type="submit" class="btn btn-primary">Se connecter </button>
        </div>
    </form>
</x-master>    