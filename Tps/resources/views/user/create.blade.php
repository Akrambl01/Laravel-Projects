<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="date">date</label>
        <input type="date" name="date" class="form-control" id="date" placeholder="date">
    </div>
    <div class="form-group">
        <label for="image">file</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>