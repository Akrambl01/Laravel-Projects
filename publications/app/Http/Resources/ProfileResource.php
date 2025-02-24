<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $values = parent::toArray($request);
        if(isset($values["image"])){
            $values["image"] = url("storage/" . $this["image"]);
        }
        // format the updated_at date to be like this format "1 minute ago"
        $values["updated_at"] = $this["updated_at"]->diffForHumans();
        // format the created_at date to be like this format "01-01-2021"
        $values["created_at"] = $this["created_at"]->format("d-m-Y");
        
        // add new value to the array ex : duration
        // date between the created_at and updated_at with this format "1 year, 2 mon ths, 3 days, 4 hours, 5 minutes, 6 seconds"
        $values["duration"] = $this["created_at"]->diff($this["updated_at"])->format("%y years, %m months, %d days, %h hours, %i minutes, %s seconds");

        return $values;
    }

    /**
     ** Add additional data to the response
     *
     * @param mixed $resource
     * @return mixed
     */
    public static function collection($resource)
    {
        $values =  parent::collection($resource)->additional(["count"=>$resource->count()]);
        return $values;
    }
} 
