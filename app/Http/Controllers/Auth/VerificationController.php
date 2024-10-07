<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->email_verified_at = now();
            $user->save();

            return redirect()->route('home')->with('success', 'Your email address has been verified!');
        }

        return redirect()->route('home')->with('error', 'Invalid verification link!');
    }
}
