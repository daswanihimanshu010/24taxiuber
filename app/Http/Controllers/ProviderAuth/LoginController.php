<?php

namespace App\Http\Controllers\ProviderAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;


use App\Helpers\Helper;
use Config;
use Illuminate\Http\Request;
use Exception;
use Validator;
use JWTAuth;
use App\Provider;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/provider/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('provider.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('provider.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('provider');
    }

        /**
     * Handle a OTP request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function otp(Request $request)
     {
         //return $request;
         $this->validate($request, [
             'mobile' => 'required',
             'device_id' => 'required'
         ]);
        $newotp = rand(100000,999999);
        $data['otp'] = $newotp;
        \Log::alert(Provider::where('mobile',$request['mobile'])->first());
        if(Provider::where('mobile',$request['mobile'])->first()){
            $user = Provider::with('device')->where('mobile',$request['mobile'])->first();
            if($user->device->udid == $request->device_id){
                Helper::send_otp($request->mobile,$newotp);
                return response()->json([
                    'message' => 'OTP not needed',
                    'verified' => true,
                    'user' => $user,
                    'otp' => $newotp
                ], 200);
            }else{
                Helper::send_otp($request->mobile,$newotp);
                return response()->json([
                    'message' => 'OTP Sent',
                    'verified' => false,
                    'user' => $user,
                    'otp' => $newotp
                ], 200);
            }
        }else{
            Helper::send_otp($request->mobile,$newotp);
            return response()->json(['message' => 'OTP Sent redirect to register','verified' => false,'otp' => $newotp]);
        }
    }
}
