<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Mail\NewUserMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    //
    public function loginUser(Request $request)
    {
        try {


            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // dd($credentials);

            $user = User::where('email', $request->email)->first();


            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'message' => 'Invalid Credentials',
                ]);
            }

            // return 'awj okay na';
            $code = rand(100000, 999999);
            $user->otp = Hash::make($code);
            $user->save();


            //Mail Trap After
            // Http::asForm()->post(env('SEMAPHORE_API_URI'), [
            //     'apikey' => env('SEMAPHORE_API_KEY'),
            //     'number' => env('SMS_NUMBER'),
            //     'message' => 'Your One-Time PIN: ' . $code,
            // ]);

            Mail::to($user->email)
                ->send(new NewUserMail($code));
            // dd($user);

            return response()->json([
                'message' => 'OTP sent successfully',
                'code' => $code,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function verifyOTP(Request $request)
    {

        $request->validate([
            'otp' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->otp, $user->otp)) {
            return response()->json(['message' => 'Invalid OTP'], 401);
        }

        Auth::login($user);

        // auth()->login($user);
        $user->save();

        return response()->json(['token' => $user->createToken('TOKEN')->plainTextToken, 'role_id' => $user->role_id]);
    }

    public function login()
    {
        return view('login');
    }
}
