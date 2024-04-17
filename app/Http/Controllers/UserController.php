<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();

        return view('users.index', data: ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        $passwordHash = Hash::make($request->get('password'));
        $user = new User();
        $user -> id = Date::now() -> timestamp;
        $user -> firstName = $request->get('firstName');
        $user -> middleName = $request->get('middleName');
        $user -> lastName = $request->get('lastName');
        $user -> email = $request->get('email');
        $user -> mobile = $request->get('mobile');
        $user -> passwordHash = $passwordHash;
        $user -> intro = $request->get('intro');
        $user -> profile = $request->get('profile');
        $user -> registedAt = Date::now();
        $user -> lastLogin  = Date::now();

        $user -> save();

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
