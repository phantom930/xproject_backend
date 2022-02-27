<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    protected $user;
    /**
     * User registration
     * @post ("/api/auth/register")
     * @param ({
     *      @Parameter("email", type="email", required="true", description="User email"),
     *      @Parameter("username", type="string", required="true", description="User username"),
     *      @Parameter("wallet_address", type="string", required="true", description="Wallet address"),
     *      @Parameter("wallet_type", type="string", required="true", description="Wallet type"),
     * })
     * @return array
     */

    public function register(RegisterRequest $request) {
        \DB::beginTransaction();
        $user = new User([
            'email'          => $request->input('email'),
            'username'       => $request->input('username'),
            'wallet_address' => $request->input('wallet_address'),
            'wallet_type'    => $request->input('wallet_type'),
            'remember_token' => Str::random(60)
        ]);
        $user->save();

        \DB::commit();

        return response()->json(['token' => $user->remember_token, 'success' => true], 200);
    }
}
