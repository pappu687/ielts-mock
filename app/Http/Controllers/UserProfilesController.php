<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserProfilesRequest;
use App\Http\Requests\UpdateUserProfilesRequest;
use App\Models\UserProfiles;

class UserProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreUserProfilesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfiles $userProfiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfiles $userProfiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfilesRequest $request, UserProfiles $userProfiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfiles $userProfiles)
    {
        //
    }
}
