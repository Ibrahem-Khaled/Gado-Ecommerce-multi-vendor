<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Customer;
use App\Dealer;
use Session;
use Socialite;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware(['customer_guest', 'dealer_guest'], ['except' => 'Logout']);
    }

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }
    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if ($user) {
            Auth::login($user);
            return redirect()->action('front.home');
        } else {
            return view('auth.register', ['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()]);
        }
    }
    # login
    public function Login()
    {

        session(['url.intended' => url()->previous()]);

        return view('front.auth.login.login');
    }

    public function VerifyPhone()
    {
        return view('front.auth.verify.verify_phone');
    }

    public function VerifyCode()
    {
        return view('front.auth.verify.verify_code');
    }

    public function CheckCode(Request $request)
    {
        $token = $request->token;
        $code = '';

        # check of length and collect code
        if (is_array($request->code) && count($request->code) == 4) {
            foreach ($request->code as $co) {
                $code .= $co;
            }
        } else {
            return $this->SomethingWentWrong();
        }

        # check if token exist
        if (is_null($token)) {
            return $this->SomethingWentWrong();
        }

        # get user type from token
        $user_type = str_split($token)[0];

        # check of user type
        if ($user_type === 'c') {
            $customer = Customer::where([['remember_token', $token], ['code', $code]])->first();
            if (!$customer) {
                return $this->IncorrectCode();
            }

            $customer->remember_token = $user_type . date('d-m-y') . time() . Str::random(50);
            $customer->code = null;
            $customer->save();
            $url = url('customer/register') . '?token=' . $customer->remember_token . '&phone=' . $customer->active_phone;
            return redirect($url);

        } elseif ($user_type === 'd') {
            $dealer = Dealer::where([['remember_token', $token], ['code', $code]])->first();
            if (!$dealer) {
                return $this->IncorrectCode();
            }

            $dealer->remember_token = $user_type . date('d-m-y') . time() . Str::random(50);
            $dealer->code = null;
            $dealer->save();
            $url = url('dealer/register') . '?token=' . $dealer->remember_token . '&phone=' . $dealer->active_phone;
            return redirect($url);

        } else {
            return $this->SomethingWentWrong();
        }
    }

    # Something went wrong
    public function SomethingWentWrong()
    {
        Session::flash('danger', 'حدث خطأ ما !');
        return back();
    }

    # incorrect code
    public function IncorrectCode()
    {
        Session::flash('danger', 'الكود الذي أدخلتة غير صحيح !');
        return back();
    }
}
