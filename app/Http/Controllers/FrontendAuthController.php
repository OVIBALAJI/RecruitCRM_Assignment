<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use Log;

class FrontendAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function registration()
    {
        return view('auth.registration');
    }
    public function register(Request $request)
    {

        $validator = Validator::make($request->all() , ['email' => 'required|string|email|max:100|unique:users', 'password' => 'required|string|min:6', 'first_name' => 'required|string|between:2,100', 'last_name' => 'required|string|between:2,100',

        ]);
        if ($validator->fails())
        {
            return response()
                ->json(['error' => $validator->errors()
                ->all() ]);
        }
        $data = $request->all();
        $user = User::create(array_merge($data, ['password' => bcrypt($request->password) ]));
        Session::put('owner_id', $user->id);

        return $data = ["status" => "success", "owner_id" => $user->id];
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all() , ['email' => 'required|email', 'password' => 'required|string|min:6', ]);
        if ($validator->fails())
        {
            return response()
                ->json(['error' => $validator->errors()
                ->all() ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials))
        {
            Session::put('owner_id', Auth::id());
            return $data = ["status" => "success", "owner_id" => Auth::id() ];

        }
        else
        {
            return 'Oppes! You have entered invalid credentials';
        }
    }
}

