<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'accepted',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_code' => str_random(75),
            'verified' => false,
        ]);

        $user->sendVerifyEmail();

        return $user;
    }

    public function register(Request $request)
    {
        $validator = $this::validator($request->all());
//error_log("RegisterController:Inicio register");
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $request->session()->flash('registerFailed', true);

            return redirect()->back()->withErrors($validator)->withInput();
        } else {
//error_log("RegisterController:Crea registro en bd");

            $this::create($request->all());

        }
  //      error_log("RegisterController:flash postRegister, emailAddress");

        $request->session()->flash('postRegister', true);
        $request->session()->flash('emailAddress', $request->input('email'));
//error_log("RegisterController:Redirect a landing route");

        return redirect(route('landing'));
    }

    public function verifyEmail(Request $request, $token)
    {
        $user = User::where('email_code', $token)->firstOrFail();
        $user->verify();

        $request->session()->flash('accountActivated', true);
        $request->session()->flash('emailAddress', $user->email);

        return redirect(route('landing'));
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }

    public function registerApi(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
