<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\ContactoUsuario;
use App\Mail\ReplyContactMail;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.home', ['users' => $users]);
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();

        return redirect(route('admin.home'));
    }

    public function editUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:255',
            'nif' => 'nullable|alpha_num|size:9',
            'telephone' => 'nullable|integer|min:100000000|max:999999999',
            'email' => 'required|string|email|max:255',
            'verified' => 'required', Rule::in('0', '1'),
        ]);

        if ($validator->fails()) {
            $request->session()->flash('editFailed', true);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', $request->id)->firstOrFail();
        $user->name = $request->input('name');
        $user->nif = $request->input('nif');
        $user->telephone = $request->input('telephone');
        $user->email = $request->input('email');
        $user->verified = $request->input('verified');
        $user->save();

        return redirect(route('admin.home'));
    }

    public function showMessages()
    {
        $mails = ContactoUsuario::all();

        return view('admin.datoscontactoadmin', ['mails' => $mails]);
    }

    public function deleteMail(Request $request, $id)
    {
        $mail = ContactoUsuario::where('id', $id)->firstOrFail();
        $mail->delete();

        return redirect(route('admin.mails.show'));
    }

    public function replyMail(Request $request, $id)
    {
        $for = $request->input('for');
        $reply = $request->input('reply');

        Mail::to($for)->send(new ReplyContactMail(ContactoUsuario::findOrFail($id), $reply));

        $request->session()->flash('replyStatus', 'sent');

        return redirect(route('admin.mails.show'));
    }
}
