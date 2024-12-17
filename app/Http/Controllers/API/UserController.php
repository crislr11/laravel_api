<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
   
    public function index()
    {
        $users = User::where('rol', '!=', 'a')
                 ->where('deleted', '!=', 1)
                 ->get();
        
        return $this->sendResponse($users, 'Users retrieved successfully');
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(string $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
        
        return $this->sendResponse($user, 'User retrieved successfully.');
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}