<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:150',
            'password' => 'required|min:8|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->route('users.login')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $user = User::where('user_name', $request->get('user_name'))->first();
            if ($user && Hash::check($request->get('password'), $user->password)) {

                Auth::guard('users')->login($user);

                return redirect()->route('users.category');
            } else {
                // users.login
                return redirect()->route('users.login')
                    ->withErrors([trans('messages.login-fail')])
                    ->withInput();
            }
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return redirect()->route('users.login')
                ->withErrors([trans('messages.system-error')])
                ->withInput();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:150',
            'password' => 'required|min:8|max:100|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return redirect()->route('users.register')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $roll = 1;
            $register = new User();
            if ($request->get('id')) {
                $register = User::find($request->get('id'));
            }
            $user_name = User::get('user_name');
            // nen kiem tra nguoai layout luon de update len sau.
            foreach ($user_name as $item) {
                if ($item = $request->get('user_name')) {
                    $validator = "user da ton tai";
                    return redirect()->route('users.register')->withErrors($validator)
                        ->withInput();;
                }
            }

            $register->user_name = $request->get('user_name');
            $register->name = $request->get('name');
            $register->address = "a";
            $register->email = "a";
            $register->delete_flg = '0';
            $register->role = $roll;
            $register->password = Hash::make($request->get('password'));
            $register->save();

            // $categories = User::orderBy('category_code')->get();
            return view('login');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return redirect()->route('users.register')
                ->withErrors([trans('messages.system-error')])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
