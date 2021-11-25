<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function transaction()
    {
        $name = 'Aldy Victor Rianes';
        $email = 'aldyvictor@gmail.com';
        $password = Hash::make('12345678');
        $role = 'Admin';

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
            $role = Role::create([
                'user_id' => $user->id,
                'role' => $role

            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
