<x-master>
    <h3>Request/Response</h3>
    <form method="POST" action="{{ route('form') }}">
        @csrf
        <input type="text" name="input_field" class="form-control" placeholder="Enter your text here">
        <input type="date" name="date" class="form-control" placeholder="Enter your date here">
        <input type="submit" value="Send" class="btn btn-primary btn-sm my-3">
    </form>
</x-master>