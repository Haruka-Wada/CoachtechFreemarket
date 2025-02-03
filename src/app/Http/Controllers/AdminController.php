<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comment;


class AdminController extends Controller
{
    public function index() {
        $users = User::all();

        return view('admin.index', compact('users'));
    }

    public function loginView() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('administrators')->attempt($credentials)) {
            return redirect('/admin');
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました']
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    //ユーザー詳細ページ
    public function user(Request $request) {
        $user = User::find($request->user_id);

        return view('admin.user', compact('user'));
    }
    //ユーザー削除
    public function userDelete(Request $request) {
        $user = User::find($request->user_id);
        $user->delete();

        return back();
    }

    //コメント削除
    public function commentDelete(Request $request) {
        $comment = Comment::find($request->comment_id);
        $comment->delete();

        return back();
    }
}
