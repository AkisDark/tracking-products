<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRequest;

class ProfileController extends Controller
{
    //

    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('pages.auth.profile', compact('user'));
    }

    public function update(UserRequest $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();

            if ($user) {
                //
                if ($request->has('name')) {
                    $user->name = $request->name;
                }
                //
                if ($request->has('email')) {
                    $user->email = $request->email;
                }
                //
                if (!empty($request->input('password')) && $request->has('password')) {
                    $user->password = $request->password;
                }
                //
                $user->save();
                //
                return redirect()->route('users.profile');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
