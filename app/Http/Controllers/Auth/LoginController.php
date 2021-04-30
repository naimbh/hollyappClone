<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Note;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        //pushing ids if session already created
        if ($request->session()->has('note.ids')) {
            $ids = session('note.ids');

            Note::whereIn('id', $ids)
                ->where('user_id', null)
                ->update([
                'user_id' => $user->id,
            ]);
        }

        //redirect to another dash if super admin
        if ($user->is_admin){
            return redirect(route('admin.dashboard'));
        }
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('note.ids')) {
            $ids = session('note.ids');
        }else{
            $ids = [];
        }

        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //re populate ids session
        $request->session()->put('note.ids', $ids);

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }
}
