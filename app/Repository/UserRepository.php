<?php
namespace App\Repository;

use App\Models\User;
use App\Repository\UserInterface;
use Storage;
use File,Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{
    /**
    * Get all the users Other than logged in user with filter and sorting
    *
    * @param Request $request
    * @return mixed
    */
    public function getOtherUsers($request)
    {
        $user = Auth::user();
        $users = User::where('id','!=',$user->id)->get();

        return $users;
    }

    /**
     * Get user by id
     *
     * @param int $id
     * @return User
     */
    public function getUserById($id)
    {
        return User::find($id);
    }
}