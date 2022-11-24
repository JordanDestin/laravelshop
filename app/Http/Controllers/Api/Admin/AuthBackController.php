<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthBackController extends Controller
{
    public function loginBack(Request $request)
    {
        

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'admin' => 1])) {
            if ($request->wantsJson()) {
                return response()->json($request->user());
            }
        }
    }
}
