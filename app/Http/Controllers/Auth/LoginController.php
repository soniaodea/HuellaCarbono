<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Input;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'remember' => 'nullable',
        ]);
    }

    public function login(Request $request)
    {
        $validator = $this::validator($request->all());

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $request->session()->flash('loginFailed', true);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (isset($request->remember)) {
            $remember = true;
        } else {
            $remember = false;
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = Auth::user();

            // user has verified email
            if (!empty($user->email_code) && !$user->verified) {
                Auth::logout();
                $request->session()->flash('emailVerified', false);

                return redirect(route('landing'));
            }

            return redirect()->intended($this::redirectPath());
        } else {
            $request->session()->flash('loginFailed', true);
            $errors = [$this->username() => trans('auth.failed')];

            if ($request->ajax()) {
                return response()->json(['error' => $errors]);
            }

            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    public function loginApi(Request $request)
    {

        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        // TODO verify email

        return $this->sendFailedLoginResponse($request);

    }

    /*public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data' => 'User logged out.'], 200);
    }*/
}
