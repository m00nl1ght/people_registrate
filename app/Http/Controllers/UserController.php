<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    public function test(Request $request) {
        $path = $request->file('files')->store('avatars');
        return  $request->file('files')->getClientOriginalName();
    }

    public function getUser(Request $request) {
        $user = User::where('id', $request->user()->id)
        ->with('role')
        ->first();

        $roles = [];
        foreach($user->role as $role) {
            $roles[] = $role->name;
        }

        $response = [
            'roles' => $roles,
            'name' => $user->name
        ];
        
        return $response;
    }
}
