<?php

namespace App\Http\Controllers;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\OpenWeatherMap;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{   
    private $weatherService;

    public function __construct()
    {
        $this->weatherService = new OpenWeatherMap(env("OPEN_WEATHER_MAP_KEY", ""));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {

            $users = Cache::remember("users", 3600, function(): Collection {
                return User::all();
            });

            return (new UserCollection($users))
                ->response()
                ->setStatusCode(200);

        } catch(\Exception $e) {

            $error = $e->getMessage();
            return (new ErrorResource($error))
                ->response()
                ->setStatusCode(500);
        
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            // Instance of openWeatherService
            // $service = $this->weatherService;

            $user = Cache::remember("user:".$id, 3000, function() use ($id): mixed {
                $u = User::findOrFail($id);
                $data = $this->weatherService->getCurrentWeather($u->latitude, $u->longitude);

                return [
                    "user" => $u,
                    "weather" => $data
                ];
            });

            return (new UserResource($user["user"]))
                ->additional([ "weather" => $user["weather"] ])
                ->response()
                ->setStatusCode(200);
        
        }
        catch(\Exception $e) {

            $error = $e->getMessage();
            return (new ErrorResource($error))
                ->response()
                ->setStatusCode(500);
        
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
