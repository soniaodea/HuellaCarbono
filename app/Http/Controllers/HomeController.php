<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailUser;
use App\Models\ContactoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Hash;
use App\Models\Building;
use App\Mail\ContactMailAdmin;
use App\Models\User;
use App\Rules\ValidateDni;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('datoscontacto');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('building'));
    }

    /**
     * Contact.
     */
    public function datoscontacto(Request $request)
    {
        $validator = $this::contactValidator($request->all());

        if ($validator->fails()) {
            $request->session()->flash('isContactValid', false);

            if ($request->ajax()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            return redirect(route('landing').'#contacto')->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        $datoscontacto = ContactoUsuario::create([
             'email' => $email,
             'subject' => $subject,
             'message' => $message,
         ]);

        Mail::to($email)->send(new ContactMailUser());
        Mail::to(config('mail.adminAddress'))->send(new ContactMailAdmin());

        if ($request->ajax()) {
            return response()->json(['success' => 'Tu mensaje se ha enviado correctamente.']);
        }

        $request->session()->flash('isContactValid', true);

        return redirect(route('landing').'#contacto');
    }

    protected function contactValidator(array $data)
    {
        return Validator::make($data, [
             'email' => 'required|string|email|max:255',
             'subject' => 'nullable|max:30',
             'message' => 'required',
         ]);
    }

    /*
     * perfil del usuario
     */

    private function validateProfile($request)
    {
        $validator = Validator::make($request->all(), [
              'name' => 'required|string|min:5|max:255',
              'nif' => [
                  'nullable',
                  'alpha_num',
                  'max:9',
                  new ValidateDni(),
              ],
              'email' => [
                  'required',
                  'email',
                  'email',
                  'max:255',
                  Rule::unique('users')->ignore(Auth::id()),
              ],
              'telephone' => 'nullable|numeric|min:100000000|max:999999999',
              'publicViewable' => 'required|boolean',
          ]);

        return $validator;
    }

    public function showProfile(Request $request)
    {
        return view('user.profile');
    }

    public function saveProfile(Request $request)
    {
        $validator = $this->validateProfile($request);

        if ($validator->fails()) {
            return redirect(route('user.profile'))->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->nif = strtoupper($request->input('nif'));
        $user->telephone = $request->input('telephone');
        $user->email = $request->input('email');
        $user->publicViewable = $request->input('publicViewable');
        $user->save();

        return redirect(route('user.profile'));
    }

    public function showChangePassword()
    {
        return view('user.changePassword');
    }

    private function validateChangePassword($request)
    {
        $validator = Validator::make($request->all(), [
              'currentPassword' => 'required',
              'newPassword' => 'required|confirmed|min:6',
          ]);

        return $validator;
    }

    public function changePassword(Request $request)
    {
        $validator = $this->validateChangePassword($request);
        $user = Auth::user();

        if ($validator->fails()) {
            return redirect(route('user.profile.changePassword'))->withErrors($validator);
        }

        if (Hash::check($request->input('currentPassword'), $user->password)) {
            $user->password = Hash::make($request->input('newPassword'));
            $user->save();

            return redirect(route('user.profile.changePassword'))->with('changed', true);

            return $request->all();
        } else {
            $validator->errors()->add('currentPassword', trans('auth.failed'));

            return redirect(route('user.profile.changePassword'))->withErrors($validator);
        }
    }
}
