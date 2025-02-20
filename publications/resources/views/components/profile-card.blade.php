<div class="col-sm-4
">
    <div class="card my-2 p-1">
        <div class="card-body">
            {{-- -to can display the image we need to use the asset helper function to get the full path of the image 
            -asset : is a helper function that generates a URL for an asset using the current scheme of the request (HTTP or HTTPS): 
            asset('css/app.css') => http://example.com/css/app.css
            -and to access the images need to store them in the public folder 
            -to store the images in the public folder we need to create a folder called storage in the public folder by using the command php artisan storage:link this command will create a symbolic link from public/storage to storage/app/public --}}
            <img class="card-img-top" height="230px" src="{{asset("storage/".$profile->image)}}" alt="img">
            <h4 class="card-title">{{$profile->name}}</h4>
            <p class="card-text">{{Str::limit($profile->bio, 50, "...")}}</p>
            <a class="stretched-link" href="{{route("profiles.show", $profile->id)}}" ></a>
        </div>
        <div class="card-foot border-top p-3 bg-light m-1" style="z-index: 100">
            <form action="{{route("profiles.destroy", $profile->id)}}" method="post">
                @method("DELETE")
                @csrf
                <button class="btn btn-danger float-end">Delete</button>
            </form>
            <form action="{{route("profiles.edit", $profile->id)}}" method="get">
                @csrf
                <button class="btn btn-primary float-end m-1">Edit</button>
            </form>
        </div>
    </div>
</div>