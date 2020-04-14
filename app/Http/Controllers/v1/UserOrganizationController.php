<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\User;
use App\Models\UserOrganization;
use Illuminate\Http\Request;

class UserOrganizationController extends Controller
{
    
    public function index(User $user)
    {
        return RestResponse::data($user->organizations);
    }


    
    public function store(Request $request, User $user)
    {
        $organization = new UserOrganization();
        $organization->user_id = $user->id;
        $organization->year = $request->year;
        $organization->name = $request->name;
        $organization->role = $request->role;
        $organization->description = $request->description;
        $organization->save();
        return  RestResponse::created(UserOrganization::class);
    }

    
    public function show(User $user, UserOrganization $organization)
    {
        if($user->id != $organization->user_id){
            return RestResponse::unauthorized();
        }

        return RestResponse::data($organization);
    }

    
    public function update(Request $request, User $user, UserOrganization $organization)
    {
        if($user->id != $organization->user_id){
            return RestResponse::unauthorized();
        }
        $organization->year = $request->year;
        $organization->name = $request->name;
        $organization->role = $request->role;
        $organization->description = $request->description;
        $organization->save();
        return RestResponse::updated(UserOrganization::class);   
    }

   
    public function destroy(User $user, UserOrganization $organization)
    {
        if($user->id != $organization->user_id){
            return RestResponse::unauthorized();
        }

        $organization->delete();
        return RestResponse::deleted(UserOrganization::class);
    }
}
