<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = QueryBuilder::for(User::class)
        ->allowedFilters('id', 'registedAt', 'firstName','middleName', 'lastName', 'email', 'mobile')
        ->defaultSort('-id')
        ->allowedSorts(['id', 'registedAt', 'firstName', 'middleName','lastName', 'email', 'mobile'])
        ->paginate(env('PAGINATE'));

        return new UserCollection($users);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['registedAt'] = Date::now();
        $validated['lastLogin'] = Date::now();

        $user = User::create($validated);
        
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return UserResource::make(($user));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user -> delete();
        
        return response()-> json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
