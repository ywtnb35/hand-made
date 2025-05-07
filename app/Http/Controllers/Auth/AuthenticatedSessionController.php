<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(! Auth::attempt($request->only('email','password'),$request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'メールまたはパスワードが正しくありません。',
            ]);
        }

        $request->session()->regenerate();

        //カートに商品があればカートページへ、それ以外がマイページへ
        if(session()->has('cart') && count(session('cart')) > 0) {
            return redirect()->route('cart.show');
        } else {
            return redirect()->route('user.mypage');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function authenticated(Request $request,$user)
    {
        if ($user->role === 'admin'){
            return redirect()->route('admin.products.index');
        } else {
            return redirect()->route('user.mypage');
        }
    }
}
