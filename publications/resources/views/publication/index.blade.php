<x-master>
    @section('title')
     Publications
    @endsection
    <h3>Publications</h3>
    <div class="container w-75 mx-auto">
    <div class="row">
        @foreach ($publications as $publication)
        <x-publication :canUpdate="$publication->profile_id === auth()->user()->id" :publication="$publication"/> 
        @endforeach
    </div>
    </div>
    
    {{$publications->links()}}
</x-master>