<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Helpers\Helper;
use Auth;
use Config;
use Illuminate\Http\Request;
use Exception;
use Validator;
use JWTAuth;
use App\User;
use App\ReferralResource;


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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('user.auth.login');
    }
    
        /**
     * Handle a OTP request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function otp(Request $request)
     {
         $this->validate($request, [
             'mobile' => 'required',
             'device_id' => 'required'
         ]);
        $newotp = rand(100000,999999);
        $data['otp'] = $newotp;
        if(User::where('mobile',$request['mobile'])->first()){
            $user = User::where('mobile',$request['mobile'])->first();
            // $user->currency = config('constants.currency');
            // $user->sos = config('constants.sos_number', '911');
            // $user->app_contact = config('constants.app_contact', '5777');
            // $user->measurement = config('constants.distance', 'Kms');


            // $user->cash = (int)config('constants.cash');
            
            // //TODO ALLAN - Alterações Debit na máquina e voucher
            // $user->debit_machine = (int)config('constants.debit_machine');
            // $user->voucher = (int)config('constants.voucher');
            
            // $user->card = (int)config('constants.card');
            // $user->payumoney = (int)config('constants.payumoney');
            // $user->paypal = (int)config('constants.paypal');
            // $user->paypal_adaptive = (int)config('constants.paypal_adaptive');
            // $user->braintree = (int)config('constants.braintree');
            // $user->paytm = (int)config('constants.paytm');

            // $user->stripe_secret_key = config('constants.stripe_secret_key');
            // $user->stripe_publishable_key = config('constants.stripe_publishable_key');
            // $user->stripe_currency = config('constants.stripe_currency');

            // $user->payumoney_environment = config('constants.payumoney_environment');
            // $user->payumoney_key = config('constants.payumoney_key');
            // $user->payumoney_salt = config('constants.payumoney_salt');
            // $user->payumoney_auth = config('constants.payumoney_auth');

            // $user->paypal_environment = config('constants.paypal_environment');
            // $user->paypal_currency = config('constants.paypal_currency');
            // $user->paypal_client_id = config('constants.paypal_client_id');
            // $user->paypal_client_secret = config('constants.paypal_client_secret');

            // $user->braintree_environment = config('constants.braintree_environment');
            // $user->braintree_merchant_id = config('constants.braintree_merchant_id');
            // $user->braintree_public_key = config('constants.braintree_public_key');
            // $user->braintree_private_key = config('constants.braintree_private_key');

            // $user->referral_count = config('constants.referral_count', '0');
            // $user->referral_amount = config('constants.referral_amount', '0');
            // $user->referral_text = trans('api.user.invite_friends');
            // $user->ride_otp = (int)config('constants.ride_otp');
            // $user->ride_toll = (int)config('constants.ride_toll');

            if($user->device_id == $request->device_id){
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