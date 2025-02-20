
@section('title')
Profiles
@endsection

<x-master title="Profiles">
<h3>Profiles</h3>
<div class="row my-5">
    @foreach ($profiles as $profile)
    <x-profile-card :profile="$profile" />
    @endforeach
</div>


{{-- Pagination links: This will generate the pagination controls (e.g., previous, next, page numbers) for navigating through the paginated list of profiles  --}}
{{$profiles->links()}}
</x-master>