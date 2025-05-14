<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UsersController extends Controller
{
    public function index()
    {
        $start = microtime(true);
        // cache facade 
        // $users = DB::table("users")->get();
        // Cache::put("users.list", $users, now()->addMinutes(10));
        // $users = Cache::get("users.list");
        // redis facade
        $cached = Redis::get('users.list');
        if ($cached) {
            $users = json_decode($cached, false);
            Log::info("data from cache", ["time" => microtime(true) - $start]);
        } else {
            $users = DB::table("users")->get();
            Log::info("data from db", ["time" => microtime(true) - $start]);
            Redis::set('users.list', $users->toJson(), 'EX', 600);
        }
        $duration = round((microtime(true) - $start) * 1000, 2);

        return view("users", compact("users", "duration"));
    }

    public function clearCache()
    {
        // Cache::forget("users.list");
        Redis::del("users.list");
        return response()->json(["status" => "Cache Cleared!"]);
    }
}
